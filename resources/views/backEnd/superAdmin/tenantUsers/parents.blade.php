@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Global SaaS Parents')

@section('content')
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Master Roster: Parents</span>
        <a href="{{ route('superadmin-dashboard') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div style="margin-bottom: 20px;">
        <form action="{{ route('superadmin.tenant.parents') }}" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 8px;">
            <input type="text" name="search" class="sa-form-control" placeholder="Name/Email..." value="{{ request('search') }}" style="max-width: 150px;">
            
            <input type="text" name="occupation" class="sa-form-control" placeholder="Occupation..." value="{{ request('occupation') }}" style="max-width: 150px;">

            <select name="school_id" class="sa-form-control" style="max-width: 200px;">
                <option value="">All Schools</option>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}" {{ request('school_id') == $school->id ? 'selected' : '' }}>{{ $school->school_name }}</option>
                @endforeach
            </select>
            
            <select name="status" class="sa-form-control" style="max-width: 150px;">
                <option value="">Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            
            <button type="submit" class="sa-btn sa-btn-primary">Filter</button>
            @if(request('search') || request('school_id') || request('status') || request('occupation'))
                <a href="{{ route('superadmin.tenant.parents') }}" class="sa-btn sa-btn-outline">Clear</a>
            @endif
        </form>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School (Tenant)</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Guardian Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($parents as $parent)
                <tr>
                    <td style="color: var(--sa-text-primary); font-weight: 500;">{{ $parent->school->school_name ?? 'N/A' }}</td>
                    <td>{{ $parent->fathers_name ?: 'N/A' }}</td>
                    <td>{{ $parent->mothers_name ?: 'N/A' }}</td>
                    <td>{{ $parent->guardians_email ?: $parent->guardians_mobile }}</td>
                    <td>
                        @if($parent->active_status)
                            <span class="sa-badge sa-badge-success">Active</span>
                        @else
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="sa-empty-state">No parents found across the SaaS network.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $parents->links() }}
    </div>
</div>
@endsection
