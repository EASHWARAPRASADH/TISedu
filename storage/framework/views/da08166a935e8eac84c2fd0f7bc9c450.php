<section class="section_padding teacher">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section_title">
                    <span class="section_title_meta"><?php echo e(pagesetting('teacher_sub_heading')); ?></span>
                    <h2><?php echo e(pagesetting('teacher_heading')); ?></h2>
                </div>
            </div>
        </div>
        <?php if (isset($component)) { $__componentOriginal70a2c9dfcb566127cb7f1da5a20b1574 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal70a2c9dfcb566127cb7f1da5a20b1574 = $attributes; } ?>
<?php $component = App\View\Components\TeacherList::resolve(['column' => pagesetting('teacher_area_column'),'count' => pagesetting('teacher_count')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('teacher-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TeacherList::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal70a2c9dfcb566127cb7f1da5a20b1574)): ?>
<?php $attributes = $__attributesOriginal70a2c9dfcb566127cb7f1da5a20b1574; ?>
<?php unset($__attributesOriginal70a2c9dfcb566127cb7f1da5a20b1574); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal70a2c9dfcb566127cb7f1da5a20b1574)): ?>
<?php $component = $__componentOriginal70a2c9dfcb566127cb7f1da5a20b1574; ?>
<?php unset($__componentOriginal70a2c9dfcb566127cb7f1da5a20b1574); ?>
<?php endif; ?>
       

    </div>
</section>
<?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/themes/edulia/pagebuilder/teacher/view.blade.php ENDPATH**/ ?>