<?php if (! $__env->hasRenderedOnce('d741b847-13e4-4155-bfa7-ff9d817da823')): $__env->markAsRenderedOnce('d741b847-13e4-4155-bfa7-ff9d817da823');
$__env->startPush(config('pagebuilder.site_style_var')); ?>
    <style>
        iframe {
            width: 100% !important;
            height: 100% !important;
        }
        .google_map{
            height: 200px;
        }
    </style>
<?php $__env->stopPush(); endif; ?>
<div class="contacts_info mt-5">
    <p><?php echo pagesetting('google_map_editor'); ?></p>
    <div class="google_map w-100">
        <?php echo pagesetting('google_map_key'); ?>

    </div>
</div>
<?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/themes/edulia/pagebuilder/google-map/view.blade.php ENDPATH**/ ?>