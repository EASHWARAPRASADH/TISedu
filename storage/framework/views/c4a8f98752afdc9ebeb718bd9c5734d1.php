<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .sa-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .sa-stat-card {
        background: var(--sa-bg-card);
        border: 1px solid var(--sa-border);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.2s ease;
    }

    .sa-stat-card:hover {
        border-color: rgba(102,126,234,0.2);
        transform: translateY(-2px);
    }

    .sa-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .sa-stat-icon.schools { background: rgba(102,126,234,0.12); color: var(--sa-primary); }
    .sa-stat-icon.students { background: rgba(52,211,153,0.12); color: var(--sa-success); }
    .sa-stat-icon.staff { background: rgba(251,191,36,0.12); color: var(--sa-warning); }
    .sa-stat-icon.revenue { background: rgba(118,75,162,0.12); color: var(--sa-secondary); }
    .sa-stat-icon.users { background: rgba(96,165,250,0.12); color: var(--sa-info); }
    .sa-stat-icon.parents { background: rgba(248,113,113,0.12); color: var(--sa-danger); }
    .sa-stat-icon.subs { background: rgba(52,211,153,0.12); color: var(--sa-success); }
    .sa-stat-icon.inactive { background: rgba(248,113,113,0.12); color: var(--sa-danger); }

    .sa-stat-value {
        font-size: 24px;
        font-weight: 800;
        color: var(--sa-text-primary);
        line-height: 1;
    }

    .sa-stat-label {
        font-size: 12px;
        color: var(--sa-text-muted);
        margin-top: 4px;
    }

    .sa-dash-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 991px) {
        .sa-dash-grid { grid-template-columns: 1fr; }
    }

    .sa-activity-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--sa-border);
    }

    .sa-activity-item:last-child { border-bottom: none; }

    .sa-activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-top: 6px;
        flex-shrink: 0;
    }

    .sa-activity-dot.login { background: var(--sa-success); }
    .sa-activity-dot.created { background: var(--sa-info); }
    .sa-activity-dot.updated { background: var(--sa-warning); }
    .sa-activity-dot.deleted { background: var(--sa-danger); }
    .sa-activity-dot.default { background: var(--sa-text-muted); }

    .sa-activity-text {
        font-size: 13px;
        color: var(--sa-text-secondary);
        line-height: 1.5;
    }

    .sa-activity-time {
        font-size: 11px;
        color: var(--sa-text-muted);
    }

    .sa-health-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid var(--sa-border);
        font-size: 13px;
    }

    .sa-health-row:last-child { border-bottom: none; }

    .sa-health-key { color: var(--sa-text-muted); }
    .sa-health-val { color: var(--sa-text-primary); font-weight: 500; }
</style>

