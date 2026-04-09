<?php

namespace App\Http\Controllers\SuperAdmin\Communicate;

use App\Http\Controllers\Controller;
use App\Models\SuperAdminAuditLog;
use App\SmSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CommunicateController extends Controller
{
    /**
     * Display the communications hub.
     */
    public function index()
    {
        $schools = SmSchool::where('active_status', 1)->orderBy('school_name')->get();
        $sentMessages = SuperAdminAuditLog::where('action', 'communication_sent')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('backEnd.superAdmin.communicate.index', compact('schools', 'sentMessages'));
    }

    /**
     * Send email to selected schools.
     */
    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
            'recipients' => 'required|string|in:all,selected',
            'school_ids' => 'nullable|array',
            'school_ids.*' => 'integer',
        ]);

        try {
            $currentAdmin = Auth::guard('superadmin')->user();

            if ($request->recipients === 'all') {
                $schools = SmSchool::where('active_status', 1)->get();
            } else {
                $schools = SmSchool::whereIn('id', $request->school_ids ?? [])->get();
            }

            $sentCount = 0;
            foreach ($schools as $school) {
                if ($school->email) {
                    try {
                        Mail::raw($request->message, function ($mail) use ($school, $request) {
                            $mail->to($school->email)
                                ->subject($request->subject);
                        });
                        $sentCount++;
                    } catch (\Exception $e) {
                        Log::warning("Failed to send email to school: {$school->school_name}", ['error' => $e->getMessage()]);
                    }
                }
            }

            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'communication_sent',
                'Email',
                null,
                "Sent email '{$request->subject}' to {$sentCount} schools",
                null,
                ['subject' => $request->subject, 'recipients' => $sentCount]
            );

            return back()->with('message-success', "Email sent to {$sentCount} schools successfully.");

        } catch (\Exception $e) {
            Log::error('Email sending failed', ['error' => $e->getMessage()]);
            return back()->with('message-danger', 'Failed to send emails.');
        }
    }

    /**
     * Send platform announcement/notice.
     */
    public function sendNotice(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'message' => 'required|string',
            'type' => 'required|string|in:info,warning,critical',
        ]);

        try {
            $currentAdmin = Auth::guard('superadmin')->user();

            // Store notice in settings for display
            $notices = json_decode(\App\Models\SuperAdminSetting::get('platform_notices', '[]'), true) ?? [];
            $notices[] = [
                'id' => uniqid(),
                'title' => $request->title,
                'message' => $request->message,
                'type' => $request->type,
                'created_by' => $currentAdmin->full_name,
                'created_at' => now()->toIso8601String(),
            ];

            // Keep only last 50 notices
            $notices = array_slice($notices, -50);
            \App\Models\SuperAdminSetting::set('platform_notices', json_encode($notices), 'communication', 'json');

            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'communication_sent',
                'Notice',
                null,
                "Published platform notice: {$request->title}",
                null,
                ['title' => $request->title, 'type' => $request->type]
            );

            return back()->with('message-success', 'Notice published successfully.');

        } catch (\Exception $e) {
            Log::error('Notice publishing failed', ['error' => $e->getMessage()]);
            return back()->with('message-danger', 'Failed to publish notice.');
        }
    }
}
