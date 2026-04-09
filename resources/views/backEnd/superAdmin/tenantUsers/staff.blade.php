@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Global SaaS Staff')

@section('content')
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Master Roster: Staff Members</span>
        <a href="{{ route('superadmin-dashboard') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div style="margin-bottom: 20px;">
        <form action="{{ route('superadmin.tenant.staff') }}" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 8px;">
            <input type="text" name="search" class="sa-form-control" placeholder="Name/Email..." value="{{ request('search') }}" style="max-width: 150px;">
            
            <select name="school_id" class="sa-form-control" style="max-width: 150px;" onchange="this.form.submit()">
                <option value="">All Schools</option>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}" {{ request('school_id') == $school->id ? 'selected' : '' }}>{{ $school->school_name }}</option>
                @endforeach
            </select>

            <select name="role_id" class="sa-form-control" style="max-width: 120px;">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>

            <select name="department_id" class="sa-form-control" style="max-width: 130px;" {{ !request('school_id') ? 'disabled' : '' }}>
                <option value="">All Depts</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                @endforeach
            </select>

            <select name="designation_id" class="sa-form-control" style="max-width: 130px;" {{ !request('school_id') ? 'disabled' : '' }}>
                <option value="">All Desigs</option>
                @foreach($designations as $desig)
                    <option value="{{ $desig->id }}" {{ request('designation_id') == $desig->id ? 'selected' : '' }}>{{ $desig->title }}</option>
                @endforeach
            </select>

            <select name="status" class="sa-form-control" style="max-width: 100px;">
                <option value="">Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button type="submit" class="sa-btn sa-btn-primary">Filter</button>
            @if(request('search') || request('school_id') || request('status') || request('role_id') || request('department_id') || request('designation_id'))
                <a href="{{ route('superadmin.tenant.staff') }}" class="sa-btn sa-btn-outline">Clear</a>
            @endif
        </form>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School (Tenant)</th>
                    <th>Staff Name</th>
                    <th>Dept / Desig</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($staffs as $staff)
                <tr>
                    <td style="color: var(--sa-text-primary); font-weight: 500;">{{ $staff->school->school_name ?? 'N/A' }}</td>
                    <td>
                        <strong>{{ $staff->full_name }}</strong><br>
                        <small class="text-muted">{{ $staff->email }}</small>
                    </td>
                    <td>
                        <small>{{ $staff->departments->name ?? 'N/A' }}</small><br>
                        <small style="color: var(--sa-primary);">{{ $staff->designations->title ?? 'N/A' }}</small>
                    </td>
                    <td><span class="sa-badge" style="background: rgba(102,126,234,0.1);">{{ $staff->roles->name ?? 'Staff' }}</span></td>
                    <td>
                        @php
                            $permissionCount = $staff->roles ? $staff->roles->saasAssignments->count() : 0;
                        @endphp
                        <button type="button" class="sa-btn sa-btn-outline sa-btn-sm" onclick="showPermissions('{{ $staff->id }}')">
                            <i class="fas fa-key"></i> {{ $permissionCount }} Active
                        </button>

                        <!-- Modal Content (Hidden) -->
                        <div id="perm-data-{{ $staff->id }}" style="display:none;">
                            @if($staff->roles && $staff->roles->saasAssignments->count() > 0)
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    @foreach($staff->roles->saasAssignments as $assign)
                                        <div style="font-size: 11px; padding: 4px 8px; background: rgba(255,255,255,0.05); border-radius: 4px;">
                                            <i class="fas fa-check-circle text-success"></i> 
                                            {{ $assign->permissionInfo->name ?? 'Permission ID: '.$assign->permission_id }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No specific permissions assigned to this role.</p>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($staff->active_status)
                            <span class="sa-badge sa-badge-success">Active</span>
                        @else
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="sa-empty-state">No staff members found across the SaaS network.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Shell -->
    <div id="permissionModal" class="sa-modal-overlay" style="display:none;">
        <div class="sa-modal-content">
            <div class="sa-modal-header">
                <h3 id="modalTitle">Staff Permissions Audit</h3>
                <button type="button" class="sa-modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div id="modalBody" class="sa-modal-body">
                <!-- Data injected here -->
            </div>
        </div>
    </div>

    <style>
        .sa-modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sa-modal-content {
            background: var(--sa-bg-card);
            border: 1px solid var(--sa-border);
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }
        .sa-modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--sa-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sa-modal-body { padding: 20px; }
        .sa-modal-close {
            background: none; border: none; color: #fff; font-size: 24px; cursor: pointer;
        }
    </style>

    <script>
        function showPermissions(staffId) {
            const data = document.getElementById('perm-data-' + staffId).innerHTML;
            document.getElementById('modalBody').innerHTML = data;
            document.getElementById('permissionModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('permissionModal').style.display = 'none';
        }
    </script>
    
    <div style="margin-top: 20px;">
        {{ $staffs->links() }}
    </div>
</div>
@endsection
