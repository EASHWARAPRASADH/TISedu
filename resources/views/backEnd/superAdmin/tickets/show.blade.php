@extends('backEnd.superAdmin.layouts.master')
@section('title', 'Ticket #' . $ticket->id)

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</h2>
    <a href="{{ route('superadmin.tickets.index') }}" class="sa-btn sa-btn-outline"><i class="fas fa-arrow-left"></i> Back to Tickets</a>
</div>

<div class="row">
    <!-- Ticket Conversation Column -->
    <div class="col-md-8">
        <div class="sa-card" style="margin-bottom: 20px; background: rgba(0,0,0,0.1); border-left: 3px solid var(--sa-primary);">
            <div style="display: flex; gap: 15px;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--sa-primary); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px;">
                    C
                </div>
                <div style="flex: 1;">
                    <h5 style="margin: 0; font-size: 16px;">Client / {{ $ticket->school->school_name ?? 'School Admin' }}</h5>
                    <small style="color: var(--sa-text-muted);">{{ $ticket->created_at->format('d M Y, h:i A') }}</small>
                    <hr style="border-color: rgba(255,255,255,0.05); margin: 10px 0;">
                    <div style="line-height: 1.6;">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>
            </div>
        </div>

        @foreach($ticket->replies as $reply)
        <div class="sa-card" style="margin-bottom: 15px; border-left: 3px solid {{ $reply->is_staff ? 'var(--sa-success)' : 'var(--sa-primary)' }};">
            <div style="display: flex; gap: 15px;">
                @if($reply->is_staff)
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--sa-success); display: flex; align-items: center; justify-content: center; font-weight: bold;">
                        <i class="fas fa-headset"></i>
                    </div>
                @else
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--sa-primary); display: flex; align-items: center; justify-content: center; font-weight: bold;">
                        C
                    </div>
                @endif
                <div style="flex: 1;">
                    <h5 style="margin: 0; font-size: 16px;">
                        @if($reply->is_staff)
                            {{ $reply->superAdmin->name ?? 'Staff' }} <span class="sa-badge" style="background: var(--sa-success); font-size: 10px; padding: 2px 6px;">Staff</span>
                        @else
                            Client / {{ $ticket->school->school_name ?? 'School Admin' }}
                        @endif
                    </h5>
                    <small style="color: var(--sa-text-muted);">{{ $reply->created_at->format('d M Y, h:i A') }}</small>
                    <hr style="border-color: rgba(255,255,255,0.05); margin: 10px 0;">
                    <div style="line-height: 1.6;">
                        {!! nl2br(e($reply->reply)) !!}
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @if($ticket->status != 'closed')
        <div class="sa-card" style="margin-top: 30px;">
            <div class="sa-card-header">
                <span class="sa-card-title">Post a Reply</span>
            </div>
            <form action="{{ route('superadmin.tickets.reply', $ticket->id) }}" method="POST">
                @csrf
                <div class="sa-form-group">
                    <textarea name="reply" class="sa-form-control" rows="5" required placeholder="Type your response to the client here..."></textarea>
                </div>
                <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-reply"></i> Send Reply</button>
            </form>
        </div>
        @endif
    </div>

    <!-- Ticket Sidebar Column -->
    <div class="col-md-4">
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title">Ticket Information</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div>
                    <small style="color: var(--sa-text-muted); display: block;">Status</small>
                    @if($ticket->status == 'open')
                        <span class="sa-badge" style="background: var(--sa-warning);">Open</span>
                    @elseif($ticket->status == 'answered')
                        <span class="sa-badge" style="background: var(--sa-success);">Answered</span>
                    @elseif($ticket->status == 'closed')
                        <span class="sa-badge" style="background: var(--sa-text-muted);">Closed</span>
                    @else
                        <span class="sa-badge">{{ ucfirst($ticket->status) }}</span>
                    @endif
                </div>
                
                <div>
                    <small style="color: var(--sa-text-muted); display: block;">Priority</small>
                    @if($ticket->priority == 'urgent' || $ticket->priority == 'high')
                        <span class="sa-badge" style="background: var(--sa-danger);">{{ ucfirst($ticket->priority) }}</span>
                    @else
                        <span class="sa-badge" style="background: var(--sa-info);">{{ ucfirst($ticket->priority) }}</span>
                    @endif
                </div>

                <div>
                    <small style="color: var(--sa-text-muted); display: block;">Category</small>
                    <strong>{{ $ticket->category->name ?? 'General' }}</strong>
                </div>

                <div>
                    <small style="color: var(--sa-text-muted); display: block;">Assigned To</small>
                    <strong>{{ $ticket->assignedTo->name ?? 'Unassigned' }}</strong>
                </div>

                <div>
                    <small style="color: var(--sa-text-muted); display: block;">Tenant School</small>
                    <strong>{{ $ticket->school->school_name ?? 'N/A' }}</strong>
                    @if(isset($ticket->school))
                        <div><small>{{ $ticket->school->email }}</small></div>
                    @endif
                </div>
            </div>
        </div>

        <div class="sa-card">
            <div class="sa-card-header">
                <span class="sa-card-title">Manage Ticket</span>
            </div>
            <form action="{{ route('superadmin.tickets.status', $ticket->id) }}" method="POST">
                @csrf
                <div class="sa-form-group">
                    <label class="sa-form-label">Change Status</label>
                    <select name="status" class="sa-form-control">
                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="answered" {{ $ticket->status == 'answered' ? 'selected' : '' }}>Answered</option>
                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <button type="submit" class="sa-btn sa-btn-outline" style="width: 100%;">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
