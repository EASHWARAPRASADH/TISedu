
<?php $__env->startSection(config('pagebuilder.site_section')); ?>
<style>
    .list-unstyled li {
        font-size: 1.1rem;
        color: #6c757d;
    }
    .list-unstyled li i {
        color: #28a745;
        margin-right: 10px;
    }
    .list-unstyled li.mb-2 {
        margin-bottom: 1rem;
    }
</style>

<?php echo e(headerContent()); ?>

    <section class="bradcrumb_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bradcrumb_area_inner">
                        <h1><?php echo e(__('edulia.course_details')); ?><span><a href="<?php echo e(url('/')); ?>"><?php echo e(__('edulia.home')); ?></a> / <?php echo e(__('edulia.courses_details')); ?></span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_padding course course_details_page mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="course_sidebar">
                        <div class="course_sidebar_thumbnail">
                            <img src="<?php echo e($course->image != ""? asset($course->image) : '../img/client/common-banner1.jpg'); ?>" alt="<?php echo e($course->title); ?>">
                        </div>
                        <?php if($course->courseCategory->category_name): ?>
                            <div class="course_sidebar_content">
                                <h5><?php echo e(__('edulia.category').' '.':'); ?><?php echo e($course->courseCategory->category_name); ?></h5>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-8 col-md-12">
                    <div class="course_details">
                        <div class="course_details_mentor">
                            <div class="course_details_mentor_head">
                                <div class="course_details_mentor_title">
                                    <h5><?php echo e($course->title); ?></h5>
                                </div>
                            </div>
                            <div class="course_details_mentor_wrapper">
                                <?php echo $course->overview; ?>

                            </div>
                        </div>
                        <div class="course_details_preview_img">
                            <img src="<?php echo e($course->image != ""? asset($course->image) : '../img/client/common-banner1.jpg'); ?>" alt="<?php echo e($course->title); ?>">
                        </div>
                        <nav class="course_details_menu">
                            <ul>
                                <?php if($course->outline): ?>
                                    <li class='course_details_menu_list'>
                                        <a href="#" class='course_details_menu_list_link active about-filter' data-name='overview'>
                                            <?php echo e(__('edulia.overview')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($course->prerequisites): ?>
                                    <li class='course_details_menu_list'>
                                        <a href="#" class='course_details_menu_list_link about-filter' data-name='curriculum'>
                                            <?php echo e(__('edulia.curriculum')); ?> 
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($course->resources): ?>
                                    <li class='course_details_menu_list'>
                                        <a href="#" class='course_details_menu_list_link about-filter' data-name='instructors'>
                                            <?php echo e(__('edulia.instructors')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($course->stats): ?>
                                    <li class='course_details_menu_list'>
                                        <a href="#" class='course_details_menu_list_link about-filter' data-name='reviews'>
                                            <?php echo e(__('edulia.reviews')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <div class="course_details_abouts">
                            <div class="course_details_abouts_item overview">
                                <?php echo $course->outline; ?>

                            </div>
                            <div class="course_details_abouts_item curriculum">  
                                <?php echo $course->prerequisites; ?>

                            </div>
                            <div class="course_details_abouts_item instructors">
                                <?php echo $course->resources; ?>

                            </div>
                            <div class="course_details_abouts_item reviews">
                                <?php echo $course->stats; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo e(footerContent()); ?>

<?php $__env->stopSection(); ?>

<?php if (! $__env->hasRenderedOnce('43d7be78-f302-4e93-aa4d-0af9e4654b6a')): $__env->markAsRenderedOnce('43d7be78-f302-4e93-aa4d-0af9e4654b6a');
$__env->startPush(config('pagebuilder.site_script_var')); ?>
    <script>
        const filterBtns = document.querySelectorAll('.about-filter');
        const aboutItems = document.querySelectorAll('.course_details_abouts_item');

        filterBtns.forEach((btn) => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                filterBtns.forEach((btn) => btn.classList.remove('active'));

                this.classList.add('active');

                const value = this.dataset.name;

                aboutItems.forEach((item) => {
                    if (item.classList.contains(value)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        document.querySelector('.course_details_abouts_item.overview').style.display = 'block';
        document.querySelector('.about-filter[data-name="overview"]').classList.add('active');
    </script>
<?php $__env->stopPush(); endif; ?>

<?php echo $__env->make(config('pagebuilder.site_layout'),['edit' => false ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/frontEnd/theme/edulia/course/single_course_details_page.blade.php ENDPATH**/ ?>