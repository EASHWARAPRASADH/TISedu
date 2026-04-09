<nav class="sa-sidebar" id="sa-sidebar">
    <div class="sa-sidebar-header">
        <a href="{{ route('superadmin-dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 12px;">
            <div class="sa-logo-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="sa-logo-text">
                <h5>{{ \App\Models\SuperAdminSetting::get('platform_name', 'TISEDU') }}</h5>
                <span>Super Admin</span>
            </div>
        </a>
    </div>

    <div class="sa-nav">
        <!-- ================================ -->
        <!-- MAIN -->
        <!-- ================================ -->
        <div class="sa-nav-label">Main</div>

        <a href="{{ route('superadmin-dashboard') }}" class="sa-nav-item {{ request()->routeIs('superadmin-dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>

        <!-- ================================ -->
        <!-- MANAGEMENT -->
        <!-- ================================ -->
        <div class="sa-nav-label">Management</div>

        <a href="{{ route('superadmin.school-list') }}" class="sa-nav-item {{ request()->routeIs('superadmin.school*') ? 'active' : '' }}">
            <i class="fas fa-school"></i>
            <span>Schools</span>
        </a>

        <a href="{{ route('superadmin.users.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.users*') ? 'active' : '' }}">
            <i class="fas fa-users-cog"></i>
            <span>Admin Users</span>
        </a>

        <a href="{{ route('superadmin.subscriptions.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.subscriptions*') ? 'active' : '' }}">
            <i class="fas fa-credit-card"></i>
            <span>Subscriptions</span>
        </a>

        <a href="{{ route('superadmin.modules.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.modules*') ? 'active' : '' }}">
            <i class="fas fa-puzzle-piece"></i>
            <span>Modules</span>
        </a>

        <a href="{{ route('superadmin.impersonate.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.impersonate*') ? 'active' : '' }}">
            <i class="fas fa-user-secret"></i>
            <span>Impersonate</span>
        </a>

        <!-- ================================ -->
        <!-- COMMUNICATION -->
        <!-- ================================ -->
        <div class="sa-nav-label">Communication</div>

        <a href="{{ route('superadmin.communicate.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.communicate*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i>
            <span>Communicate</span>
        </a>

        <a href="{{ route('superadmin.tickets.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.tickets*') ? 'active' : '' }}">
            <i class="fas fa-headset"></i>
            <span>Support Tickets</span>
        </a>

        <!-- ================================ -->
        <!-- INSIGHTS -->
        <!-- ================================ -->
        <div class="sa-nav-label">Insights</div>

        <a href="{{ route('superadmin.reports.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.reports*') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i>
            <span>Reports</span>
        </a>

        <a href="{{ route('superadmin.analytics.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.analytics*') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Analytics</span>
        </a>

        <a href="{{ route('superadmin.audit.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.audit*') ? 'active' : '' }}">
            <i class="fas fa-history"></i>
            <span>Audit Logs</span>
        </a>

        <!-- ================================ -->
        <!-- SYSTEM -->
        <!-- ================================ -->
        <div class="sa-nav-label">System</div>

        <a href="{{ route('superadmin.settings.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.settings*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>

        <a href="{{ route('superadmin.backup.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.backup*') ? 'active' : '' }}">
            <i class="fas fa-database"></i>
            <span>Backups</span>
        </a>

        <a href="{{ route('superadmin.system-logs.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.system-logs*') ? 'active' : '' }}">
            <i class="fas fa-terminal"></i>
            <span>System Logs</span>
        </a>

        <!-- ================================ -->
        <!-- ACCOUNT -->
        <!-- ================================ -->
        <div class="sa-nav-label">Account</div>

        <a href="{{ route('superadmin.profile.index') }}" class="sa-nav-item {{ request()->routeIs('superadmin.profile.index') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i>
            <span>My Profile</span>
        </a>

        <a href="{{ route('superadmin.profile.sessions') }}" class="sa-nav-item {{ request()->routeIs('superadmin.profile.sessions') ? 'active' : '' }}">
            <i class="fas fa-desktop"></i>
            <span>Active Sessions</span>
        </a>
    </div>

    <div class="sa-sidebar-footer">
        @php $sa = Auth::guard('superadmin')->user(); @endphp
        <a href="{{ route('superadmin.profile.index') }}" style="text-decoration: none;">
            <div class="sa-user-info">
                <div class="sa-user-avatar">
                    {{ strtoupper(substr($sa->full_name ?? 'SA', 0, 2)) }}
                </div>
                <div class="sa-user-details">
                    <h6>{{ $sa->full_name ?? 'Super Admin' }}</h6>
                    <span>{{ ucfirst(str_replace('_', ' ', $sa->role ?? 'super_admin')) }}</span>
                </div>
            </div>
        </a>
    </div>
</nav>
