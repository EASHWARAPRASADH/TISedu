<?php $__currentLoopData = $newsComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="blog_comments_list">
        <div class="blog_comments_list_wrapper">
            <div class="blog_comments_list_left">
                <div class="blog_comments_list_img text-uppercase">
                    <?php echo e(latterAvater($comment->user->full_name)); ?>

                </div>
            </div>
            <div class="blog_comments_list_right">
                <div class="blog_comments_list_info">
                    <div class="blog_comments_list_info_head">
                        <h5>
                            <?php if(auth()->check() && auth()->user()->role_id == 1 && $comment->user->role_id != 3): ?>
                                <a href="<?php echo e(($comment->user->role_id == 2) ? route('student_view', $comment->user->student->id): route('viewStaff', $comment->user->staff->id)); ?>" class="ps-0" target="balnk"rel="noreferrer noopener" >
                                    <h5>
                                        <?php echo e(auth()->check() ? str_replace(auth()->user()->full_name, __('common.you'), $comment->user->full_name) : $comment->user->full_name); ?>

                                    </h5>
                                </a>
                            <?php else: ?>
                                <?php echo e(auth()->check() ? str_replace(auth()->user()->full_name, __('common.you'), $comment->user->full_name) : $comment->user->full_name); ?>

                            <?php endif; ?>
                            <span class="d-flex cmt-gap">
                                <?php if(auth()->check()): ?>
                                    <?php if(userPermission('news-comment-status')): ?>
                                        <span>
                                            <a href="<?php echo e(route('news-comment-status',['id' => $comment->id,'news_id' => $news->id, 'type' => 'frontend'])); ?>" class='site_btn' data-comment-id="<?php echo e($comment->id); ?>">
                                                <?php echo e($comment->status == 1 ? __('common.unapprove') : __('common.approve')); ?>

                                            </a>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(userPermission('news-comment-delete')): ?>
                                    <?php echo e(html()->form('POST', route('news-comment-delete'))->open()); ?>

                                            <input type="hidden" name="news_id" value="<?php echo e($news->id); ?>">
                                            <input type="hidden" name="comment_id" value="<?php echo e($comment->id); ?>">
                                            <input type="hidden" name="type" value="frontend">
                                            <span>
                                                <button class="site_btn cmt_rp_fornt" type="submit"><?php echo e(__('edulia.delete')); ?></button>
                                            </span>
                                        <?php echo e(html()->form()->close()); ?>

                                    <?php endif; ?>
                                    <span><a href="#" class='site_btn newsReplyBtn' data-comment-id="<?php echo e($comment->id); ?>"><?php echo e(__('edulia.reply')); ?></a></span>
                                <?php endif; ?>
                            </span>
                        </h5>
                        <p>
                            <span><?php echo e(\Carbon\Carbon::parse($comment->created_at)->diffForhumans()); ?></span>
                        </p>
                    </div>
                    <p><?php echo e($comment->message); ?></p>
                    <?php if(auth()->check()): ?>
                        <?php echo $__env->make('frontEnd.theme.edulia.news.comment_reply_form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php if($comment->onlyChildrenFrontend->count()): ?>
        <?php echo $__env->make('frontEnd.theme.edulia.news.comment_page', ['newsComments' => $comment->onlyChildrenFrontend, 'level' => $level+1], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/frontEnd/theme/edulia/news/comment_page.blade.php ENDPATH**/ ?>