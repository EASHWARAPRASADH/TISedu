<?php
$div = isset($div) ? $div : 'col-lg-4';
$mt = isset($mt) ? $mt : 'mt-30-md';
$required = $required ?? [];
$title = is_array($title) ? $title : (empty($title) ? [] : [$title]);
$selected = isset($selected) ? $selected : null;

$academic_year = $selected && isset($selected['academic_year']) ? $selected['academic_year'] : null;
$shift_id = $selected && isset($selected['shift_id']) ? $selected['shift_id'] : null;
$class_id = $selected && isset($selected['class_id']) ? $selected['class_id'] : null;
$section_id = $selected && isset($selected['section_id']) ? $selected['section_id'] : null;
$subject_id = $selected && isset($selected['subject_id']) ? $selected['subject_id'] : null;
$student_id = $selected && isset($selected['student_id']) ? $selected['student_id'] : null;


if ($academic_year) {
$classes = classes($academic_year) ?? null;
$sections = $class_id ? sections($class_id, $academic_year) : null;
$subjects = $class_id && $section_id ? subjects($class_id, $section_id, $academic_year) : null;
$students = $class_id && $section_id ? students($class_id, $section_id, $academic_year) : null;
} else {
$sections = $class_id ? sections($class_id) : null;
$subjects = $class_id && $section_id ? subjects($class_id, $section_id) : null;
}

$visiable = $visiable ?? [];

$academic_year_name = isset($academic_year_name) ? $academic_year_name : 'academic_year';
$shift_name = isset($shift_name) ? $shift_name : 'shift';
$class_name = isset($class_name) ? $class_name : 'class_id';
$section_name = isset($section_name) ? $section_name : 'section_id';
$subject_name = isset($subject_name) ? $subject_name : 'subject_id';
?>

<?php if(in_array('academic_year', $visiable)): ?>
<div class="<?php echo e($div . ' ' . $mt); ?>">
    <div class="primary_input " id="common_select_academic_div">

        <?php if(in_array('academic_year', $title)): ?>
        <label class="primary_input_label" for=""><?php echo e(__('common.academic_year')); ?>

            <span class="text-danger"><?php echo e(in_array('academic_year', $required) ? '*' : ''); ?></span>
        </label>
        <?php endif; ?>

        <select
            class="primary_select  form-control<?php echo e($errors->has('academic_year') ? ' is-invalid' : ''); ?> common_select_academic"
            name="<?php echo e($academic_year_name); ?>" id="common_select_academic">
            <option data-display="<?php echo app('translator')->get('common.academic_year'); ?> <?php echo e(in_array('academic_year', $required) ? '*' : ''); ?>"
                value="">
                <?php echo app('translator')->get('common.academic_year'); ?> <?php echo e(in_array('academic_year', $required) ? '*' : ''); ?>

            </option>
            <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($session->id); ?>"
                <?php echo e(isset($academic_year) && $academic_year == $session->id ? 'selected' : (getAcademicId() == $session->id ? 'selected' : '')); ?>>
                <?php echo e($session->year); ?>[<?php echo e($session->title); ?>]</option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>
        <div class="pull-right loader loader_style" id="common_select_academic_year_loader">
            <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
        </div>
        <span class="text-danger"><?php echo e($errors->first($academic_year_name)); ?></span>
    </div>
</div>
<?php endif; ?>

