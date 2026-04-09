<?php $__env->startSection('title', 'Global SaaS Parents'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Master Roster: Parents</span>
        <a href="<?php echo e(route('superadmin-dashboard')); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div style="margin-bottom: 20px;">
        <form action="<?php echo e(route('superadmin.tenant.parents')); ?>" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 8px;">
            <input type="text" name="search" class="sa-form-control" placeholder="Name/Email..." value="<?php echo e(request('search')); ?>" style="max-width: 150px;">
            
            <input type="text" name="occupation" class="sa-form-control" placeholder="Occupation..." value="<?php echo e(request('occupation')); ?>" style="max-width: 150px;">

            <select name="school_id" class="sa-form-control" style="max-width: 200px;">
                <option value="">All Schools</option>
                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($school->id); ?>" <?php echo e(request('school_id') == $school->id ? 'selected' : ''); ?>><?php echo e($school->school_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            
            <select name="status" class="sa-form-control" style="max-width: 150px;">
                <option value="">Status</option>
                <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
            </select>
            
            <button type="submit" class="sa-btn sa-btn-primary">Filter</button>
            <?php if(request('search') || request('school_id') || request('status') || request('occupation')): ?>
                <a href="<?php echo e(route('superadmin.tenant.parents')); ?>" class="sa-btn sa-btn-outline">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School (Tenant)</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Guardian Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($parent->school->school_name ?? 'N/A'); ?></td>
                    <td><?php echo e($parent->fathers_name ?: 'N/A'); ?></td>
                    <td><?php echo e($parent->mothers_name ?: 'N/A'); ?></td>
                    <td><?php echo e($parent->guardians_email ?: $parent->guardians_mobile); ?></td>
                    <td>
                        <?php if($parent->active_status): ?>
                            <span class="sa-badge sa-badge-success">Active</span>
                        <?php else: ?>
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="sa-empty-state">No parents found across the SaaS network.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        <?php echo e($parents->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/tenantUsers/parents.blade.php ENDPATH**/ ?>