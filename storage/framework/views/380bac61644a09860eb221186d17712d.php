<?php $__env->startSection('title', 'Communicate'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <!-- Send Email -->
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title"><i class="fas fa-envelope" style="color: var(--sa-primary);"></i> Send Email</span>
            </div>
            <form action="<?php echo e(route('superadmin.communicate.send-email')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="sa-form-group">
                    <label class="sa-form-label">Recipients</label>
                    <select name="recipients" class="sa-form-control" id="emailRecipientType" onchange="toggleSchoolSelect('email')">
                        <option value="all">All Active Schools</option>
                        <option value="selected">Select Schools</option>
                    </select>
                </div>
                <div class="sa-form-group" id="emailSchoolSelect" style="display: none;">
                    <label class="sa-form-label">Select Schools</label>
                    <select name="school_ids[]" class="sa-form-control" multiple style="height: 120px;">
                        <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($school->id); ?>"><?php echo e($school->school_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <small style="color: var(--sa-text-muted);">Hold Ctrl/Cmd to select multiple</small>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Subject *</label>
                    <input type="text" name="subject" class="sa-form-control" required>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Message *</label>
                    <textarea name="message" class="sa-form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-paper-plane"></i> Send Email</button>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Send Platform Notice -->
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title"><i class="fas fa-bullhorn" style="color: var(--sa-warning);"></i> Platform Notice</span>
            </div>
            <form action="<?php echo e(route('superadmin.communicate.send-notice')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="sa-form-group">
                    <label class="sa-form-label">Notice Type</label>
                    <select name="type" class="sa-form-control">
                        <option value="info">Information</option>
                        <option value="warning">Warning</option>
                        <option value="critical">Critical</option>
                    </select>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Title *</label>
                    <input type="text" name="title" class="sa-form-control" required>
                </div>
                <div class="sa-form-group">
                    <label class="sa-form-label">Message *</label>
                    <textarea name="message" class="sa-form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="sa-btn sa-btn-primary"><i class="fas fa-bullhorn"></i> Publish Notice</button>
            </form>
        </div>
    </div>
</div>

<!-- Communication History -->
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Communication History</span>
    </div>
    <table class="sa-table">
        <thead><tr><th>Type</th><th>Description</th><th>Time</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $sentMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><span class="sa-badge sa-badge-info"><?php echo e($msg->entity_type ?? 'N/A'); ?></span></td>
                    <td><?php echo e($msg->description); ?></td>
                    <td style="white-space: nowrap;"><?php echo e($msg->created_at->diffForHumans()); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="3" style="text-align: center; color: var(--sa-text-muted); padding: 30px;">No communications sent yet</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function toggleSchoolSelect(type) {
    const selector = document.getElementById(type + 'RecipientType');
    const schoolSelect = document.getElementById(type + 'SchoolSelect');
    schoolSelect.style.display = selector.value === 'selected' ? 'block' : 'none';
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/communicate/index.blade.php ENDPATH**/ ?>