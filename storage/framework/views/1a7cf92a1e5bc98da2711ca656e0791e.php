<?php $__env->startSection('title', 'Schools'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">School Management</span>
        <div style="display: flex; gap: 10px;">
            <form action="<?php echo e(route('superadmin.school-list')); ?>" method="GET" style="display: flex; gap: 8px;">
                <input type="text" name="search" class="sa-form-control" placeholder="Search schools..." value="<?php echo e(request('search')); ?>" style="width: 200px;">
                <select name="status" class="sa-form-control" style="width: 120px;" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                    <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                </select>
                <button type="submit" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-search"></i></button>
            </form>
            <a href="<?php echo e(route('superadmin.school.create')); ?>" class="sa-btn sa-btn-primary"><i class="fas fa-plus"></i> Add School</a>
        </div>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>#</th>
                <th>School Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($school->id); ?></td>
                    <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($school->school_name); ?></td>
                    <td><?php echo e($school->email); ?></td>
                    <td><?php echo e($school->phone ?? 'N/A'); ?></td>
                    <td>
                        <?php if($school->active_status): ?>
                            <span class="sa-badge sa-badge-success">Active</span>
                        <?php else: ?>
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="<?php echo e(route('superadmin.school.show', $school->id)); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo e(route('superadmin.school.edit', $school->id)); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="<?php echo e(route('superadmin.school.toggle-status')); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($school->id); ?>">
                                <button type="submit" class="sa-btn sa-btn-sm <?php echo e($school->active_status ? 'sa-btn-danger' : 'sa-btn-success'); ?>">
                                    <i class="fas <?php echo e($school->active_status ? 'fa-ban' : 'fa-check'); ?>"></i>
                                </button>
                            </form>
                            <form action="<?php echo e(route('superadmin.school.destroy', $school->id)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Delete this school?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="sa-btn sa-btn-danger sa-btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No schools found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(method_exists($schools, 'links')): ?>
        <div class="sa-pagination"><?php echo e($schools->appends(request()->query())->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/schools/index.blade.php ENDPATH**/ ?>