<?php

namespace App\Http\Controllers\SuperAdmin\Subscription;

use App\Http\Controllers\Controller;
use App\Models\SuperAdminAuditLog;
use App\SmSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    /**
     * Display subscription management page using native school billing data.
     */
    public function index(Request $request)
    {
        $query = SmSchool::where('id', '!=', 1); // Exclude global school

        if ($request->filled('search')) {
            $query->where('school_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
        }

        if ($request->filled('status')) {
            $query->where('active_status', $request->status == 'active' ? 1 : 0);
        }

        $subscriptions = $query->orderBy('ending_date', 'asc')->paginate(20);

        return view('backEnd.superAdmin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Update a school's subscription status or duration.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ending_date' => 'required|date',
            'active_status' => 'required|boolean',
            'plan_type' => 'nullable|string'
        ]);

        try {
            $school = SmSchool::findOrFail($id);
            $school->update([
                'ending_date' => $request->ending_date,
                'active_status' => $request->active_status,
                'plan_type' => $request->plan_type
            ]);

            $currentAdmin = Auth::guard('superadmin')->user();
            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'subscription_updated',
                'School',
                $id,
                "Updated subscription for {$school->school_name}. New expiry: {$request->ending_date}"
            );

            return back()->with('message-success', "Subscription for {$school->school_name} updated successfully.");

        } catch (\Exception $e) {
            Log::error('Subscription update failed', ['error' => $e->getMessage()]);
            return back()->with('message-danger', 'Failed to update subscription.');
        }
    }

    /**
     * Toggle school status (Suspend/Activate).
     */
    public function toggleStatus($id)
    {
        try {
            $school = SmSchool::findOrFail($id);
            $school->active_status = $school->active_status == 1 ? 0 : 1;
            $school->save();

            $statusName = $school->active_status == 1 ? 'Activated' : 'Suspended';
            
            return back()->with('message-success', "School {$school->school_name} has been {$statusName}.");
        } catch (\Exception $e) {
            return back()->with('message-danger', 'Operation failed.');
        }
    }
}
