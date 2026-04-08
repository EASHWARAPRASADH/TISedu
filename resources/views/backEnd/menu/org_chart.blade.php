@if(userPermission('school_hierarchy'))
<span class="menu_seperator" id="seperator_org_chart" data-section="org_chart">Organisation Chart</span>
<li class="main {{ spn_active_link(['school_hierarchy'], 'mm-active') }}">
    <a href="{{ route('school_hierarchy') }}">
        <div class="nav_icon_small">
            <span class="ti-map"></span>
        </div>
        <div class="nav_title">
            <span>School Hierarchy</span>
        </div>
    </a>
</li>
@endif
