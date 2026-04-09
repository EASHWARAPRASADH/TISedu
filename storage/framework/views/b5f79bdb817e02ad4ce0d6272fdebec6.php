<?php
    $menus = getMenus("staff");
    $paid_modules = ['Zoom', 'University', 'Gmeet', 'QRCodeAttendance', 'BBB', 'ParentRegistration', 'InfixBiometrics', 'AiContent', 'Lms', 'Certificate', 'Jitsi', 'WhatsappSupport', 'InAppLiveClass'];
    $module_enable = false;
    foreach ($paid_modules as $module) {
        if (moduleStatusCheck($module)) {
            $module_enable = true;
        }
    }
    $free_modules = ['Chat', 'fees_collection', 'Fees'];

?>

<?php if(userPermission('automatedtimetable.editor') || userPermission('automatedtimetable.rules')): ?>
<li class="main <?php echo e(spn_active_link(['automatedtimetable.editor', 'automatedtimetable.rules'], 'mm-active')); ?>">
    <a href="javascript:void(0)" class="has-arrow">
        <div class="nav_icon_small">
            <span class="ti-calendar"></span>
        </div>
        <div class="nav_title">
            <span>Automated Timetable</span>
        </div>
    </a>
    <ul class="list-unstyled mm-collapse">
        <?php if(userPermission('automatedtimetable.editor')): ?>
        <li>
            <a href="<?php echo e(route('automatedtimetable.editor')); ?>">
                <div class="nav_icon_small">
                    <span class="ti-pencil-alt"></span>
                </div>
                <div class="nav_title">
                    <span>Generate Timetable</span>
                </div>
            </a>
        </li>
        <?php endif; ?>
        <?php if(userPermission('automatedtimetable.rules')): ?>
        <li>
            <a href="<?php echo e(route('automatedtimetable.rules')); ?>">
                <div class="nav_icon_small">
                    <span class="ti-settings"></span>
                </div>
                <div class="nav_title">
                    <span>Timetable Rules</span>
                </div>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>

<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($menu->route == 'dashboard_section'): ?>
        <span class="menu_seperator" id="<?php echo e($menu->route); ?>" data-section="<?php echo e($menu->route); ?>"><?php echo e(__($menu->lang_name)); ?> </span>
        <?php if($menu->childs->count() > 0): ?>

            <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(userPermission($child->route)): ?>
                    <li class="<?php echo e(spn_active_link([$child->route], "mm-active")); ?> <?php echo e($child->route); ?> main">
                        <a href="<?php echo e(validRouteUrl($child->route)); ?>">
                            <div class="nav_icon_small">
                                <span class="<?php echo e($child->icon); ?>"></span>
                            </div>
                            <div class="nav_title">
                                <span><?php echo e(!empty($child->lang_name) ? __($child->lang_name) : $child->name); ?></span>
                            </div>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php else: ?>
        <?php if($menu->route == 'module_section'): ?>
            <?php if($module_enable): ?>
                <?php if($menu->childs->count() > 0): ?>
                    <span class="menu_seperator" id="seperator_<?php echo e($menu->route); ?>" data-section="<?php echo e($menu->route); ?>"><?php echo e(__($menu->lang_name)); ?>

                    </span>
                    <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($child->childs->count() > 0): ?>
                            <?php if(userPermission($child->route) && isMenuAllowToShow($child->route)): ?>
                                <?php if(!empty($child->module) && in_array($child->module, $paid_modules)): ?>
                                    <?php if(moduleStatusCheck($child->module)): ?>
                                        <?php if ($__env->exists('backEnd.menu.staff_sub_menu', compact('menu', 'child'))) echo $__env->make('backEnd.menu.staff_sub_menu', compact('menu', 'child'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if ($__env->exists('backEnd.menu.staff_sub_menu', compact('menu', 'child'))) echo $__env->make('backEnd.menu.staff_sub_menu', compact('menu', 'child'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php else: ?>
                            <?php if(userPermission($child->route) && isMenuAllowToShow($child->route)): ?>
                                <li class="<?php echo e(spn_active_link([$child->route], "mm-active")); ?>  main">
                                    <a href="<?php echo e(validRouteUrl($child->route)); ?>">
                                        <div class="nav_icon_small">
                                            <span class="<?php echo e($child->icon); ?>"></span>
                                        </div>
                                        <div class="nav_title">
                                            <span><?php echo e(!empty($child->lang_name) ? __($child->lang_name) : $child->name); ?></span>
                                        </div>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            <?php endif; ?>

        <?php else: ?>
            <?php if($menu->childs->count() > 0): ?>
                <span class="menu_seperator" id="seperator_<?php echo e($menu->route); ?>" data-section="<?php echo e($menu->route); ?>"><?php echo e(__($menu->lang_name)); ?>

                </span>
                <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($child->childs->count() > 0): ?>
                        <?php if(userPermission($child->route) && isMenuAllowToShow($child->route)): ?>
                            <?php if($child->module == 'Fees' || $child->module == 'fees_collection'): ?>
                                <?php if($child->module == 'Fees' && generalSetting()->fees_status == 1): ?>
                                    <?php if ($__env->exists('backEnd.menu.staff_sub_menu', compact('menu', 'child'))) echo $__env->make('backEnd.menu.staff_sub_menu', compact('menu', 'child'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php endif; ?>
                                <?php if($child->module == 'fees_collection' && generalSetting()->fees_status == 0): ?>
                                    <?php if ($__env->exists('backEnd.menu.staff_sub_menu', compact('menu', 'child'))) echo $__env->make('backEnd.menu.staff_sub_menu', compact('menu', 'child'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($__env->exists('backEnd.menu.staff_sub_menu', compact('menu', 'child'))) echo $__env->make('backEnd.menu.staff_sub_menu', compact('menu', 'child'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        <?php endif; ?>

                    <?php else: ?>

                        <?php if(userPermission($child->route) && isMenuAllowToShow($child->route)): ?>
                            <?php if($child->route == 'manage-adons'): ?>
                                <?php if(!moduleStatusCheck('Saas')): ?>
                                    <li class="<?php echo e(spn_active_link([$child->route], "mm-active")); ?> <?php echo e($child->route); ?> main">
                                        <a href="<?php echo e(validRouteUrl($child->route)); ?>">
                                            <div class="nav_icon_small">
                                                <span class="<?php echo e($child->icon); ?>"></span>
                                            </div>
                                            <div class="nav_title">
                                                <span><?php echo e(!empty($child->lang_name) ? __($child->lang_name) : $child->name); ?> </span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li class="<?php echo e(spn_active_link([$child->route], "mm-active")); ?> <?php echo e($child->route); ?> main">
                                    <a href="<?php echo e(validRouteUrl($child->route)); ?>">
                                        <div class="nav_icon_small">
                                            <span class="<?php echo e($child->icon); ?>"></span>
                                        </div>
                                        <div class="nav_title">
                                            <span><?php echo e(!empty($child->lang_name) ? __($child->lang_name) : $child->name); ?> </span>
                                        </div>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        <?php endif; ?>
    <?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /Users/eash/Downloads/erpv2/resources/views/backEnd/menu/staff.blade.php ENDPATH**/ ?>