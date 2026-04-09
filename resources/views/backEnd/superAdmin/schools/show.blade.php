@extends('backEnd.superAdmin.layouts.master')
@section('title', 'School Details')

@section('content')
<div class="sa-card" style="max-width: 800px;">
    <div class="sa-card-header">
        <span class="sa-card-title">{{ $school->school_name }}</span>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('superadmin.school.edit', $school->id) }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-edit"></i> Edit</a>
            <a href="{{ route('superadmin.school-list') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 24px;">
        <div class="col-md-3">
            <div class="sa-stat-card">
                <div class="sa-stat-icon students"><i class="fas fa-user-graduate"></i></div>
                <div>
                    <div class="sa-stat-value" style="font-size: 20px;">{{ $stats['students'] }}</div>
                    <div class="sa-stat-label">Students</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="sa-stat-card">
                <div class="sa-stat-icon staff"><i class="fas fa-chalkboard-teacher"></i></div>
                <div>
                    <div class="sa-stat-value" style="font-size: 20px;">{{ $stats['staff'] }}</div>
                    <div class="sa-stat-label">Staff</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="sa-stat-card">
                <div class="sa-stat-icon schools"><i class="fas fa-chalkboard"></i></div>
                <div>
                    <div class="sa-stat-value" style="font-size: 20px;">{{ $stats['classes'] }}</div>
                    <div class="sa-stat-label">Classes</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="sa-stat-card">
                <div class="sa-stat-icon revenue"><i class="fas fa-layer-group"></i></div>
                <div>
                    <div class="sa-stat-value" style="font-size: 20px;">{{ $stats['sections'] }}</div>
                    <div class="sa-stat-label">Sections</div>
                </div>
            </div>
        </div>
    </div>

    <div class="sa-health-row"><span class="sa-health-key">Email</span><span class="sa-health-val">{{ $school->email }}</span></div>
    <div class="sa-health-row"><span class="sa-health-key">Phone</span><span class="sa-health-val">{{ $school->phone ?? 'N/A' }}</span></div>
    <div class="sa-health-row"><span class="sa-health-key">Address</span><span class="sa-health-val">{{ $school->address ?? 'N/A' }}</span></div>
    <div class="sa-health-row"><span class="sa-health-key">Status</span><span class="sa-health-val">
        @if($school->active_status) <span class="sa-badge sa-badge-success">Active</span>
        @else <span class="sa-badge sa-badge-danger">Inactive</span> @endif
    </span></div>
    <div class="sa-health-row"><span class="sa-health-key">Created</span><span class="sa-health-val">{{ $school->created_at ? $school->created_at->format('M d, Y H:i') : 'N/A' }}</span></div>
</div>
@endsection
