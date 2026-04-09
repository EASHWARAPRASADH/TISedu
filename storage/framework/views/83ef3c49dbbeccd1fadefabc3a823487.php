<header class="sa-header">
    <div class="sa-header-left">
        <button class="sa-mobile-toggle" type="button">
            <i class="fas fa-bars"></i>
        </button>
        <h4><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h4>
    </div>

    <div class="sa-header-right">
        <form action="<?php echo e(route('superadmin.logout')); ?>" method="POST" style="display: inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="sa-header-btn sa-btn-logout">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>
</header>
<?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/layouts/header.blade.php ENDPATH**/ ?>