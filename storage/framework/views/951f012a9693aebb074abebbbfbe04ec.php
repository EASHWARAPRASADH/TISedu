<?php
    $generalSetting = generalSetting();
?>
<div class="footer-item">
    <?php if(pagesetting('footer_menu_image')): ?>
    <a href='<?php echo e(url('/')); ?>' class="footer-item-logo">
        <img src="<?php echo e(pagesetting('footer_menu_image') ? pagesetting('footer_menu_image')[0]['thumbnail'] : defaultLogo($generalSetting->logo)); ?>" alt="">
    </a>
    <?php endif; ?> 
    <p style="color: <?php echo e(pagesetting('footer-content-bg-color')); ?>">
        <?php echo pagesetting('footer-right-content-text'); ?>

    </p>
</div>
<?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/themes/edulia/pagebuilder/footer-content/view.blade.php ENDPATH**/ ?>