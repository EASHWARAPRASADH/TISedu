@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Communicate')

@section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Send Email -->
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title"><i class="fas fa-envelope" style="color: var(--sa-primary);"></i> Send Email</span>
            </div>
            <form action="{{ route('superadmin.communicate.send-email') }}" method="POST">
                @csrf
                <div class="sa-form-group">
                    <label class="sa-form-label">Recipients</label>
                    <select name="recipients" class="sa-form-control" id="emailRecipientType" onchange="toggleSchoolSelect('email')">
                        <option value="all">All Active Schools</option>
                        <option value="selected">Select Schools</option>
                    </select>
                </div>
                <div class="sa-form-group" id="emailSchoolSelect" style="display: none;">
                    <label class="sa-form-label">Select Schools</label>
                    <select name="school_ids[]" class="sa-form-control" multiple style="height: 120px;">
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                    <small style="color: var(--sa-text-muted);">Hold Ctrl/Cmd to select multiple</small>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Subject *</label>
                    <input type="text" name="subject" class="sa-form-control" required>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Message *</label>
                    <textarea name="message" class="sa-form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-paper-plane"></i> Send Email</button>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Send Platform Notice -->
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title"><i class="fas fa-bullhorn" style="color: var(--sa-warning);"></i> Platform Notice</span>
            </div>
            <form action="{{ route('superadmin.communicate.send-notice') }}" method="POST">
                @csrf
                <div class="sa-form-group">
                    <label class="sa-form-label">Notice Type</label>
                    <select name="type" class="sa-form-control">
                        <option value="info">Information</option>
                        <option value="warning">Warning</option>
                        <option value="critical">Critical</option>
                    </select>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Title *</label>
                    <input type="text" name="title" class="sa-form-control" required>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Message *</label>
                    <textarea name="message" class="sa-form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-bullhorn"></i> Publish Notice</button>
            </form>
        </div>
    </div>
</div>

<!-- Communication History -->
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Communication History</span>
    </div>
    <table class="sa-table">
        <thead><tr><th>Type</th><th>Description</th><th>Time</th></tr></thead>
        <tbody>
            @forelse($sentMessages as $msg)
                <tr>
                    <td><span class="sa-badge sa-badge-info">{{ $msg->entity_type ?? 'N/A' }}</span></td>
                    <td>{{ $msg->description }}</td>
                    <td style="white-space: nowrap;">{{ $msg->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr><td colspan="3" style="text-align: center; color: var(--sa-text-muted); padding: 30px;">No communications sent yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function toggleSchoolSelect(type) {
    const selector = document.getElementById(type + 'RecipientType');
    const schoolSelect = document.getElementById(type + 'SchoolSelect');
    schoolSelect.style.display = selector.value === 'selected' ? 'block' : 'none';
}
</script>
@endsection
