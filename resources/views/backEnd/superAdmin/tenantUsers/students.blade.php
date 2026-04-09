@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Global SaaS Students')

@section('content')
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Master Roster: Students</span>
        <a href="{{ route('superadmin-dashboard') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div style="margin-bottom: 20px;">
        <form action="{{ route('superadmin.tenant.students') }}" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 8px;">
            <input type="text" name="search" class="sa-form-control" placeholder="Name/Email/Adm..." value="{{ request('search') }}" style="max-width: 150px;">
            
            <select name="school_id" class="sa-form-control" style="max-width: 150px;" onchange="this.form.submit()">
                <option value="">All Schools</option>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}" {{ request('school_id') == $school->id ? 'selected' : '' }}>{{ $school->school_name }}</option>
                @endforeach
            </select>

            <select name="class_id" class="sa-form-control" style="max-width: 120px;" {{ !request('school_id') ? 'disabled' : '' }} onchange="this.form.submit()">
                <option value="">All Classes</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>{{ $class->class_name }}</option>
                @endforeach
            </select>

            <select name="section_id" class="sa-form-control" style="max-width: 120px;" {{ !request('class_id') ? 'disabled' : '' }}>
                <option value="">All Sections</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>{{ $section->section_name }}</option>
                @endforeach
            </select>

            <select name="gender_id" class="sa-form-control" style="max-width: 110px;">
                <option value="">Gender</option>
                @foreach($genders as $gender)
                    <option value="{{ $gender->id }}" {{ request('gender_id') == $gender->id ? 'selected' : '' }}>{{ $gender->base_setup_name }}</option>
                @endforeach
            </select>

            <select name="status" class="sa-form-control" style="max-width: 110px;">
                <option value="">Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button type="submit" class="sa-btn sa-btn-primary">Filter</button>
            @if(request('search') || request('school_id') || request('class_id') || request('section_id') || request('gender_id') || request('status'))
                <a href="{{ route('superadmin.tenant.students') }}" class="sa-btn sa-btn-outline">Clear</a>
            @endif
        </form>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School (Tenant)</th>
                    <th>Student Name</th>
                    <th>Admission No</th>
                    <th>Class / Section</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td style="color: var(--sa-text-primary); font-weight: 500;">{{ $student->school->school_name ?? 'N/A' }}</td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->admission_no }}</td>
                    <td>
                        {{ $student->class->class_name ?? 'N/A' }} 
                        @if(isset($student->section))
                            ({{ $student->section->section_name }})
                        @endif
                    </td>
                    <td>
                        @if($student->active_status)
                            <span class="sa-badge sa-badge-success">Active</span>
                        @else
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="sa-empty-state">No students found across the SaaS network.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $students->links() }}
    </div>
</div>
@endsection
