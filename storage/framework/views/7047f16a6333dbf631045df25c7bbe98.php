<?php if (! $__env->hasRenderedOnce('3f38120c-165b-48d7-a27f-7441bbbac0c8')): $__env->markAsRenderedOnce('3f38120c-165b-48d7-a27f-7441bbbac0c8');
$__env->startPush(config('pagebuilder.site_style_var')); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/theme/edulia/packages/magnific/magnific-popup.min.css')); ?>">
<?php $__env->stopPush(); endif; ?>
<div class="section_padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="section_title">
                    <span class="section_title_meta"><?php echo e(pagesetting('video_sub_heading')); ?></span>
                    <h2><?php echo e(pagesetting('video_heading')); ?></h2>
                </div>
            </div>
        </div>
        <?php if (isset($component)) { $__componentOriginal4ff5332b173ace74fedc0abfca218066 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4ff5332b173ace74fedc0abfca218066 = $attributes; } ?>
<?php $component = App\View\Components\VideoGallery::resolve(['column' => pagesetting('video_gallery_column'),'count' => pagesetting('video_gallery_count')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('video-gallery'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\VideoGallery::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4ff5332b173ace74fedc0abfca218066)): ?>
<?php $attributes = $__attributesOriginal4ff5332b173ace74fedc0abfca218066; ?>
<?php unset($__attributesOriginal4ff5332b173ace74fedc0abfca218066); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4ff5332b173ace74fedc0abfca218066)): ?>
<?php $component = $__componentOriginal4ff5332b173ace74fedc0abfca218066; ?>
<?php unset($__componentOriginal4ff5332b173ace74fedc0abfca218066); ?>
<?php endif; ?>
    </div>
</div>
<?php if (! $__env->hasRenderedOnce('c429abb8-c63f-4861-93e7-41eb158e44b4')): $__env->markAsRenderedOnce('c429abb8-c63f-4861-93e7-41eb158e44b4');
$__env->startPush(config('pagebuilder.site_script_var')); ?>
    <script>
        $(document).ready(function() {
            $('.gallery_item.video').magnificPopup({
                type: 'iframe',
            });
        });
    </script>
    <script src="<?php echo e(asset('public/theme/edulia/packages/magnific/jquery.magnific-popup.min.js')); ?>"></script>
<?php $__env->stopPush(); endif; ?>
<?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/themes/edulia/pagebuilder/video-gallery/view.blade.php ENDPATH**/ ?>