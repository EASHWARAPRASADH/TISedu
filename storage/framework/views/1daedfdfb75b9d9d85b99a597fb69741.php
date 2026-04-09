<?php $__env->startSection('title', 'Admin Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">SuperAdmin Users</span>
        <a href="<?php echo e(route('superadmin.users.create')); ?>" class="sa-btn sa-btn-primary"><i class="fas fa-plus"></i> Add User</a>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Last Login</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($user->full_name); ?></td>
                    <td><?php echo e($user->username); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><span class="sa-badge sa-badge-info"><?php echo e(ucfirst(str_replace('_', ' ', $user->role))); ?></span></td>
                    <td>
                        <?php if($user->active_status): ?>
                            <span class="sa-badge sa-badge-success">Active</span>
                        <?php else: ?>
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never'); ?></td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="<?php echo e(route('superadmin.users.edit', $user->id)); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="<?php echo e(route('superadmin.users.toggle-status', $user->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="sa-btn sa-btn-sm <?php echo e($user->active_status ? 'sa-btn-danger' : 'sa-btn-success'); ?>">
                                    <i class="fas <?php echo e($user->active_status ? 'fa-ban' : 'fa-check'); ?>"></i>
                                </button>
                            </form>
                            <form action="<?php echo e(route('superadmin.users.destroy', $user->id)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="sa-btn sa-btn-danger sa-btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No users found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(method_exists($users, 'links')): ?>
        <div class="sa-pagination"><?php echo e($users->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/users/index.blade.php ENDPATH**/ ?>