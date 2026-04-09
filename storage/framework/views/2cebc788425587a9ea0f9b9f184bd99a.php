<?php $__env->startSection('title', 'Global SaaS Students'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Master Roster: Students</span>
        <a href="<?php echo e(route('superadmin-dashboard')); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>

    <div style="margin-bottom: 20px;">
        <form action="<?php echo e(route('superadmin.tenant.students')); ?>" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="search" class="sa-form-control" placeholder="Search by name, email..." value="<?php echo e(request('search')); ?>" style="max-width: 250px;">
            <select name="school_id" class="sa-form-control" style="max-width: 200px;">
                <option value="">All Schools</option>
                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($school->id); ?>" <?php echo e(request('school_id') == $school->id ? 'selected' : ''); ?>><?php echo e($school->school_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="status" class="sa-form-control" style="max-width: 150px;">
                <option value="">All Status</option>
                <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
            </select>
            <button type="submit" class="sa-btn sa-btn-primary">Filter</button>
            <?php if(request('search') || request('school_id') || request('status')): ?>
                <a href="<?php echo e(route('superadmin.tenant.students')); ?>" class="sa-btn sa-btn-outline">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School (Tenant)</th>
                    <th>Student Name</th>
                    <th>Admission No</th>
                    <th>Class / Section</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($student->school->school_name ?? 'N/A'); ?></td>
                    <td><?php echo e($student->full_name); ?></td>
                    <td><?php echo e($student->admission_no); ?></td>
                    <td>
                        <?php echo e($student->class->class_name ?? 'N/A'); ?> 
                        <?php if(isset($student->section)): ?>
                            (<?php echo e($student->section->section_name); ?>)
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($student->active_status): ?>
                            <span class="sa-badge sa-badge-success">Active</span>
                        <?php else: ?>
                            <span class="sa-badge sa-badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="sa-empty-state">No students found across the SaaS network.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        <?php echo e($students->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/tenantUsers/students.blade.php ENDPATH**/ ?>