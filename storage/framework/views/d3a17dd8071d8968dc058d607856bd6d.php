<?php $__env->startSection('title', 'School Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">School Report</span>
        <div style="display: flex; gap: 8px;">
            <a href="<?php echo e(route('superadmin.reports.schools.export')); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-download"></i> Export CSV</a>
            <a href="<?php echo e(route('superadmin.reports.index')); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>#</th>
                <th>School</th>
                <th>Email</th>
                <th>Students</th>
                <th>Staff</th>
                <th>Parents</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($school->id); ?></td>
                    <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($school->school_name); ?></td>
                    <td><?php echo e($school->email); ?></td>
                    <td><?php echo e(number_format($school->student_count)); ?></td>
                    <td><?php echo e(number_format($school->staff_count)); ?></td>
                    <td><?php echo e(number_format($school->parent_count)); ?></td>
                    <td>
                        <?php if($school->active_status): ?>
                            <span class="sa-badge sa-badge-success">Active</span>
                        <?php else: ?>
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/reports/school_report.blade.php ENDPATH**/ ?>