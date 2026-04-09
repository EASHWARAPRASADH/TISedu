<?php $__env->startSection('title', 'Impersonate School'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">School Impersonation</span>
        <span class="sa-badge sa-badge-warning"><i class="fas fa-exclamation-triangle"></i> Admin Access</span>
    </div>

    <div style="background: rgba(251,191,36,0.08); border: 1px solid rgba(251,191,36,0.2); border-radius: 10px; padding: 14px 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-exclamation-triangle" style="color: var(--sa-warning);"></i>
        <span style="font-size: 13px; color: var(--sa-text-secondary);">
            Impersonation allows you to log in as a school's admin. All actions performed will be under the school admin's identity. Use responsibly.
        </span>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 12px;">
        <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background: var(--sa-bg-dark); border: 1px solid var(--sa-border); border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 14px; font-weight: 600; color: var(--sa-text-primary);"><?php echo e($school->school_name); ?></div>
                    <div style="font-size: 12px; color: var(--sa-text-muted);"><?php echo e($school->email); ?></div>
                </div>
                <form action="<?php echo e(route('superadmin.impersonate.start', $school->id)); ?>" method="POST" onsubmit="return confirm('Impersonate as admin of <?php echo e($school->school_name); ?>?')">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="sa-btn sa-btn-outline sa-btn-sm">
                        <i class="fas fa-sign-in-alt"></i> Enter
                    </button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/impersonate/index.blade.php ENDPATH**/ ?>