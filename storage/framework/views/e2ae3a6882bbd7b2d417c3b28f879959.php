<?php $__env->startSection('title', 'Global SaaS Staff'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Master Roster: Staff Members</span>
        <a href="<?php echo e(route('superadmin-dashboard')); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div style="margin-bottom: 20px;">
        <form action="<?php echo e(route('superadmin.tenant.staff')); ?>" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 8px;">
            <input type="text" name="search" class="sa-form-control" placeholder="Name/Email..." value="<?php echo e(request('search')); ?>" style="max-width: 150px;">
            
            <select name="school_id" class="sa-form-control" style="max-width: 150px;" onchange="this.form.submit()">
                <option value="">All Schools</option>
                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($school->id); ?>" <?php echo e(request('school_id') == $school->id ? 'selected' : ''); ?>><?php echo e($school->school_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select name="role_id" class="sa-form-control" style="max-width: 120px;">
                <option value="">All Roles</option>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($role->id); ?>" <?php echo e(request('role_id') == $role->id ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select name="department_id" class="sa-form-control" style="max-width: 130px;" <?php echo e(!request('school_id') ? 'disabled' : ''); ?>>
                <option value="">All Depts</option>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dept->id); ?>" <?php echo e(request('department_id') == $dept->id ? 'selected' : ''); ?>><?php echo e($dept->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select name="designation_id" class="sa-form-control" style="max-width: 130px;" <?php echo e(!request('school_id') ? 'disabled' : ''); ?>>
                <option value="">All Desigs</option>
                <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($desig->id); ?>" <?php echo e(request('designation_id') == $desig->id ? 'selected' : ''); ?>><?php echo e($desig->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select name="status" class="sa-form-control" style="max-width: 100px;">
                <option value="">Status</option>
                <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
            </select>

            <button type="submit" class="sa-btn sa-btn-primary">Filter</button>
            <?php if(request('search') || request('school_id') || request('status') || request('role_id') || request('department_id') || request('designation_id')): ?>
                <a href="<?php echo e(route('superadmin.tenant.staff')); ?>" class="sa-btn sa-btn-outline">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School (Tenant)</th>
                    <th>Staff Name</th>
                    <th>Dept / Desig</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($staff->school->school_name ?? 'N/A'); ?></td>
                    <td>
                        <strong><?php echo e($staff->full_name); ?></strong><br>
                        <small class="text-muted"><?php echo e($staff->email); ?></small>
                    </td>
                    <td>
                        <small><?php echo e($staff->departments->name ?? 'N/A'); ?></small><br>
                        <small style="color: var(--sa-primary);"><?php echo e($staff->designations->title ?? 'N/A'); ?></small>
                    </td>
                    <td><span class="sa-badge" style="background: rgba(102,126,234,0.1);"><?php echo e($staff->roles->name ?? 'Staff'); ?></span></td>
                    <td>
                        <?php
                            $permissionCount = $staff->roles ? $staff->roles->saasAssignments->count() : 0;
                        ?>
                        <button type="button" class="sa-btn sa-btn-outline sa-btn-sm" onclick="showPermissions('<?php echo e($staff->id); ?>')">
                            <i class="fas fa-key"></i> <?php echo e($permissionCount); ?> Active
                        </button>

                        <!-- Modal Content (Hidden) -->
                        <div id="perm-data-<?php echo e($staff->id); ?>" style="display:none;">
                            <?php if($staff->roles && $staff->roles->saasAssignments->count() > 0): ?>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <?php $__currentLoopData = $staff->roles->saasAssignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="font-size: 11px; padding: 4px 8px; background: rgba(255,255,255,0.05); border-radius: 4px;">
                                            <i class="fas fa-check-circle text-success"></i> 
                                            <?php echo e($assign->permissionInfo->name ?? 'Permission ID: '.$assign->permission_id); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p>No specific permissions assigned to this role.</p>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <?php if($staff->active_status): ?>
                            <span class="sa-badge sa-badge-success">Active</span>
                        <?php else: ?>
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="sa-empty-state">No staff members found across the SaaS network.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Shell -->
    <div id="permissionModal" class="sa-modal-overlay" style="display:none;">
        <div class="sa-modal-content">
            <div class="sa-modal-header">
                <h3 id="modalTitle">Staff Permissions Audit</h3>
                <button type="button" class="sa-modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div id="modalBody" class="sa-modal-body">
                <!-- Data injected here -->
            </div>
        </div>
    </div>

    <style>
        .sa-modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sa-modal-content {
            background: var(--sa-bg-card);
            border: 1px solid var(--sa-border);
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }
        .sa-modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--sa-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sa-modal-body { padding: 20px; }
        .sa-modal-close {
            background: none; border: none; color: #fff; font-size: 24px; cursor: pointer;
        }
    </style>

    <script>
        function showPermissions(staffId) {
            const data = document.getElementById('perm-data-' + staffId).innerHTML;
            document.getElementById('modalBody').innerHTML = data;
            document.getElementById('permissionModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('permissionModal').style.display = 'none';
        }
    </script>
    
    <div style="margin-top: 20px;">
        <?php echo e($staffs->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/tenantUsers/staff.blade.php ENDPATH**/ ?>