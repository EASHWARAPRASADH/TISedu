<section class="section_padding course home_course">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section_title">
                    <span class="section_title_meta"><?php echo e(pagesetting('course_sub_title')); ?></span>
                    <h2><?php echo e(pagesetting('course_title')); ?></h2>
                    <p><?php echo pagesetting('course_description'); ?></p>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <?php if (isset($component)) { $__componentOriginal2bc6e219d89fabf67e281f6993c7932d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2bc6e219d89fabf67e281f6993c7932d = $attributes; } ?>
<?php $component = App\View\Components\Course::resolve(['column' => pagesetting('course_area_column'),'sorting' => pagesetting('course_sorting'),'count' => pagesetting('course_count')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('course'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Course::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2bc6e219d89fabf67e281f6993c7932d)): ?>
<?php $attributes = $__attributesOriginal2bc6e219d89fabf67e281f6993c7932d; ?>
<?php unset($__attributesOriginal2bc6e219d89fabf67e281f6993c7932d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2bc6e219d89fabf67e281f6993c7932d)): ?>
<?php $component = $__componentOriginal2bc6e219d89fabf67e281f6993c7932d; ?>
<?php unset($__componentOriginal2bc6e219d89fabf67e281f6993c7932d); ?>
<?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/themes/edulia/pagebuilder/course/view.blade.php ENDPATH**/ ?>