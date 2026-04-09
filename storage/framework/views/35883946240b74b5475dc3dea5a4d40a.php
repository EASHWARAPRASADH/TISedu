<?php $__env->startSection('title', 'Modules'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Module Management</span>
        <span class="sa-badge sa-badge-info"><?php echo e(count($modules)); ?> Modules</span>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 12px;">
        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background: var(--sa-bg-dark); border: 1px solid var(--sa-border); border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 10px; height: 10px; border-radius: 50%; background: <?php echo e($status ? 'var(--sa-success)' : 'var(--sa-danger)'); ?>;"></div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: var(--sa-text-primary);"><?php echo e($name); ?></div>
                        <div style="font-size: 11px; color: var(--sa-text-muted);"><?php echo e($status ? 'Enabled' : 'Disabled'); ?></div>
                    </div>
                </div>
                <form action="<?php echo e(route('superadmin.modules.toggle')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="module" value="<?php echo e($name); ?>">
                    <button type="submit" class="sa-btn sa-btn-sm <?php echo e($status ? 'sa-btn-danger' : 'sa-btn-success'); ?>">
                        <?php echo e($status ? 'Disable' : 'Enable'); ?>

                    </button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/modules/index.blade.php ENDPATH**/ ?>