<?php $__env->startSection('title', 'System Logs'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .log-viewer {
        background: #0d1117;
        border: 1px solid var(--sa-border);
        border-radius: 10px;
        padding: 16px;
        font-family: 'JetBrains Mono', 'Fira Code', 'Consolas', monospace;
        font-size: 11px;
        line-height: 1.6;
        color: #c9d1d9;
        max-height: 600px;
        overflow: auto;
        white-space: pre-wrap;
        word-break: break-all;
    }

    .log-viewer .log-error { color: #f87171; }
    .log-viewer .log-warning { color: #fbbf24; }
    .log-viewer .log-info { color: #60a5fa; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="sa-card" style="margin-bottom: 20px;">
            <div class="sa-card-header">
                <span class="sa-card-title">Log Files</span>
            </div>
            <?php $__currentLoopData = $logFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('superadmin.system-logs.index', ['file' => $file['name']])); ?>"
                   style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--sa-border); text-decoration: none; <?php echo e($selectedLog == $file['name'] ? 'color: var(--sa-primary);' : 'color: var(--sa-text-secondary);'); ?>">
                    <div>
                        <div style="font-size: 12px; font-weight: <?php echo e($selectedLog == $file['name'] ? '600' : '400'); ?>;"><?php echo e($file['name']); ?></div>
                        <div style="font-size: 10px; color: var(--sa-text-muted);"><?php echo e($file['size']); ?></div>
                    </div>
                    <?php if($selectedLog == $file['name']): ?>
                        <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="col-md-9">
        <div class="sa-card">
            <div class="sa-card-header">
                <span class="sa-card-title"><?php echo e($selectedLog); ?></span>
                <div style="display: flex; gap: 8px;">
                    <a href="<?php echo e(route('superadmin.system-logs.download', $selectedLog)); ?>" class="sa-btn sa-btn-outline sa-btn-sm"><i class="fas fa-download"></i></a>
                    <form action="<?php echo e(route('superadmin.system-logs.clear')); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Clear this log file?')">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="file" value="<?php echo e($selectedLog); ?>">
                        <button type="submit" class="sa-btn sa-btn-danger sa-btn-sm"><i class="fas fa-trash"></i> Clear</button>
                    </form>
                </div>
            </div>
            <div class="log-viewer" id="logViewer"><?php echo nl2br(e($logContent)); ?></div>
        </div>
    </div>
</div>

<script>
// Auto-scroll to bottom
document.getElementById('logViewer')?.scrollTo(0, document.getElementById('logViewer').scrollHeight);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/system_logs/index.blade.php ENDPATH**/ ?>