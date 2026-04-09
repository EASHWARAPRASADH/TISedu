<?php $__env->startSection('title', 'Support Tickets'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">SaaS Support Helpdesk</span>
    </div>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <form action="<?php echo e(route('superadmin.tickets.index')); ?>" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <select name="status" class="sa-form-control" style="width: 150px;">
                <option value="">All Statuses</option>
                <option value="open" <?php echo e(request('status') == 'open' ? 'selected' : ''); ?>>Open</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="answered" <?php echo e(request('status') == 'answered' ? 'selected' : ''); ?>>Answered</option>
                <option value="closed" <?php echo e(request('status') == 'closed' ? 'selected' : ''); ?>>Closed</option>
            </select>
            <select name="priority" class="sa-form-control" style="width: 150px;">
                <option value="">All Priorities</option>
                <option value="low" <?php echo e(request('priority') == 'low' ? 'selected' : ''); ?>>Low</option>
                <option value="normal" <?php echo e(request('priority') == 'normal' ? 'selected' : ''); ?>>Normal</option>
                <option value="high" <?php echo e(request('priority') == 'high' ? 'selected' : ''); ?>>High</option>
                <option value="urgent" <?php echo e(request('priority') == 'urgent' ? 'selected' : ''); ?>>Urgent</option>
            </select>
            <button type="submit" class="sa-btn sa-btn-primary">Filter</button>
        </form>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tenant School</th>
                    <th>Subject</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>#<?php echo e($ticket->id); ?></td>
                    <td><?php echo e($ticket->school->school_name ?? 'Unknown'); ?></td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <strong><?php echo e($ticket->subject); ?></strong>
                    </td>
                    <td><?php echo e($ticket->category->name ?? 'General'); ?></td>
                    <td>
                        <?php if($ticket->priority == 'urgent' || $ticket->priority == 'high'): ?>
                            <span class="sa-badge" style="background: var(--sa-danger);"><?php echo e(ucfirst($ticket->priority)); ?></span>
                        <?php else: ?>
                            <span class="sa-badge" style="background: var(--sa-info);"><?php echo e(ucfirst($ticket->priority)); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($ticket->status == 'open'): ?>
                            <span class="sa-badge" style="background: var(--sa-warning);">Open</span>
                        <?php elseif($ticket->status == 'answered'): ?>
                            <span class="sa-badge" style="background: var(--sa-success);">Answered</span>
                        <?php elseif($ticket->status == 'closed'): ?>
                            <span class="sa-badge" style="background: var(--sa-text-muted);">Closed</span>
                        <?php else: ?>
                            <span class="sa-badge"><?php echo e(ucfirst($ticket->status)); ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($ticket->updated_at->diffForHumans()); ?></td>
                    <td>
                        <a href="<?php echo e(route('superadmin.tickets.show', $ticket->id)); ?>" class="sa-btn sa-btn-outline sa-btn-sm">View Ticket</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="sa-empty-state">
                        <i class="fas fa-ticket-alt"></i>
                        <p>No support tickets found.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        <?php echo e($tickets->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/tickets/index.blade.php ENDPATH**/ ?>