<!-- Stats Grid -->
<div class="sa-stats-grid">
    <a href="<?php echo e(route('superadmin.school-list')); ?>" class="sa-stat-card">
        <div class="sa-stat-icon schools"><i class="fas fa-school"></i></div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($totalSchools)); ?></div>
            <div class="sa-stat-label">Total Schools</div>
        </div>
    </a>

    <a href="<?php echo e(route('superadmin.tenant.students')); ?>" class="sa-stat-card">
        <div class="sa-stat-icon students"><i class="fas fa-user-graduate"></i></div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($totalStudents)); ?></div>
            <div class="sa-stat-label">Total Students</div>
        </div>
    </a>

    <a href="<?php echo e(route('superadmin.tenant.staff')); ?>" class="sa-stat-card">
        <div class="sa-stat-icon staff"><i class="fas fa-chalkboard-teacher"></i></div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($totalStaff)); ?></div>
            <div class="sa-stat-label">Total Staff</div>
        </div>
    </a>

    <a href="<?php echo e(route('superadmin.tenant.parents')); ?>" class="sa-stat-card">
        <div class="sa-stat-icon parents"><i class="fas fa-users"></i></div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($totalParents)); ?></div>
            <div class="sa-stat-label">Total Parents</div>
        </div>
    </a>

    <a href="<?php echo e(route('superadmin.school-list', ['status' => 'active'])); ?>" class="sa-stat-card">
        <div class="sa-stat-icon schools" style="background: rgba(52,211,153,0.12);">
            <i class="fas fa-check-circle" style="color: var(--sa-success);"></i>
        </div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($activeSchools)); ?></div>
            <div class="sa-stat-label">Active Schools</div>
        </div>
    </a>

    <a href="<?php echo e(route('superadmin.school-list', ['status' => 'inactive'])); ?>" class="sa-stat-card">
        <div class="sa-stat-icon inactive"><i class="fas fa-times-circle"></i></div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($inactiveSchools)); ?></div>
            <div class="sa-stat-label">Inactive Schools</div>
        </div>
    </a>

    <a href="<?php echo e(route('superadmin.subscriptions.index')); ?>" class="sa-stat-card">
        <div class="sa-stat-icon subs"><i class="fas fa-credit-card"></i></div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($activeSubscriptions)); ?></div>
            <div class="sa-stat-label">Active Subscriptions</div>
        </div>
    </a>

    <a href="<?php echo e(route('superadmin.reports.index')); ?>" class="sa-stat-card">
        <div class="sa-stat-icon revenue"><i class="fas fa-dollar-sign"></i></div>
        <div>
            <div class="sa-stat-value"><?php echo e(number_format($totalRevenue, 2)); ?></div>
            <div class="sa-stat-label">Total Revenue</div>
        </div>
    </a>
</div>

<!-- Dashboard Grid -->
<div class="sa-dash-grid">
    <!-- Recent Activities -->
    <div class="sa-card">
        <div class="sa-card-header">
            <span class="sa-card-title">Recent Activities</span>
            <a href="<?php echo e(route('superadmin.audit.index')); ?>" class="sa-btn sa-btn-outline sa-btn-sm">View All</a>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="sa-activity-item">
                <div class="sa-activity-dot <?php echo e($activity->action ?? 'default'); ?>"></div>
                <div>
                    <div class="sa-activity-text">
                        <?php echo e($activity->description ?? $activity->action); ?>

                    </div>
                    <div class="sa-activity-time">
                        <?php echo e($activity->created_at->diffForHumans()); ?>

                        <?php if($activity->superAdmin): ?>
                            • <?php echo e($activity->superAdmin->username); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="text-align: center; padding: 40px 0; color: var(--sa-text-muted);">
                <i class="fas fa-inbox" style="font-size: 28px; margin-bottom: 12px; display: block;"></i>
                No recent activities
            </div>
        <?php endif; ?>
    </div>

    <!-- System Health -->
    <div class="sa-card">
        <div class="sa-card-header">
            <span class="sa-card-title">System Health</span>
            <span class="sa-badge sa-badge-success">Operational</span>
        </div>
        <?php $__currentLoopData = $systemHealth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-health-row">
                <span class="sa-health-key"><?php echo e(ucwords(str_replace('_', ' ', $key))); ?></span>
                <span class="sa-health-val"><?php echo e($value); ?></span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Recent Schools -->
    <div class="sa-card" style="grid-column: span 2;">
        <div class="sa-card-header">
            <span class="sa-card-title">Recent Schools</span>
            <a href="<?php echo e(route('superadmin.school-list')); ?>" class="sa-btn sa-btn-outline sa-btn-sm">View All</a>
        </div>
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentSchools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($school->school_name); ?></td>
                        <td><?php echo e($school->email); ?></td>
                        <td>
                            <?php if($school->active_status): ?>
                                <span class="sa-badge sa-badge-success">Active</span>
                            <?php else: ?>
                                <span class="sa-badge sa-badge-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($school->created_at ? $school->created_at->format('M d, Y') : 'N/A'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--sa-text-muted);">No schools found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/dashboard.blade.php ENDPATH**/ ?>