<?php if(shiftEnable()): ?>
    
    <?php if(in_array('shift', $visiable)): ?>
    <div class="<?php echo e($div . ' ' . $mt); ?>">
        <div class="primary_input " id="common_select_shift_div">
            <?php if(in_array('shift', $title)): ?>
            <label class="primary_input_label" for=""><?php echo e(__('common.shift')); ?>

                <span class="text-danger"><?php echo e(in_array('shift', $required) ? '*' : ''); ?></span>
            </label>
            <?php endif; ?>
            <select class="primary_select form-control<?php echo e($errors->has('shift') ? ' is-invalid' : ''); ?>" name="<?php echo e($shift_name); ?>"
                id="common_select_shift">
                <option data-display="<?php echo app('translator')->get('common.select_shift'); ?> <?php echo e(in_array('shift', $required) ? '*' : ''); ?>" value="">
                    <?php echo e(__('common.select_shift')); ?> <?php echo e(in_array('shift', $required) ? '*' : ''); ?></option>
                <?php $__currentLoopData = shifts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($shift->id); ?>" <?php echo e(isset($shift_id) ? ($shift_id == $shift->id ? 'selected' : '') : ''); ?>>
                    <?php echo e($shift->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <div class="pull-right loader loader_style" id="common_select_shift_loader">
                <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
            </div>
            <span class="text-danger"><?php echo e($errors->first('shift')); ?></span>
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>
<?php if(in_array('class', $visiable)): ?>
<div class="<?php echo e($div . ' ' . $mt); ?>" id="common_select_class_div">
    <div class="primary_input mb-25">

        <?php if(in_array('class', $title)): ?>
        <label class="primary_input_label" for=""><?php echo e(__('common.class')); ?>

            <span class="text-danger"><?php echo e(in_array('class', $required) ? '*' : ''); ?></span>
        </label>
        <?php endif; ?>

        <select class="primary_select form-control<?php echo e($errors->has('class_id') ? ' is-invalid' : ''); ?>" name="<?php echo e($class_name); ?>"
            id="common_select_class">
            <option data-display="<?php echo app('translator')->get('common.select_class'); ?> <?php echo e(in_array('class', $required) ? '*' : ''); ?>" value="">
                <?php echo e(__('common.select_class')); ?> <?php echo e(in_array('class', $required) ? '*' : ''); ?></option>
            <?php if(isset($classes)): ?>
            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id) ? ($class_id == $class->id ? 'selected' : '') : ''); ?>>
                <?php echo e($class->class_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
        <div class="pull-right loader loader_style" id="common_select_class_loader">
            <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
        </div>
        <span class="text-danger"><?php echo e($errors->first($class_name)); ?></span>
    </div>
</div>

<?php endif; ?>
<?php if(in_array('section', $visiable)): ?>
<div class="<?php echo e($div . ' ' . $mt); ?>" id="common_select_section_div">

    <?php if(in_array('section', $title)): ?>
    <label class="primary_input_label" for=""><?php echo e(__('common.section')); ?>

        <span class="text-danger"><?php echo e(in_array('section', $required) ? '*' : ''); ?></span>
    </label>
    <?php endif; ?>
    <select class="primary_select form-control<?php echo e($errors->has('section_id') ? ' is-invalid' : ''); ?> select_section"
        id="common_select_section" name="<?php echo e($section_name); ?>">
        <option data-display="<?php echo app('translator')->get('common.select_section'); ?> <?php echo e(in_array('section', $required) ? '*' : ''); ?>" value="">
            <?php echo app('translator')->get('common.select_section'); ?> <?php echo e(in_array('section', $required) ? '*' : ''); ?></option>
        <?php if(isset($sections)): ?>
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($section->id); ?>"
            <?php echo e(isset($section_id) ? ($section_id == $section->section_id ? 'selected' : '') : ''); ?>>
            <?php echo e($section->sectionName->section_name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>
    <div class="pull-right loader loader_style" id="common_select_section_loader" style="margin-top: -30px;padding-right: 21px;">
        <img src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="" style="width: 28px;height:28px;">
    </div>


    <?php if($errors->has($section_name)): ?>
    <span class="text-danger">
        <?php echo e($errors->first($section_name)); ?>

    </span>
    <?php endif; ?>
</div>
<?php endif; ?>



<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function () {
        let shift_required = "<?php echo e(in_array('shift', $required) ? ' *' : ''); ?>";
        let class_required = "<?php echo e(in_array('class', $required) ? ' *' : ''); ?>";
        let section_required = "<?php echo e(in_array('section', $required) ? ' *' : ''); ?>";
        let subject_required = "<?php echo e(in_array('subject', $required) ? ' *' : ''); ?>";
        let student_required = "<?php echo e(in_array('student', $required) ? ' *' : ''); ?>";
        <?php if(shiftEnable()): ?>
        $("#common_select_academic").on("change", function () {
            var url = $("#url").val();
            var i = 0;
            var selectedAcademicId = $("#common_select_academic").val();

            $.ajax({
                type: "GET",
                data: { id: selectedAcademicId },
                dataType: "json",
                url: url + "/" + "academic-year-get-shift",

                beforeSend: function () {
                    $('#common_select_shift_loader').addClass('pre_loader').removeClass('loader');
                },

                success: function (data) {
                    $("#common_select_shift").empty().append(
                        $("<option>", {
                            value: '',
                            text: window.jsLang('select_shift') + shift_required,
                        })
                    );

                    // if (data.length) {
                    //     console.log("SHIFT DATA:", data);
                    //     $.each(data, function (i, shift) {
                    //         $("#common_select_shift").append(
                    //             $("<option>", {
                    //                 text: shift.name,
                    //                 value: shift.id,
                    //             })
                    //         );
                    //     });
                    // }
                    if (data.length && Array.isArray(data[0])) {
                        const shifts = data[0]; 
                        
                        $.each(shifts, function (i, shift) {
                            $("#common_select_shift").append(
                                $("<option>", {
                                    text: shift.name,
                                    value: shift.id,
                                })
                            );
                        });
                    }

                    $('#common_select_shift').niceSelect('update');
                    // auto select off, so no trigger('change')
                },

                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function () {
                    i--;
                    if (i <= 0) {
                        $('#common_select_shift_loader').removeClass('pre_loader').addClass('loader');
                    }
                }
            });
        });
        $("#common_select_shift").on("change", function () {
            var url = $("#url").val();
            var i = 0;
            var selectedShiftId = $(this).val();
            if ($('#common_select_academic_div').length) {
                academic_id = $('#common_select_academic_div').find(":selected").val();
            }else{
                academic_id = '';
            }

            $.ajax({
                type: "GET",
                data: { 
                    id: selectedShiftId,
                    academic_id: academic_id ? academic_id : '',
                },
                dataType: "json",
                url: url + "/" + "shift-get-class",

                beforeSend: function () {
                    $('#common_select_class_loader').addClass('pre_loader').removeClass('loader');
                },

                success: function (data) {
                    $("#common_select_class").empty().append(
                        $("<option>", {
                            value: '',
                            text: window.jsLang('select_class') + class_required,
                        })
                    );

                    if (data.length) {
                        $.each(data, function (i, className) {
                            $("#common_select_class").append(
                                $("<option>", {
                                    value: className.id,
                                    text: className.class_name,
                                })
                            );
                        });
                    }

                    $('#common_select_class').niceSelect('update');
                    // auto select off, so no trigger('change')
                },

                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function () {
                    i--;
                    if (i <= 0) {
                        $('#common_select_class_loader').removeClass('pre_loader').addClass('loader');
                    }
                }
            });
        });
        <?php else: ?>
        $("#common_select_academic").on("change", function () {
            var url = $("#url").val();
            var i = 0;
            var selectedAcademicId = $("#common_select_academic").val();

            $.ajax({
                type: "GET",
                data: { id: selectedAcademicId },
                dataType: "json",
                url: url + "/" + "academic-year-get-class",

                beforeSend: function () {
                    $('#common_select_class_loader').addClass('pre_loader').removeClass('loader');
                },

                success: function (data) {
                    $("#common_select_class").empty().append(
                        $("<option>", {
                            value: '',
                            text: window.jsLang('select_class') + class_required,
                        })
                    );

                    if (data.length) {
                        $.each(data, function (i, className) {
                            $("#common_select_class").append(
                                $("<option>", {
                                    value: className.id,
                                    text: className.name,
                                })
                            );
                        });
                    }

                    $('#common_select_class').niceSelect('update');
                },

                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function () {
                    i--;
                    if (i <= 0) {
                        $('#common_select_class_loader').removeClass('pre_loader').addClass('loader');
                    }
                }
            });
        });
        <?php endif; ?>

        $("#common_select_class").on("change", function () {
            var url = $("#url").val();
            var i = 0;
            var shift_id=null;
            if ($('#common_select_shift').length) {
                shift_id = $('#common_select_shift').find(":selected").val();
            }
            var formData = {
                id: $(this).val(),
                shift_id: shift_id,
            };
            // var formData = {
            //     id: $(this).val(),
            // };
            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: url + "/" + "ajaxStudentPromoteSection",

                beforeSend: function () {
                    $('#common_select_section_loader').addClass('pre_loader').removeClass('loader');
                },
                success: function (data) {
                    $("#common_select_section").empty().append(
                        $("<option>", {
                            value: '',
                            text: window.jsLang('select_section') + section_required,
                        })
                    );

                    if (data[0].length) {
                        $.each(data[0], function (i, section) {
                            $("#common_select_section").append(
                                $("<option>", {
                                    value: section.id,
                                    text: section.section_name,
                                })
                            );
                        });
                    }

                    $('#common_select_section').niceSelect('update');
                    $('#common_select_section').trigger('change');
                },
                error: function (data) {
                    console.log("Error:", data);
                },
                complete: function () {
                    i--;
                    if (i <= 0) {
                        $('#common_select_section_loader').removeClass('pre_loader').addClass('loader');
                    }
                }
            });
        });

    });
    // $("#common_select_section").on("change", function () {
    //     var url = $("#url").val();
    //     var i = 0;
    //     var subject = " subject variable ";
    //     var select_class = $("#common_select_class").val();
    //     var class_id = $("#common_select_class").val();
    //     var section_id = $(this).val();

    //     var formData = {
    //         section: $(this).val(),
    //         class: $("#common_select_class").val(),
    //     };
    //     // get section for student
    //     if(subject == false)
    //     {
    //     $.ajax({
    //         type: "GET",
    //         data: formData,
    //         dataType: "json",
    //         url: url + "/" + "ajaxSelectStudent",

    //         beforeSend: function () {
    //             $('#common_select_student_loader').addClass('pre_loader').removeClass(
    //                 'loader');
    //         },

    //         success: function (data) {

    //             $("#common_select_student").empty().append(
    //                 $("<option>", {
    //                     value: '',
    //                     text: window.jsLang('select_student') +
    //                         student_required,
    //                 })
    //             );

    //             if (data[0].length) {
    //                 $.each(data[0], function (i, student) {
    //                     $("#common_select_student").append(
    //                         $("<option>", {
    //                             value: student.id,
    //                             text: student.full_name,
    //                         })
    //                     );
    //                 });
    //             }
    //             $('#common_select_student').niceSelect('update');
    //             $('#common_select_student').trigger('change');
    //         },
    //         error: function (data) {
    //             console.log("Error:", data);
    //         },
    //         complete: function () {
    //             i--;
    //             if (i <= 0) {
    //                 $('#common_select_student_loader').removeClass('pre_loader')
    //                     .addClass('loader');
    //             }
    //         }
    //     });
    //     }
    //     // get subject from section
    //     if(subject == true)
    //     {
    //         getSubject(class_id, section_id);
    //     }
    // });
    // function getSubject(class_id, section_id) {
    //     var url = $("#url").val();
    //     var i = 0;
    //     $.ajax({
    //         type: "GET",
    //         data: {class: class_id, section: section_id},
    //         dataType: "json",
    //         url: url + "/" + "ajaxSelectSubject",

    //         beforeSend: function () {
    //             $('#common_select_student_loader').addClass('pre_loader').removeClass('loader');
    //         },

    //         success: function (data) {

    //             $("#common_select_subject").empty().append(
    //                 $("<option>", {
    //                     value: '',
    //                     text: window.jsLang('select_subject'),
    //                 })
    //             );

    //             if (data[0].length) {
    //                 $.each(data[0], function (i, subject) {
    //                     $("#common_select_subject").append(
    //                         $("<option>", {
    //                             value: subject.id,
    //                             text: subject.subject_name,
    //                         })
    //                     );
    //                 });
    //             }
    //             $('#common_select_subject').niceSelect('update');
    //             $('#common_select_subject').trigger('change');
    //         },
    //         error: function (data) {
    //             console.log("Error:", data);
    //         },
    //         complete: function () {
    //             i--;
    //             if (i <= 0) {
    //                 $('#common_select_student_loader').removeClass('pre_loader').addClass(
    //                     'loader');
    //             }
    //         }
    //     });
    // }
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/backEnd/shift/shift_class_section_include.blade.php ENDPATH**/ ?>