<header class="sa-header">
    <div class="sa-header-left">
        <button class="sa-mobile-toggle" type="button">
            <i class="fas fa-bars"></i>
        </button>
        <h4>@yield('title', 'Dashboard')</h4>
    </div>

    <div class="sa-header-right">
        <form action="{{ route('superadmin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="sa-header-btn sa-btn-logout">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>
</header>
