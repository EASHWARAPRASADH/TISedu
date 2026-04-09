<?php

namespace App\Http\Controllers\SuperAdmin\SchoolManagement;

use App\Http\Controllers\Controller;
use App\Models\SuperAdminAuditLog;
use App\SmSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SchoolController extends Controller
{
    /**
     * Display a listing of schools with filters.
     */
    public function schoolList(Request $request)
    {
        $query = SmSchool::query();

        // Apply filters
        if ($request->filled('status')) {
            $query->where('active_status', $request->status == 'active' ? 1 : 0);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('school_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $schools = $query->orderBy('id', 'desc')->paginate(20);

        return view('backEnd.superAdmin.schools.index', compact('schools'));
    }

    /**
     * Show the details of a school.
     */
    public function show($id)
    {
        $school = SmSchool::findOrFail($id);

        // Get school-level stats
        $stats = [
            'students' => DB::table('sm_students')->where('school_id', $id)->count(),
            'staff' => DB::table('sm_staffs')->where('school_id', $id)->count(),
            'classes' => DB::table('sm_classes')->where('school_id', $id)->where('active_status', 1)->count(),
            'sections' => DB::table('sm_sections')->where('school_id', $id)->where('active_status', 1)->count(),
        ];

        return view('backEnd.superAdmin.schools.show', compact('school', 'stats'));
    }

    /**
     * Show the form for creating a new school.
     */
    public function create()
    {
        return view('backEnd.superAdmin.schools.create');
    }

    /**
     * Store a newly created school.
     */
    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'domain' => 'required|string|max:191|unique:sm_schools,domain',
            'custom_domain' => 'nullable|string|max:191|unique:sm_schools,custom_domain',
        ]);

        try {
            DB::beginTransaction();

            $currentAdmin = Auth::guard('superadmin')->user();

            $school = SmSchool::create([
                'school_name' => $request->school_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'domain' => $request->domain,
                'custom_domain' => $request->custom_domain,
                'active_status' => 1,
            ]);

            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'created',
                'School',
                $school->id,
                "Created school: {$school->school_name}",
                null,
                $school->toArray()
            );

            DB::commit();

            return redirect()->route('superadmin.school-list')
                ->with('message-success', 'School created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('School creation failed', ['error' => $e->getMessage()]);

            return back()->withInput()
                ->with('message-danger', 'Failed to create school. Please try again.');
        }
    }

    /**
     * Show the form for editing a school.
     */
    public function edit($id)
    {
        $school = SmSchool::findOrFail($id);
        return view('backEnd.superAdmin.schools.edit', compact('school'));
    }

    /**
     * Update the specified school.
     */
    public function update(Request $request, $id)
    {
        $school = SmSchool::findOrFail($id);

        $request->validate([
            'school_name' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'domain' => 'nullable|string|max:191|unique:sm_schools,domain,' . $id,
            'custom_domain' => 'nullable|string|max:191|unique:sm_schools,custom_domain,' . $id,
        ]);

        try {
            DB::beginTransaction();

            $currentAdmin = Auth::guard('superadmin')->user();
            $oldValues = $school->toArray();

            $school->update($request->only(['school_name', 'email', 'phone', 'address', 'domain', 'custom_domain']));

            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'updated',
                'School',
                $school->id,
                "Updated school: {$school->school_name}",
                $oldValues,
                $school->toArray()
            );

            DB::commit();

            return redirect()->route('superadmin.school-list')
                ->with('message-success', 'School updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('School update failed', ['error' => $e->getMessage()]);

            return back()->withInput()
                ->with('message-danger', 'Failed to update school.');
        }
    }

    /**
     * Remove the specified school.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $currentAdmin = Auth::guard('superadmin')->user();
            $school = SmSchool::findOrFail($id);

            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'deleted',
                'School',
                $school->id,
                "Deleted school: {$school->school_name}",
                $school->toArray(),
                null
            );

            $school->delete();

            DB::commit();

            return redirect()->route('superadmin.school-list')
                ->with('message-success', 'School deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('School deletion failed', ['error' => $e->getMessage()]);

            return back()->with('message-danger', 'Failed to delete school.');
        }
    }

    /**
     * Toggle school active status.
     */
    public function toggleStatus(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        try {
            $school = SmSchool::findOrFail($request->id);
            $currentAdmin = Auth::guard('superadmin')->user();
            $oldStatus = $school->active_status;

            $school->update(['active_status' => !$school->active_status]);

            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'status_changed',
                'School',
                $school->id,
                "Toggled school '{$school->school_name}' status to " . ($school->active_status ? 'active' : 'inactive'),
                ['active_status' => $oldStatus],
                ['active_status' => $school->active_status]
            );

            return back()->with('message-success', 'School status updated.');

        } catch (\Exception $e) {
            Log::error('School status toggle failed', ['error' => $e->getMessage()]);
            return back()->with('message-danger', 'Failed to update school status.');
        }
    }

    /**
     * Perform bulk actions on schools.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|string|in:activate,deactivate,delete',
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ]);

        try {
            DB::beginTransaction();

            $currentAdmin = Auth::guard('superadmin')->user();
            $action = $request->action;
            $ids = $request->ids;

            switch ($action) {
                case 'activate':
                    SmSchool::whereIn('id', $ids)->update(['active_status' => 1]);
                    $description = 'Bulk activated ' . count($ids) . ' schools';
                    break;
                case 'deactivate':
                    SmSchool::whereIn('id', $ids)->update(['active_status' => 0]);
                    $description = 'Bulk deactivated ' . count($ids) . ' schools';
                    break;
                case 'delete':
                    SmSchool::whereIn('id', $ids)->delete();
                    $description = 'Bulk deleted ' . count($ids) . ' schools';
                    break;
            }

            SuperAdminAuditLog::log(
                $currentAdmin->id,
                'bulk_action',
                'School',
                null,
                $description,
                ['ids' => $ids, 'action' => $action],
                null
            );

            DB::commit();

            return back()->with('message-success', $description);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('School bulk action failed', ['error' => $e->getMessage()]);
            return back()->with('message-danger', 'Bulk action failed.');
        }
    }
}
