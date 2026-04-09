@extends('backEnd.superAdmin.layouts.master')
@section('title', 'School Report')

@section('content')
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">School Report</span>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('superadmin.reports.schools.export') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-download"></i> Export CSV</a>
            <a href="{{ route('superadmin.reports.index') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>#</th>
                <th>School</th>
                <th>Email</th>
                <th>Students</th>
                <th>Staff</th>
                <th>Parents</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schools as $school)
                <tr>
                    <td>{{ $school->id }}</td>
                    <td style="color: var(--sa-text-primary); font-weight: 500;">{{ $school->school_name }}</td>
                    <td>{{ $school->email }}</td>
                    <td>{{ number_format($school->student_count) }}</td>
                    <td>{{ number_format($school->staff_count) }}</td>
                    <td>{{ number_format($school->parent_count) }}</td>
                    <td>
                        @if($school->active_status)
                            <span class="sa-badge sa-badge-success">Active</span>
                        @else
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
