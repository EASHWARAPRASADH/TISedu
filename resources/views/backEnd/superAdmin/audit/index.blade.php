@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Audit Logs')

@section('content')
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Audit Logs</span>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('superadmin.audit.export', request()->query()) }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-download"></i> Export CSV</a>
        </div>
    </div>

    <!-- Filters -->
    <form action="{{ route('superadmin.audit.index') }}" method="GET" style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px;">
        <select name="action" class="sa-form-control" style="width: 150px;">
            <option value="">All Actions</option>
            @foreach($actions as $action)
                <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>{{ ucfirst($action) }}</option>
            @endforeach
        </select>
        <select name="entity_type" class="sa-form-control" style="width: 150px;">
            <option value="">All Entities</option>
            @foreach($entityTypes as $type)
                <option value="{{ $type }}" {{ request('entity_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
        <input type="date" name="from_date" class="sa-form-control" style="width: 150px;" value="{{ request('from_date') }}" placeholder="From">
        <input type="date" name="to_date" class="sa-form-control" style="width: 150px;" value="{{ request('to_date') }}" placeholder="To">
        <input type="text" name="search" class="sa-form-control" style="width: 200px;" value="{{ request('search') }}" placeholder="Search...">
        <button type="submit" class="sa-btn sa-btn-primary sa-btn-sm"><i class="fas fa-filter"></i> Filter</button>
        <a href="{{ route('superadmin.audit.index') }}" class="sa-btn sa-btn-outline sa-btn-sm">Reset</a>
    </form>

    <table class="sa-table">
        <thead>
            <tr>
                <th>Time</th>
                <th>Admin</th>
                <th>Action</th>
                <th>Entity</th>
                <th>Description</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td style="white-space: nowrap;">{{ $log->created_at->format('M d, H:i') }}</td>
                    <td style="font-weight: 500;">{{ $log->superAdmin->username ?? 'Unknown' }}</td>
                    <td>
                        @php
                            $actionColors = [
                                'login' => 'success', 'logout' => 'info', 'created' => 'info',
                                'updated' => 'warning', 'deleted' => 'danger', 'status_changed' => 'warning',
                                'module_toggled' => 'info', 'cache_cleared' => 'info',
                            ];
                            $badgeClass = $actionColors[$log->action] ?? 'info';
                        @endphp
                        <span class="sa-badge sa-badge-{{ $badgeClass }}">{{ ucfirst($log->action) }}</span>
                    </td>
                    <td>{{ $log->entity_type ?? '-' }}</td>
                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $log->description ?? '-' }}</td>
                    <td style="font-family: monospace; font-size: 12px;">{{ $log->ip_address ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No audit logs found</td></tr>
            @endforelse
        </tbody>
    </table>

    @if(method_exists($logs, 'links'))
        <div class="sa-pagination">{{ $logs->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection
