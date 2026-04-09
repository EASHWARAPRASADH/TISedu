<?php $__env->startSection('title', 'My Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- Profile Info -->
    <div class="col-md-8">
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title">Profile Information</span>
            </div>
            <form action="<?php echo e(route('superadmin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Full Name *</label>
                            <input type="text" name="full_name" class="sa-form-control" value="<?php echo e($superAdmin->full_name); ?>" required>
                            <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color: var(--sa-danger);"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Email *</label>
                            <input type="email" name="email" class="sa-form-control" value="<?php echo e($superAdmin->email); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color: var(--sa-danger);"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="sa-form-control" value="<?php echo e($superAdmin->phone_number); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Avatar</label>
                            <input type="file" name="avatar" class="sa-form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-save"></i> Update Profile</button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title">Change Password</span>
            </div>
            <form action="<?php echo e(route('superadmin.profile.change-password')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Current Password *</label>
                            <input type="password" name="current_password" class="sa-form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sa-form-group">
                            <label class="sa-form-label">New Password *</label>
                            <input type="password" name="new_password" class="sa-form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sa-form-group">
                            <label class="sa-form-label">Confirm Password *</label>
                            <input type="password" name="new_password_confirmation" class="sa-form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="sa-btn sa-btn-danger"><i class="fas fa-key"></i> Change Password</button>
            </form>
        </div>
    </div>

    <!-- Side Panel -->
    <div class="col-md-4">
        <div class="sa-card" style="margin-bottom: 20px; text-align: center;">
            <div class="sa-user-avatar" style="width: 80px; height: 80px; font-size: 28px; margin: 0 auto 16px;">
                <?php echo e(strtoupper(substr($superAdmin->full_name, 0, 2))); ?>

            </div>
            <h5 style="font-weight: 700; margin-bottom: 4px;"><?php echo e($superAdmin->full_name); ?></h5>
            <p style="color: var(--sa-text-muted); font-size: 13px; margin-bottom: 12px;"><?php echo e($superAdmin->email); ?></p>
            <span class="sa-badge sa-badge-info"><?php echo e(ucfirst(str_replace('_', ' ', $superAdmin->role))); ?></span>

            <div style="margin-top: 20px; text-align: left;">
                <div class="sa-health-row"><span class="sa-health-key">Username</span><span class="sa-health-val"><?php echo e($superAdmin->username); ?></span></div>
                <div class="sa-health-row"><span class="sa-health-key">Phone</span><span class="sa-health-val"><?php echo e($superAdmin->phone_number ?? 'N/A'); ?></span></div>
                <div class="sa-health-row"><span class="sa-health-key">Last Login</span><span class="sa-health-val"><?php echo e($superAdmin->last_login_at ? $superAdmin->last_login_at->diffForHumans() : 'N/A'); ?></span></div>
                <div class="sa-health-row"><span class="sa-health-key">Last IP</span><span class="sa-health-val" style="font-family: monospace; font-size: 12px;"><?php echo e($superAdmin->last_login_ip ?? 'N/A'); ?></span></div>
                <div class="sa-health-row"><span class="sa-health-key">Created</span><span class="sa-health-val"><?php echo e($superAdmin->created_at ? $superAdmin->created_at->format('M d, Y') : 'N/A'); ?></span></div>
            </div>
        </div>

        <div class="sa-card">
            <div class="sa-card-header">
                <span class="sa-card-title">Recent Activity</span>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="padding: 8px 0; border-bottom: 1px solid var(--sa-border); font-size: 12px;">
                    <div style="color: var(--sa-text-secondary);"><?php echo e($activity->description ?? $activity->action); ?></div>
                    <div style="color: var(--sa-text-muted); margin-top: 2px;"><?php echo e($activity->created_at->diffForHumans()); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="color: var(--sa-text-muted); font-size: 13px;">No recent activity</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/profile/index.blade.php ENDPATH**/ ?>