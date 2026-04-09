
<?php $__env->startSection(config('pagebuilder.site_section')); ?>
    <?php echo e(headerContent()); ?>

    <section class="bradcrumb_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bradcrumb_area_inner">
                        <h1><?php echo e(__('edulia.notice_details')); ?> <span><a
                                    href="<?php echo e(url('/')); ?>"><?php echo e(__('edulia.home')); ?></a> /
                                <?php echo e(__('edulia.notice_details')); ?></span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_padding noticeboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="noticeboard_details">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="noticeboard_details_wrapper">
                                    <h4><?php echo e($notice_detail->notice_title); ?>

                                    </h4>
                                    <span class="d-block mt-3 "><?php echo e(date('d M, Y', strtotime($notice_detail->notice_date))); ?></span>

                                    <p><?php echo e($notice_detail->notice_message); ?></p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="noticeboard_inner">
                                    <div class="noticeboard_inner_head">
                                        <h5><?php echo e(__('edulia.noticeboard')); ?></h5>
                                    </div>
                                    <div class='noticeboard_inner_wrapper'>
                                        <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="noticeboard_inner_item">
                                                <a href="<?php echo e(route('frontend.notice-details', $notice->id)); ?>"
                                                    class="noticeboard_inner_item_title"><?php echo e($notice->notice_title); ?></a>
                                                <p><?php echo e(__('edulia.published')); ?>:
                                                    <?php echo e(date('d M, Y', strtotime($notice->notice_date))); ?></p>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
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
<?php if (! $__env->hasRenderedOnce('84d1a4a0-5ddb-45d6-baf7-91b905882ccb')): $__env->markAsRenderedOnce('84d1a4a0-5ddb-45d6-baf7-91b905882ccb');
$__env->startPush(config('pagebuilder.site_script_var')); ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.newsReplyBtn', function(e) {
                e.preventDefault();
                var commentId = $(this).data('comment-id');
                $('.replyDiv_' + commentId).slideToggle();
                $('.normalComment').slideToggle();
                $('.replyDiv_' + commentId).find('.parentId').val(commentId);
            })
        })
    </script>
<?php $__env->stopPush(); endif; ?>

<?php echo $__env->make(config('pagebuilder.site_layout'), ['edit' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/frontEnd/theme/edulia/notice/single_notice.blade.php ENDPATH**/ ?>