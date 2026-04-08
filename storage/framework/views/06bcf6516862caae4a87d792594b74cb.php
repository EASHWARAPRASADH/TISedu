<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('reports.master_report_card'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('reports.master_report_card'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('reports.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('reports.master_report_card'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="white-box">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-15"><?php echo app('translator')->get('common.select_criteria'); ?></h3>
                    </div>
                </div>
            </div>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_master_report_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

            <div class="row">
                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                <div class="col-lg-4 mt-30-md">
                    <select class="primary_select form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                        <option data-display="<?php echo app('translator')->get('common.select_class'); ?> *" value=""><?php echo app('translator')->get('common.select_class'); ?> *</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('class')): ?>
                    <span class="text-danger invalid-select" role="alert">
                        <?php echo e($errors->first('class')); ?>

                    </span>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4 mt-30-md" id="select_section_div">
                    <select class="primary_select form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                        <option data-display="<?php echo app('translator')->get('common.select_section'); ?> *" value=""><?php echo app('translator')->get('common.select_section'); ?> *</option>
                        <?php if(isset($section_id)): ?>
                        <option value="<?php echo e($section_id); ?>" selected><?php echo e(App\SmSection::find($section_id)->section_name); ?></option>
                        <?php endif; ?>
                    </select>
                    <div class="pull-right loader loader_style" id="select_section_loader">
                        <img class="loader_img_style" src="<?php echo e(asset('backEnd/img/demo_wait.gif')); ?>" alt="loader">
                    </div>
                    <?php if($errors->has('section')): ?>
                    <span class="text-danger invalid-select" role="alert">
                        <?php echo e($errors->first('section')); ?>

                    </span>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4 mt-30-md" id="select_student_div">
                    <select class="primary_select form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                        <option data-display="<?php echo app('translator')->get('common.select_student'); ?> *" value=""><?php echo app('translator')->get('common.select_student'); ?> *</option>
                        <?php if(isset($student_id)): ?>
                        <option value="<?php echo e($student_id); ?>" selected><?php echo e(App\SmStudent::find($student_id)->full_name); ?></option>
                        <?php endif; ?>
                    </select>
                    <div class="pull-right loader loader_style" id="select_student_loader">
                        <img class="loader_img_style" src="<?php echo e(asset('backEnd/img/demo_wait.gif')); ?>" alt="loader">
                    </div>
                    <?php if($errors->has('student')): ?>
                    <span class="text-danger invalid-select" role="alert">
                        <?php echo e($errors->first('student')); ?>

                    </span>
                    <?php endif; ?>
                </div>

                <div class="col-lg-12 mt-20 text-right">
                    <button type="submit" class="primary-btn small fix-gr-bg">
                        <span class="ti-search pr-2"></span>
                        <?php echo app('translator')->get('common.search'); ?>
                    </button>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</section>

<?php if(isset($student)): ?>
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-3">
                <div class="student-meta-box">
                    <div class="white-box p-3 radius-10">
                        <div class="single-meta">
                            <h5 class="name">Student Name</h5>
                            <div class="value"><?php echo e($student->full_name); ?></div>
                        </div>
                        <div class="single-meta mt-10">
                            <h5 class="name">Admission No</h5>
                            <div class="value"><?php echo e($student->admission_no); ?></div>
                        </div>
                        <div class="single-meta mt-10">
                            <h5 class="name">EMIS ID</h5>
                            <div class="value"><?php echo e($student->emis_id ?? 'N/A'); ?></div>
                        </div>
                        <div class="single-meta mt-10">
                            <h5 class="name">Gender</h5>
                            <div class="value"><?php echo e($student->gender ? $student->gender->base_setup_name : ''); ?></div>
                        </div>
                        <div class="single-meta mt-10">
                            <h5 class="name">Blood Group</h5>
                            <div class="value"><?php echo e($student->bloodGroup ? $student->bloodGroup->base_setup_name : ''); ?></div>
                        </div>
                        <div class="single-meta mt-10">
                            <h5 class="name">Parent</h5>
                            <div class="value"><?php echo e($student->parents ? $student->parents->guardians_name : ''); ?> <br> <?php echo e($student->parents ? $student->parents->guardians_mobile : ''); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <!-- Attendance -->
                    <div class="col-lg-6 mb-30">
                        <div class="white-box p-3 radius-10 h-100">
                            <h4>Attendance Summary</h4>
                            <ul class="list-group mt-15">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Present
                                    <span class="badge badge-success badge-pill"><?php echo e($attendances['P'] ?? 0); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Late
                                    <span class="badge badge-warning badge-pill"><?php echo e($attendances['L'] ?? 0); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Absent
                                    <span class="badge badge-danger badge-pill"><?php echo e($attendances['A'] ?? 0); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Half Day
                                    <span class="badge badge-info badge-pill"><?php echo e($attendances['F'] ?? 0); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Financial -->
                    <div class="col-lg-6 mb-30">
                        <div class="white-box p-3 radius-10 h-100">
                            <h4>Financial Snapshot</h4>
                            <ul class="list-group mt-15">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Fees
                                    <span><?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format($financial['total_fees'], 2)); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Discount
                                    <span><?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format($financial['total_discount'], 2)); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Paid
                                    <span class="text-success"><?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format($financial['total_paid'], 2)); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    Balance Due
                                    <span class="text-danger"><?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format($financial['total_due'], 2)); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Marks -->
                    <div class="col-lg-12">
                        <div class="white-box p-3 radius-10">
                            <h4>Academic Performance (Exams)</h4>
                            <div class="table-responsive mt-15">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Exam</th>
                                            <th>Subject</th>
                                            <th>Marks</th>
                                            <th>GPA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $marks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($mark->exam ? $mark->exam->title : 'N/A'); ?></td>
                                            <td><?php echo e($mark->subject ? $mark->subject->subject_name : 'N/A'); ?></td>
                                            <td><?php echo e($mark->total_marks); ?></td>
                                            <td><?php echo e($mark->total_gpa_grade); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($marks) == 0): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No exam marks found</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/backEnd/studentInformation/master_report_card.blade.php ENDPATH**/ ?>