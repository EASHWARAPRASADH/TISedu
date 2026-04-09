<?php $__env->startSection('title', 'Backups'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Database Backup Management</span>
        <form action="<?php echo e(route('superadmin.backup.create')); ?>" method="POST" style="display: inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="sa-btn sa-btn-primary" onclick="this.disabled=true; this.innerHTML='<i class=\'fas fa-spinner fa-spin\'></i> Creating...'; this.form.submit();">
                <i class="fas fa-plus"></i> Create Backup
            </button>
        </form>
    </div>

    <?php if(count($backups) > 0): ?>
        <table class="sa-table">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Size</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="font-weight: 500; font-family: monospace; font-size: 12px;">
                            <i class="fas fa-file-archive" style="color: var(--sa-primary); margin-right: 6px;"></i>
                            <?php echo e($backup['name']); ?>

                        </td>
                        <td><?php echo e($backup['size']); ?></td>
                        <td><?php echo e($backup['date']); ?></td>
                        <td>
                            <div style="display: flex; gap: 6px;">
                                <a href="<?php echo e(route('superadmin.backup.download', $backup['name'])); ?>" class="sa-btn sa-btn-outline sa-btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <form action="<?php echo e(route('superadmin.backup.destroy', $backup['name'])); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Delete this backup?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="sa-btn sa-btn-danger sa-btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <div style="text-align: center; padding: 60px 0; color: var(--sa-text-muted);">
            <i class="fas fa-database" style="font-size: 40px; margin-bottom: 16px; display: block;"></i>
            <p style="font-size: 14px;">No backups found. Create your first backup.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/backup/index.blade.php ENDPATH**/ ?>