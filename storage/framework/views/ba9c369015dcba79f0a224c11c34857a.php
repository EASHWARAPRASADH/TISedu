<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="SuperAdmin Panel - <?php echo e(\App\Models\SuperAdminSetting::get('platform_name', 'TISEDU')); ?>">
    <title><?php echo $__env->yieldContent('title', 'SuperAdmin Panel'); ?> - <?php echo e(\App\Models\SuperAdminSetting::get('platform_name', 'TISEDU')); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/vendors/css/bootstrap.css')); ?>">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login')); ?>/css/themify-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sa-primary: #667eea;
            --sa-primary-dark: #5a67d8;
            --sa-secondary: #764ba2;
            --sa-bg-dark: #0f1117;
            --sa-bg-card: #1a1d29;
            --sa-bg-sidebar: #141620;
            --sa-bg-hover: #1e2235;
            --sa-border: rgba(255,255,255,0.06);
            --sa-text-primary: #e4e7ec;
            --sa-text-secondary: rgba(255,255,255,0.5);
            --sa-text-muted: rgba(255,255,255,0.3);
            --sa-success: #34d399;
            --sa-danger: #f87171;
            --sa-warning: #fbbf24;
            --sa-info: #60a5fa;
            --sa-sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--sa-bg-dark);
            color: var(--sa-text-primary);
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sa-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sa-sidebar-width);
            background: var(--sa-bg-sidebar);
            border-right: 1px solid var(--sa-border);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sa-sidebar-header {
            padding: 24px;
            border-bottom: 1px solid var(--sa-border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sa-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--sa-primary), var(--sa-secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sa-logo-icon i { color: #fff; font-size: 18px; }

        .sa-logo-text h5 {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .sa-logo-text span {
            font-size: 11px;
            color: var(--sa-text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sa-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
        }

        .sa-nav::-webkit-scrollbar { width: 4px; }
        .sa-nav::-webkit-scrollbar-track { background: transparent; }
        .sa-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        .sa-nav-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--sa-text-muted);
            padding: 16px 12px 8px;
        }

        .sa-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--sa-text-secondary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 2px;
            transition: all 0.2s ease;
        }

        .sa-nav-item:hover {
            background: var(--sa-bg-hover);
            color: var(--sa-text-primary);
            text-decoration: none;
        }

        .sa-nav-item.active {
            background: linear-gradient(135deg, rgba(102,126,234,0.15), rgba(118,75,162,0.1));
            color: var(--sa-primary);
            border: 1px solid rgba(102,126,234,0.2);
        }

        .sa-nav-item i { width: 18px; text-align: center; font-size: 14px; }

        .sa-sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--sa-border);
        }

        .sa-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
        }

        .sa-user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--sa-primary), var(--sa-secondary));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .sa-user-details h6 { font-size: 13px; font-weight: 600; margin: 0; color: var(--sa-text-primary); }
        .sa-user-details span { font-size: 11px; color: var(--sa-text-muted); }

        /* ========== HEADER ========== */
        .sa-header {
            position: fixed;
            top: 0;
            left: var(--sa-sidebar-width);
            right: 0;
            height: 64px;
            background: var(--sa-bg-card);
            border-bottom: 1px solid var(--sa-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 999;
        }

        .sa-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sa-header-left h4 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .sa-mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--sa-text-primary);
            font-size: 20px;
            cursor: pointer;
        }

        .sa-header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sa-header-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .sa-btn-logout {
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.2);
            color: var(--sa-danger);
        }

        .sa-btn-logout:hover {
            background: rgba(248,113,113,0.2);
            text-decoration: none;
            color: var(--sa-danger);
        }

        /* ========== MAIN CONTENT ========== */
        .sa-main {
            margin-left: var(--sa-sidebar-width);
            margin-top: 64px;
            padding: 28px;
            min-height: calc(100vh - 64px);
        }

        /* ========== ALERTS ========== */
        .sa-alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sa-alert-success {
            background: rgba(52,211,153,0.1);
            border: 1px solid rgba(52,211,153,0.2);
            color: var(--sa-success);
        }

        .sa-alert-danger {
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.2);
            color: var(--sa-danger);
        }

        /* ========== CARDS ========== */
        .sa-card {
            background: var(--sa-bg-card);
            border: 1px solid var(--sa-border);
            border-radius: 12px;
            padding: 24px;
        }

        .sa-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .sa-card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--sa-text-primary);
        }

        /* ========== TABLE ========== */
        .sa-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sa-table thead th {
            padding: 12px 16px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--sa-text-muted);
            border-bottom: 1px solid var(--sa-border);
            text-align: left;
        }

        .sa-table tbody td {
            padding: 12px 16px;
            font-size: 13px;
            color: var(--sa-text-secondary);
            border-bottom: 1px solid var(--sa-border);
        }

        .sa-table tbody tr:hover { background: var(--sa-bg-hover); }

        /* ========== BADGES ========== */
        .sa-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .sa-badge-success { background: rgba(52,211,153,0.15); color: var(--sa-success); }
        .sa-badge-danger { background: rgba(248,113,113,0.15); color: var(--sa-danger); }
        .sa-badge-warning { background: rgba(251,191,36,0.15); color: var(--sa-warning); }
        .sa-badge-info { background: rgba(96,165,250,0.15); color: var(--sa-info); }

        /* ========== BUTTONS ========== */
        .sa-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .sa-btn-primary {
            background: linear-gradient(135deg, var(--sa-primary), var(--sa-secondary));
            color: #fff;
        }

        .sa-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102,126,234,0.3);
            text-decoration: none;
            color: #fff;
        }

        .sa-btn-outline {
            background: transparent;
            border: 1px solid var(--sa-border);
            color: var(--sa-text-secondary);
        }

        .sa-btn-outline:hover {
            background: var(--sa-bg-hover);
            color: var(--sa-text-primary);
            text-decoration: none;
        }

        .sa-btn-sm { padding: 5px 10px; font-size: 12px; }

        .sa-btn-danger {
            background: rgba(248,113,113,0.15);
            color: var(--sa-danger);
            border: 1px solid rgba(248,113,113,0.2);
        }

        .sa-btn-danger:hover {
            background: rgba(248,113,113,0.25);
            text-decoration: none;
            color: var(--sa-danger);
        }

        .sa-btn-success {
            background: rgba(52,211,153,0.15);
            color: var(--sa-success);
            border: 1px solid rgba(52,211,153,0.2);
        }

        .sa-btn-success:hover {
            background: rgba(52,211,153,0.25);
            text-decoration: none;
            color: var(--sa-success);
        }

        /* ========== FORMS ========== */
        .sa-form-group { margin-bottom: 20px; }

        .sa-form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--sa-text-secondary);
            margin-bottom: 6px;
        }

        .sa-form-control {
            width: 100%;
            padding: 10px 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--sa-border);
            border-radius: 8px;
            color: var(--sa-text-primary);
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s ease;
        }

        .sa-form-control:focus {
            border-color: var(--sa-primary);
            box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
        }

        .sa-form-control::placeholder { color: var(--sa-text-muted); }

        select.sa-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 36px;
        }

        /* ========== PAGINATION ========== */
        .sa-pagination { display: flex; gap: 4px; justify-content: center; margin-top: 20px; }

        .sa-pagination .page-link {
            padding: 6px 12px;
            background: var(--sa-bg-card);
            border: 1px solid var(--sa-border);
            border-radius: 6px;
            color: var(--sa-text-secondary);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sa-pagination .page-item.active .page-link {
            background: var(--sa-primary);
            border-color: var(--sa-primary);
            color: #fff;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 991px) {
            .sa-sidebar { transform: translateX(-100%); }
            .sa-sidebar.show { transform: translateX(0); }
            .sa-header { left: 0; }
            .sa-main { margin-left: 0; }
            .sa-mobile-toggle { display: block; }
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

    <!-- Sidebar -->
    <?php echo $__env->make('backEnd.superAdmin.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Header -->
    <?php echo $__env->make('backEnd.superAdmin.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <main class="sa-main">
        <?php if(session('message-success')): ?>
            <div class="sa-alert sa-alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo e(session('message-success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('message-danger')): ?>
            <div class="sa-alert sa-alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo e(session('message-danger')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Scripts -->
    <script src="<?php echo e(asset('public/backEnd/vendors/js/vendor.bundle.base.js')); ?>"></script>
    <script>
        // Mobile sidebar toggle
        document.querySelector('.sa-mobile-toggle')?.addEventListener('click', function() {
            document.querySelector('.sa-sidebar').classList.toggle('show');
        });

        // Close sidebar on overlay click (mobile)
        document.addEventListener('click', function(e) {
            const sidebar = document.querySelector('.sa-sidebar');
            const toggle = document.querySelector('.sa-mobile-toggle');
            if (sidebar && !sidebar.contains(e.target) && !toggle?.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/eash/Downloads/erpv2 2/resources/views/backEnd/superAdmin/layouts/master.blade.php ENDPATH**/ ?>