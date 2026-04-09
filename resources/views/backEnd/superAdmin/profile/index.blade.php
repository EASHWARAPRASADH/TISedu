@extends('backEnd.superAdmin.layouts.master')
@section('title', 'My Profile')

@section('content')
<div class="row">
    <!-- Profile Info -->
    <div class="col-md-8">
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title">Profile Information</span>
            </div>
            <form action="{{ route('superadmin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Full Name *</label>
                            <input type="text" name="full_name" class="sa-form-control" value="{{ $superAdmin->full_name }}" required>
                            @error('full_name') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Email *</label>
                            <input type="email" name="email" class="sa-form-control" value="{{ $superAdmin->email }}" required>
                            @error('email') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="sa-form-control" value="{{ $superAdmin->phone_number }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Avatar</label>
                            <input type="file" name="avatar" class="sa-form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-save"></i> Update Profile</button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title">Change Password</span>
            </div>
            <form action="{{ route('superadmin.profile.change-password') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Current Password *</label>
                            <input type="password" name="current_password" class="sa-form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sa-form-group">
                            <label class="sa-form-label">New Password *</label>
                            <input type="password" name="new_password" class="sa-form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Confirm Password *</label>
                            <input type="password" name="new_password_confirmation" class="sa-form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="sa-btn sa-btn-danger"><i class="fas fa-key"></i> Change Password</button>
            </form>
        </div>
    </div>

    <!-- Side Panel -->
    <div class="col-md-4">
        <div class="sa-card" style="margin-bottom: 20px; text-align: center;">
            <div class="sa-user-avatar" style="width: 80px; height: 80px; font-size: 28px; margin: 0 auto 16px;">
                {{ strtoupper(substr($superAdmin->full_name, 0, 2)) }}
            </div>
            <h5 style="font-weight: 700; margin-bottom: 4px;">{{ $superAdmin->full_name }}</h5>
            <p style="color: var(--sa-text-muted); font-size: 13px; margin-bottom: 12px;">{{ $superAdmin->email }}</p>
            <span class="sa-badge sa-badge-info">{{ ucfirst(str_replace('_', ' ', $superAdmin->role)) }}</span>

            <div style="margin-top: 20px; text-align: left;">
                <div class="sa-health-row"><span class="sa-health-key">Username</span><span class="sa-health-val">{{ $superAdmin->username }}</span></div>
                <div class="sa-health-row"><span class="sa-health-key">Phone</span><span class="sa-health-val">{{ $superAdmin->phone_number ?? 'N/A' }}</span></div>
                <div class="sa-health-row"><span class="sa-health-key">Last Login</span><span class="sa-health-val">{{ $superAdmin->last_login_at ? $superAdmin->last_login_at->diffForHumans() : 'N/A' }}</span></div>
                <div class="sa-health-row"><span class="sa-health-key">Last IP</span><span class="sa-health-val" style="font-family: monospace; font-size: 12px;">{{ $superAdmin->last_login_ip ?? 'N/A' }}</span></div>
                <div class="sa-health-row"><span class="sa-health-key">Created</span><span class="sa-health-val">{{ $superAdmin->created_at ? $superAdmin->created_at->format('M d, Y') : 'N/A' }}</span></div>
            </div>
        </div>

        <div class="sa-card">
            <div class="sa-card-header">
                <span class="sa-card-title">Recent Activity</span>
            </div>
            @forelse($recentActivity as $activity)
                <div style="padding: 8px 0; border-bottom: 1px solid var(--sa-border); font-size: 12px;">
                    <div style="color: var(--sa-text-secondary);">{{ $activity->description ?? $activity->action }}</div>
                    <div style="color: var(--sa-text-muted); margin-top: 2px;">{{ $activity->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <p style="color: var(--sa-text-muted); font-size: 13px;">No recent activity</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
