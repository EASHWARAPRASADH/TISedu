<?php

namespace App\Http\Controllers\SuperAdmin\Impersonate;

use App\Http\Controllers\Controller;
use App\Models\SuperAdminAuditLog;
use App\SmSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ImpersonateController extends Controller
{
    /**
     * Display the impersonation page with school list.
     */
    public function index()
    {
        $schools = SmSchool::where('active_status', 1)
            ->orderBy('school_name')
            ->get();

        return view('backEnd.superAdmin.impersonate.index', compact('schools'));
    }

    /**
     * Impersonate a school admin — login as the school's admin user.
     */
    public function impersonate(Request $request, $schoolId)
    {
        try {
            $school = SmSchool::findOrFail($schoolId);
            $currentAdmin = Auth::guard('superadmin')->user();

            // Find the school's admin user (role_id = 1)
            $schoolAdmin = \App\User::where('school_id', $schoolId)
                ->where('role_id', 1)
                ->where('active_status', 1)
                ->first();

            if (!$schoolAdmin) {
                return back()->with('message-danger', "No active admin found for school: {$school->school_name}");
            }

            // Store SuperAdmin info for returning
            Session::put('impersonating', true);
            Session::put('impersonator_id', $currentAdmin->id);
            Session::put('impersonator_name', $currentAdmin->full_name);
            Session::put('original_guard', 'superadmin');

            // Log the impersonation
            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'impersonation_started',
                'School',
                $schoolId,
                "Impersonating school '{$school->school_name}' as admin user #{$schoolAdmin->id}"
            );

            // Login as the school admin via the web guard
            Auth::guard('web')->login($schoolAdmin);

            // Set school context
            Session::put('school_id', $schoolId);

            return redirect()->route('admin-dashboard')
                ->with('message-success', "Now viewing as admin of: {$school->school_name}");

        } catch (\Exception $e) {
            Log::error('Impersonation failed', ['error' => $e->getMessage()]);
            return back()->with('message-danger', 'Failed to impersonate school admin.');
        }
    }

    /**
     * Return from impersonation back to SuperAdmin panel.
     */
    public function stopImpersonating()
    {
        try {
            $impersonatorId = Session::get('impersonator_id');

            // Logout from web guard
            Auth::guard('web')->logout();

            // Clear impersonation data
            Session::forget(['impersonating', 'impersonator_id', 'impersonator_name', 'original_guard', 'school_id']);

            // Log the return
            if ($impersonatorId) {
                SuperAdminAuditLog::log(
                    $impersonatorId,
                    'impersonation_ended',
                    'SuperAdmin',
                    $impersonatorId,
                    'Returned from school impersonation'
                );
            }

            return redirect()->route('superadmin.login')
                ->with('message-success', 'Returned to SuperAdmin panel. Please login again.');

        } catch (\Exception $e) {
            Log::error('Stop impersonation failed', ['error' => $e->getMessage()]);
            return redirect()->route('superadmin.login');
        }
    }
}
