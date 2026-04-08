<style>
    .event_short_title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<?php 
    $events_count = App\SmEvent::where('school_id', app()->bound('school') ? app('school')->id : 1)->count();
?>
<?php if($events->isEmpty()): ?>
    <p class="text-center text-danger"><?php echo app('translator')->get('edulia.no_data_available'); ?></p>
<?php endif; ?>

<div id="dynamicLoadMoreData" class="row">
    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-<?php echo e($column); ?>">
            <div class="events_item">
                <?php if(file_exists(public_path($event->uplad_image_file))): ?>
                    <div class="events_item_img">
                        <img src="<?php echo e(asset($event->uplad_image_file)); ?>" alt="<?php echo e($event->event_title); ?>">
                    </div>
                <?php endif; ?>
                <div class="events_item_inner">
                    <div class="events_item_inner_meta">
                        <?php if($dateshow == 1): ?>
                            <span><i class="fal fa-clock"></i>
                                <?php echo e(dateConvert($event->from_date).' '.__('common.to').' '.dateConvert($event->to_date)); ?>

                            </span>
                        <?php endif; ?>
                        <?php if($enevtlocation == 1): ?>
                            <span>
                                <i class="fal fa-map-marker-alt"></i>
                                <?php echo e($event->event_location); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                    <?php if($event->event_title): ?>
                        <a href="<?php echo e(route('frontend.event-details', $event->id)); ?>" class="events_item_inner_title event_short_title">
                            <?php echo e($event->event_title); ?>

                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('frontend.event-details', $event->id)); ?>">
                        <i class="fa fa-plus-circle"></i><?php echo e($button); ?>

                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(Request::is('events')): ?>
    <?php if($count < $events_count): ?>
        <div class="row text-center">
            <div class="col-md-12">
                <div class="load_more section_padding_top">
                    <a href="#" class="site_btn load_more_event_btn" data-skip="<?php echo e($count); ?>"><?php echo e(__('edulia.load_more')); ?></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (! $__env->hasRenderedOnce('08330c18-0a55-4fe5-a083-e0c1bd2c1876')): $__env->markAsRenderedOnce('08330c18-0a55-4fe5-a083-e0c1bd2c1876');
$__env->startPush(config('pagebuilder.site_script_var')); ?>
    <script>
        $(document).on('click', '.load_more_event_btn', function (e) {
            e.preventDefault();
            var skip = $(this).data('skip');
            var take = <?php echo e($count); ?>;
            var row_each_column = <?php echo e($column); ?>;
            var sorting = "<?php echo e($sorting); ?>";
            var dateshow = "<?php echo e($dateshow); ?>";
            var enevtlocation = "<?php echo e($enevtlocation); ?>";
            var button = "<?php echo e($button); ?>";
            
            $.ajax({
                url: "<?php echo e(route('frontend.load-more-events')); ?>",
                method: "POST",
                data: {
                    skip: skip,
                    row_each_column: row_each_column,
                    take: take,
                    sorting: sorting,
                    dateshow: dateshow,
                    enevtlocation: enevtlocation,
                    button: button,
                    _token: "<?php echo e(csrf_token()); ?>",
                },
                success: function (response) {
                    if (response.success) {
                        $('#dynamicLoadMoreData').append(response.html);
                        $('.load_more_event_btn').data('skip', skip + take);

                        if (!response.has_more) {
                            $('.load_more_event_btn').hide();
                        }
                    } else {
                        console.error('Failed to load more events.');
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                },
            });
        });
    </script>
<?php $__env->stopPush(); endif; ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/components/edulia/event-gallery.blade.php ENDPATH**/ ?>