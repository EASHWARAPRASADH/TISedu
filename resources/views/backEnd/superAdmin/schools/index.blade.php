@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Schools')

@section('content')
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">School Management</span>
        <div style="display: flex; gap: 10px;">
            <form action="{{ route('superadmin.school-list') }}" method="GET" style="display: flex; gap: 8px;">
                <input type="text" name="search" class="sa-form-control" placeholder="Search schools..." value="{{ request('search') }}" style="width: 200px;">
                <select name="status" class="sa-form-control" style="width: 120px;" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-search"></i></button>
            </form>
            <a href="{{ route('superadmin.school.create') }}" class="sa-btn sa-btn-primary"><i class="fas fa-plus"></i> Add School</a>
        </div>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>#</th>
                <th>School Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schools as $school)
                <tr>
                    <td>{{ $school->id }}</td>
                    <td style="color: var(--sa-text-primary); font-weight: 500;">{{ $school->school_name }}</td>
                    <td>{{ $school->email }}</td>
                    <td>{{ $school->phone ?? 'N/A' }}</td>
                    <td>
                        @if($school->active_status)
                            <span class="sa-badge sa-badge-success">Active</span>
                        @else
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="{{ route('superadmin.school.show', $school->id) }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('superadmin.school.edit', $school->id) }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('superadmin.school.toggle-status') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $school->id }}">
                                <button type="submit" class="sa-btn sa-btn-sm {{ $school->active_status ? 'sa-btn-danger' : 'sa-btn-success' }}">
                                    <i class="fas {{ $school->active_status ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('superadmin.school.destroy', $school->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this school?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="sa-btn sa-btn-danger sa-btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No schools found</td></tr>
            @endforelse
        </tbody>
    </table>
    @if(method_exists($schools, 'links'))
        <div class="sa-pagination">{{ $schools->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection
