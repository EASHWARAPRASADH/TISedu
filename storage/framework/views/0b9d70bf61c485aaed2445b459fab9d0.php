

<?php $__env->startSection(config('pagebuilder.site_section')); ?>
<?php echo $headerMenu; ?>

<?php echo $pageSections; ?>

<?php echo $footerMenu; ?>

<?php $__env->stopSection(); ?>

<?php if(moduleStatusCheck('WhatsappSupport')): ?>
     <?php echo $__env->make('whatsappsupport::partials._popup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?> 

<?php echo $__env->make(config('pagebuilder.site_layout'),['page' => $page, 'edit' => false ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/eash/Downloads/erpv2 2/packages/larabuild/pagebuilder/src/../resources/views/page.blade.php ENDPATH**/ ?>