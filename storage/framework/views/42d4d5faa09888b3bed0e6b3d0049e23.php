<?php $__env->startSection('title', 'Active Sessions'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card" style="margin-bottom: 20px;">
    <div class="sa-card-header">
        <span class="sa-card-title">Login History</span>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>Action</th>
                <th>Description</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $loginHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <span class="sa-badge <?php echo e($log->action === 'login' ? 'sa-badge-success' : 'sa-badge-info'); ?>">
                            <?php echo e(ucfirst($log->action)); ?>

                        </span>
                    </td>
                    <td><?php echo e($log->description); ?></td>
                    <td style="font-family: monospace; font-size: 12px;"><?php echo e($log->ip_address ?? '-'); ?></td>
                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 11px;"><?php echo e($log->user_agent ?? '-'); ?></td>
                    <td style="white-space: nowrap;"><?php echo e($log->created_at->format('M d, H:i')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No login history found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if($sessions->count() > 0): ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Active Database Sessions</span>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>Session ID</th>
                <th>IP Address</th>
                <th>Last Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="font-family: monospace; font-size: 11px;"><?php echo e(substr($session->id, 0, 20)); ?>...</td>
                    <td style="font-family: monospace;"><?php echo e($session->ip_address ?? 'N/A'); ?></td>
                    <td><?php echo e($session->last_activity_formatted); ?></td>
                    <td>
                        <form action="<?php echo e(route('superadmin.profile.terminate-session')); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="session_id" value="<?php echo e($session->id); ?>">
                            <button type="submit" class="sa-btn sa-btn-danger sa-btn-sm" onclick="return confirm('Terminate this session?')">
                                <i class="fas fa-times"></i> Terminate
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/profile/sessions.blade.php ENDPATH**/ ?>