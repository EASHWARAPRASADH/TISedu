
<?php $__env->startSection(config('pagebuilder.site_section')); ?>
<?php echo e(headerContent()); ?>

<style>
    .cmt_rp_fornt{
        padding: 10px 21px;
        font-size: 12px;
        line-height: 0.8;
    }
    .cmt-gap{
        gap: 10px;
    }
</style>
    <section class="bradcrumb_area" style="background-image:url('<?php echo e(asset($news->image)); ?>')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bradcrumb_area_inner">
                        <h1><?php echo e(__('edulia.blog_details')); ?> <span><a href="<?php echo e(url('/')); ?>"><?php echo e(__('edulia.home')); ?></a> / <?php echo e(__('edulia.blog_details')); ?></span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="section_padding blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="blog_card">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="blog_details">
                                    <div class="blog_details_img"><img src="<?php echo e(asset($news->image)); ?>" alt="<?php echo e($news->news_title); ?>"></div>
                                    <div class="blog_details_wrapper">
                                        <span class="blog_details_wrapper_date"><?php echo e($news->category->category_name); ?> . <?php echo e($news->publish_date != ""? dateConvert($news->publish_date):''); ?></span>
                                        <h3><?php echo e($news->news_title); ?></h3>
                                        <?php echo $news->news_body; ?>

                                    </div>
                                </div>

                                <div class="blog_comments">
                                    <h3><?php echo e($news->newsComments->count()); ?> <?php echo e(__('edulia.comments')); ?></h3>
                                    <?php echo $__env->make('frontEnd.theme.edulia.news.comment_page', ['newsComments' => $news->newsComments, 'level' => 0], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                </div>
                                <div class="blog_leave_comment normalComment">
                                    <h3><?php echo e(__('edulia.leave_a_comment')); ?></h3>
                                    <?php if(!auth()->check()): ?>
                                        <p><?php echo e(__('edulia.Sing in to post your comment or singup if you don’t have any account.')); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php
                                    $gs = generalSetting();
                                   
                                ?>
                                <?php if(auth()->check() && $news->is_global == 1 && $gs->is_comment == 1): ?>
                                    <?php echo $__env->make('frontEnd.theme.edulia.news.comment_form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php elseif(auth()->check() && $news->is_global == 0 && $news->is_comment == 1): ?>
                                    <?php echo $__env->make('frontEnd.theme.edulia.news.comment_form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo e(footerContent()); ?>

<?php $__env->stopSection(); ?>
<?php if (! $__env->hasRenderedOnce('3fdbf7a5-cae5-40cb-ac71-37d434364584')): $__env->markAsRenderedOnce('3fdbf7a5-cae5-40cb-ac71-37d434364584');
$__env->startPush(config('pagebuilder.site_script_var')); ?>
<script>
    $(document).ready(function(){
        $(document).on('click', '.newsReplyBtn', function(e){
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            $('.replyDiv_'+commentId).slideToggle();
            $('.normalComment').slideToggle();
            $('.replyDiv_'+commentId).find('.parentId').val(commentId);
        })
    })
</script>
<?php $__env->stopPush(); endif; ?>
<?php echo $__env->make(config('pagebuilder.site_layout'),['edit' => false ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/frontEnd/theme/edulia/news/single_news_details_page.blade.php ENDPATH**/ ?>