<?php if(userPermission('school_hierarchy')): ?>
<span class="menu_seperator" id="seperator_org_chart" data-section="org_chart">Organisation Chart</span>
<li class="main <?php echo e(spn_active_link(['school_hierarchy'], 'mm-active')); ?>">
    <a href="<?php echo e(route('school_hierarchy')); ?>">
        <div class="nav_icon_small">
            <span class="ti-map"></span>
        </div>
        <div class="nav_title">
            <span>School Hierarchy</span>
        </div>
    </a>
</li>
<?php endif; ?>
<?php /**PATH /home/u841409365/domains/test-technoprint.online/public_html/erpv2/resources/views/backEnd/menu/org_chart.blade.php ENDPATH**/ ?>