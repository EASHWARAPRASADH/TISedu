
<?php $__env->startSection(config('pagebuilder.site_section')); ?>
    <?php echo e(headerContent()); ?>

    <section class="bradcrumb_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bradcrumb_area_inner">
                        <h1><?php echo e(__('edulia.speech_details')); ?> <span><a
                                    href="<?php echo e(url('/')); ?>"><?php echo e(__('edulia.home')); ?></a> /
                                <?php echo e(__('edulia.speech_details')); ?></span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_padding teacher">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-sm-12 mb-3 mb-md-0">
                    <div class="teacher_details">
                        <div class="teacher_details_img">
                            <div class="teacher_details_img_wrapper">
                                <img src="<?php echo e(url(@$singleSpeechSlider->image)); ?>" alt="">
                            </div>
                            <div class="teacher_details_img_wrapper_inner">
                                <h4><?php echo e($singleSpeechSlider->name); ?></h4>
                                <p><?php echo e($singleSpeechSlider->designation); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 offset-xl-1 col-md-8 col-sm-12">
                    <div class="teacher_details">
                        
                        <h4 class="mb-3">
                            <?php echo e($singleSpeechSlider->title); ?>

                        </h4>
                        <div class="teacher_details_content">
                            <p><?php echo $singleSpeechSlider->speech; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo e(footerContent()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(config('pagebuilder.site_layout'), ['edit' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/frontEnd/theme/edulia/speechSlider/single_speech_slider.blade.php ENDPATH**/ ?>