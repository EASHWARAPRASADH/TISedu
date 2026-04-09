@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Modules')

@section('content')
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Module Management</span>
        <span class="sa-badge sa-badge-info">{{ count($modules) }} Modules</span>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 12px;">
        @foreach($modules as $name => $status)
            <div style="background: var(--sa-bg-dark); border: 1px solid var(--sa-border); border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 10px; height: 10px; border-radius: 50%; background: {{ $status ? 'var(--sa-success)' : 'var(--sa-danger)' }};"></div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: var(--sa-text-primary);">{{ $name }}</div>
                        <div style="font-size: 11px; color: var(--sa-text-muted);">{{ $status ? 'Enabled' : 'Disabled' }}</div>
                    </div>
                </div>
                <form action="{{ route('superadmin.modules.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="module" value="{{ $name }}">
                    <button type="submit" class="sa-btn sa-btn-sm {{ $status ? 'sa-btn-danger' : 'sa-btn-success' }}">
                        {{ $status ? 'Disable' : 'Enable' }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
