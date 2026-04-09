<?php $__env->startSection('title', 'SaaS Subscriptions'); ?>

<?php $__env->startSection('content'); ?>
<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">SaaS Subscription Control Center</span>
        <div class="sa-card-tools">
            <form action="<?php echo e(route('superadmin.subscriptions.index')); ?>" method="GET" style="display: flex; gap: 8px;">
                <input type="text" name="search" class="sa-form-control sa-form-control-sm" placeholder="Search schools..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="sa-btn sa-btn-primary sa-btn-sm">Search</button>
            </form>
        </div>
    </div>

    <div class="sa-table-responsive">
        <table class="sa-table">
            <thead>
                <tr>
                    <th>School (Tenant)</th>
                    <th>Plan Type</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Quick Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $expiry = $school->ending_date ? \Carbon\Carbon::parse($school->ending_date) : null;
                    $isExpired = $expiry ? $expiry->isPast() : false;
                    $isNear = $expiry ? $expiry->diffInDays(now()) <= 7 && !$isExpired : false;
                ?>
                <tr>
                    <td>
                        <strong><?php echo e($school->school_name); ?></strong><br>
                        <small class="text-muted"><?php echo e($school->email); ?></small>
                    </td>
                    <td>
                        <span class="sa-badge" style="background: rgba(102,126,234,0.1);"><?php echo e($school->plan_type ?: 'Standard'); ?></span>
                    </td>
                    <td>
                        <?php if($expiry): ?>
                            <?php echo e($expiry->format('d M, Y')); ?>

                            <?php if($isExpired): ?>
                                <br><small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Expired</small>
                            <?php elseif($isNear): ?>
                                <br><small class="text-warning"><i class="fas fa-clock"></i> Expiring Soon</small>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted">No Expiry (Lifetime)</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($school->active_status == 1): ?>
                            <span class="sa-badge sa-badge-success">Active</span>
                        <?php else: ?>
                            <span class="sa-badge sa-badge-danger">Suspended</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="sa-btn sa-btn-outline sa-btn-sm" onclick="openExtendModal('<?php echo e($school->id); ?>', '<?php echo e($school->school_name); ?>', '<?php echo e($school->ending_date); ?>', '<?php echo e($school->active_status); ?>', '<?php echo e($school->plan_type); ?>')">
                            <i class="fas fa-edit"></i> Manage
                        </button>
                        <form action="<?php echo e(route('superadmin.subscriptions.toggle', $school->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="sa-btn <?php echo e($school->active_status == 1 ? 'sa-btn-danger' : 'sa-btn-success'); ?> sa-btn-sm">
                                <?php echo e($school->active_status == 1 ? 'Suspend' : 'Activate'); ?>

                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="sa-empty-state">No tenant schools found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        <?php echo e($subscriptions->links()); ?>

    </div>
</div>

<!-- Extend/Manage Modal -->
<div id="subscriptionModal" class="sa-modal-overlay" style="display:none;">
    <div class="sa-modal-content" style="max-width: 450px;">
        <div class="sa-modal-header">
            <h3 id="modalSchoolName">Manage Subscription</h3>
            <button class="sa-modal-close" onclick="closeModal()">&times;</button>
        </div>
        <form id="extendForm" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="sa-modal-body">
                <div style="margin-bottom: 15px;">
                    <label class="sa-form-label">Plan Type</label>
                    <input type="text" name="plan_type" id="modalPlanType" class="sa-form-control" placeholder="Trial, Basic, Pro...">
                </div>
                <div style="margin-bottom: 15px;">
                    <label class="sa-form-label">Expiry Date</label>
                    <input type="date" name="ending_date" id="modalExpiryDate" class="sa-form-control">
                </div>
                <div style="margin-bottom: 15px;">
                    <label class="sa-form-label">Status</label>
                    <select name="active_status" id="modalStatus" class="sa-form-control">
                        <option value="1">Active</option>
                        <option value="0">Suspended</option>
                    </select>
                </div>
            </div>
            <div class="sa-modal-footer" style="padding: 20px; border-top: 1px solid var(--sa-border); text-align: right;">
                <button type="button" class="sa-btn sa-btn-outline" onclick="closeModal()">Cancel</button>
                <button type="submit" class="sa-btn sa-btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<style>
    .sa-modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 9999;
        display: flex; align-items: center; justify-content: center;
    }
    .sa-modal-content { background: var(--sa-bg-card); border-radius: 16px; border: 1px solid var(--sa-border); width: 90%; }
    .sa-modal-header { padding: 20px; border-bottom: 1px solid var(--sa-border); display: flex; justify-content: space-between; align-items: center; }
    .sa-modal-body { padding: 20px; }
    .sa-form-label { display: block; margin-bottom: 8px; font-size: 13px; color: var(--sa-text-muted); }
    .sa-modal-close { background: none; border: none; color: #fff; font-size: 24px; cursor: pointer; }
</style>

<script>
    function openExtendModal(id, name, date, status, plan) {
        document.getElementById('modalSchoolName').innerText = 'Manage: ' + name;
        document.getElementById('modalExpiryDate').value = date;
        document.getElementById('modalStatus').value = status;
        document.getElementById('modalPlanType').value = plan;
        document.getElementById('extendForm').action = '/superadmin/subscriptions/' + id;
        document.getElementById('subscriptionModal').style.display = 'flex';
    }
    function closeModal() {
        document.getElementById('subscriptionModal').style.display = 'none';
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/subscriptions/index.blade.php ENDPATH**/ ?>