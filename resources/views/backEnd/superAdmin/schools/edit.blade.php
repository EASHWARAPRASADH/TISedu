@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Edit School')

@section('content')
<div class="sa-card" style="max-width: 700px;">
    <div class="sa-card-header">
        <span class="sa-card-title">Edit School: {{ $school->school_name }}</span>
        <a href="{{ route('superadmin.school-list') }}" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <form action="{{ route('superadmin.school.update', $school->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="sa-form-group">
                    <label class="sa-form-label">School Name *</label>
                    <input type="text" name="school_name" class="sa-form-control" value="{{ old('school_name', $school->school_name) }}" required>
                    @error('school_name') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Email *</label>
                    <input type="email" name="email" class="sa-form-control" value="{{ old('email', $school->email) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Phone</label>
                    <input type="text" name="phone" class="sa-form-control" value="{{ old('phone', $school->phone) }}">
                </div>
            </div>

            <div class="col-md-12">
                <hr style="border-color: rgba(255,255,255,0.05); margin: 20px 0;">
                <h6 style="color: var(--sa-text-muted); margin-bottom: 15px; font-weight: 500;">
                    <i class="fas fa-network-wired" style="margin-right: 8px;"></i> Routing Settings (SaaS)
                </h6>
            </div>
            
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">System Subdomain *</label>
                    <div style="display: flex; align-items: center; background: rgba(0,0,0,0.2); border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); overflow: hidden;">
                        <input type="text" name="domain" class="sa-form-control" value="{{ old('domain', $school->domain) }}" required style="border: none; border-radius: 0; background: transparent; padding-right: 5px; text-align: right;" placeholder="schoolname">
                        <span style="color: var(--sa-text-muted); padding: 0 12px; font-size: 13px; font-family: monospace;">.{{ preg_replace('#^https?://#', '', rtrim(env('APP_URL', 'localhost'), '/')) }}</span>
                    </div>
                    @error('domain') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="sa-form-group">
                    <label class="sa-form-label">Custom Domain</label>
                    <input type="text" name="custom_domain" class="sa-form-control" value="{{ old('custom_domain', $school->custom_domain) }}" placeholder="e.g., erp.myschool.com">
                    @error('custom_domain') <small style="color: var(--sa-danger);">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="sa-form-group">
                    <label class="sa-form-label">Address</label>
                    <textarea name="address" class="sa-form-control" rows="3">{{ old('address', $school->address) }}</textarea>
                </div>
            </div>
        </div>
        <div style="display: flex; gap: 12px; margin-top: 12px;">
            <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-save"></i> Update School</button>
            <a href="{{ route('superadmin.school-list') }}" class="sa-btn sa-btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
