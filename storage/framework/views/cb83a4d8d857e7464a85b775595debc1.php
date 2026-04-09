<?php $__env->startSection('title', 'Analytics'); ?>

<?php $__env->startSection('content'); ?>
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-6">
        <div class="sa-card">
            <div class="sa-card-header">
                <span class="sa-card-title">School Growth (12 Months)</span>
            </div>
            <div style="padding: 20px 0;">
                <?php if(count($schoolGrowth) > 0): ?>
                    <div style="display: flex; align-items: flex-end; gap: 4px; height: 150px;">
                        <?php $maxVal = max($schoolGrowth) ?: 1; ?>
                        <?php $__currentLoopData = $schoolGrowth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                                <div style="background: linear-gradient(to top, var(--sa-primary), var(--sa-secondary)); width: 100%; height: <?php echo e(($count / $maxVal) * 120); ?>px; border-radius: 4px 4px 0 0; min-height: 4px;"></div>
                                <span style="font-size: 9px; color: var(--sa-text-muted); transform: rotate(-45deg); white-space: nowrap;"><?php echo e(substr($month, 5)); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No data available</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="sa-card">
            <div class="sa-card-header">
                <span class="sa-card-title">Student Enrollment (12 Months)</span>
            </div>
            <div style="padding: 20px 0;">
                <?php if(count($studentTrend) > 0): ?>
                    <div style="display: flex; align-items: flex-end; gap: 4px; height: 150px;">
                        <?php $maxStu = max($studentTrend) ?: 1; ?>
                        <?php $__currentLoopData = $studentTrend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                                <div style="background: linear-gradient(to top, var(--sa-success), #34d399); width: 100%; height: <?php echo e(($count / $maxStu) * 120); ?>px; border-radius: 4px 4px 0 0; min-height: 4px;"></div>
                                <span style="font-size: 9px; color: var(--sa-text-muted); transform: rotate(-45deg); white-space: nowrap;"><?php echo e(substr($month, 5)); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; color: var(--sa-text-muted); padding: 40px;">No data available</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="sa-card">
    <div class="sa-card-header">
        <span class="sa-card-title">Top Schools by Student Count</span>
    </div>
    <table class="sa-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>School</th>
                <th>Students</th>
                <th>Bar</th>
            </tr>
        </thead>
        <tbody>
            <?php $maxTop = $topSchools->max('student_count') ?: 1; ?>
            <?php $__currentLoopData = $topSchools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="font-weight: 700; color: var(--sa-primary);">#<?php echo e($index + 1); ?></td>
                    <td style="color: var(--sa-text-primary); font-weight: 500;"><?php echo e($school->school_name); ?></td>
                    <td><?php echo e(number_format($school->student_count)); ?></td>
                    <td style="width: 40%;">
                        <div style="background: var(--sa-bg-dark); border-radius: 4px; height: 8px; overflow: hidden;">
                            <div style="background: linear-gradient(90deg, var(--sa-primary), var(--sa-secondary)); height: 100%; width: <?php echo e(($school->student_count / $maxTop) * 100); ?>%; border-radius: 4px;"></div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.superAdmin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/analytics/index.blade.php ENDPATH**/ ?>