

<?php $__env->startSection(config('pagebuilder.site_section')); ?>
<?php echo e(headerContent()); ?>

    <section class="bradcrumb_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bradcrumb_area_inner">
                        <h1>
                            <?php echo e(__('edulia.event_details')); ?> 
                            <span>
                                <a href="<?php echo e(url('/')); ?>"><?php echo e(__('edulia.home')); ?></a> /
                                <?php echo e(__('edulia.event_details')); ?>

                            </span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_padding events">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="events_details">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="events_details_sidebar">
                                    <div class="events_details_sidebar_info">
                                        <h6><?php echo e(__('edulia.start_date')); ?></h6>
                                        <p><?php echo e(dateConvert($event->from_date)); ?></p>
                                    </div>
                                    <div class="events_details_sidebar_info">
                                        <h6><?php echo e(__('edulia.end_date')); ?></h6>
                                        <p><?php echo e(dateConvert($event->to_date)); ?></p>
                                    </div>
                                    <div class="events_details_sidebar_info">
                                        <h6><?php echo e(__('edulia.location')); ?></h6>
                                        <p><?php echo e($event->event_location); ?></p>
                                    </div>
                                    <div class="events_details_sidebar_info">
                                        <h6><?php echo e(__('edulia.organizer')); ?></h6>
                                        <p><?php echo e($event->user->full_name); ?></p>
                                    </div>
                                    <div class="events_details_sidebar_info">
                                        <h6><?php echo e(__('edulia.email_address')); ?></h6>
                                        <p><?php echo e($event->user->email); ?></p>
                                    </div>
                                    <?php if($event->user->phone_number): ?>
                                        <div class="events_details_sidebar_info">
                                            <h6><?php echo e(__('edulia.phone_number')); ?></h6>
                                            <p><?php echo e($event->user->phone_number); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="events_details_content">
                                    <?php if(file_exists($event->uplad_image_file)): ?>
                                        <div class="events_details_content_img">
                                            <img src="<?php echo e(asset($event->uplad_image_file)); ?>" alt="<?php echo e($event->event_title); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <h3><?php echo e($event->event_title); ?></h3>
                                    <p>
                                        <?php echo $event->event_des; ?>

                                    </p>
                                    <?php if($event->url): ?>
                                        <a href="<?php echo e($event->url); ?>" target="__blank"></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php echo e(footerContent()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(config('pagebuilder.site_layout'), ['edit' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/frontEnd/theme/edulia/single_event.blade.php ENDPATH**/ ?>