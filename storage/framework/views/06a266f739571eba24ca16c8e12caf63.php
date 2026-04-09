<?php $__env->startSection('title', 'Audit Logs'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Audit Logs</span>
        <div style="display: flex; gap: 8px;">
            <a href="<?php echo e(route('superadmin.audit.export', request()->query())); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-download"></i> Export CSV</a>
        </div>
    </div>

    <!-- Filters -->
    <form action="<?php echo e(route('superadmin.audit.index')); ?>" method="GET" style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px;">
        <select name="action" class="sa-form-control" style="width: 150px;">
            <option value="">All Actions</option>
            <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($action); ?>" <?php echo e(request('action') == $action ? 'selected' : ''); ?>><?php echo e(ucfirst($action)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="entity_type" class="sa-form-control" style="width: 150px;">
            <option value="">All Entities</option>
            <?php $__currentLoopData = $entityTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($type); ?>" <?php echo e(request('entity_type') == $type ? 'selected' : ''); ?>><?php echo e($type); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="date" name="from_date" class="sa-form-control" style="width: 150px;" value="<?php echo e(request('from_date')); ?>" placeholder="From">
        <input type="date" name="to_date" class="sa-form-control" style="width: 150px;" value="<?php echo e(request('to_date')); ?>" placeholder="To">
        <input type="text" name="search" class="sa-form-control" style="width: 200px;" value="<?php echo e(request('search')); ?>" placeholder="Search...">
        <button type="submit" class="sa-btn sa-btn-primary sa-btn-sm"><i class="fas fa-filter"></i> Filter</button>
        <a href="<?php echo e(route('superadmin.audit.index')); ?>" class="sa-btn sa-btn-outline sa-btn-sm">Reset</a>
    </form>

    <table class="sa-table">
        <thead>
            <tr>
                <th>Time</th>
                <th>Admin</th>
                <th>Action</th>
                <th>Entity</th>
                <th>Description</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="white-space: nowrap;"><?php echo e($log->created_at->format('M d, H:i')); ?></td>
                    <td style="font-weight: 500;"><?php echo e($log->superAdmin->username ?? 'Unknown'); ?></td>
                    <td>
                        <?php
                            $actionColors = [
                                'login' => 'success', 'logout' => 'info', 'created' => 'info',
                                'updated' => 'warning', 'deleted' => 'danger', 'status_changed' => 'warning',
                                'module_toggled' => 'info', 'cache_cleared' => 'info',
                            ];
                            $badgeClass = $actionColors[$log->action] ?? 'info';
                        ?>
                        <span class="sa-badge sa-badge-<?php echo e($badgeClass); ?>"><?php echo e(ucfirst($log->action)); ?></span>
                    </td>
                    <td><?php echo e($log->entity_type ?? '-'); ?></td>
                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo e($log->description ?? '-'); ?></td>
                    <td style="font-family: monospace; font-size: 12px;"><?php echo e($log->ip_address ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No audit logs found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if(method_exists($logs, 'links')): ?>
        <div class="sa-pagination"><?php echo e($logs->appends(request()->query())->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/audit/index.blade.php ENDPATH**/ ?>