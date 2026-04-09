@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Create Admin User')

@section('content')
<div class="sa-card" style="max-width: 700px;">
    <div class="sa-card-header">
        <span class="sa-card-title">Create New SuperAdmin User</span>
        <a href="{{ route('superadmin.users.index') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <form action="{{ route('superadmin.users.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Full Name *</label>
                    <input type="text" name="full_name" class="sa-form-control" value="{{ old('full_name') }}" required>
                    @error('full_name') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Username *</label>
                    <input type="text" name="username" class="sa-form-control" value="{{ old('username') }}" required>
                    @error('username') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Email *</label>
                    <input type="email" name="email" class="sa-form-control" value="{{ old('email') }}" required>
                    @error('email') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="sa-form-control" value="{{ old('phone_number') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Password *</label>
                    <input type="password" name="password" class="sa-form-control" required>
                    @error('password') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Confirm Password *</label>
                    <input type="password" name="password_confirmation" class="sa-form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Role</label>
                    <select name="role" class="sa-form-control">
                        <option value="admin_manager">Admin Manager</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Status</label>
                    <select name="active_status" class="sa-form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div style="display: flex; gap: 12px; margin-top: 12px;">
            <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-save"></i> Create User</button>
            <a href="{{ route('superadmin.users.index') }}" class="sa-btn sa-btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
