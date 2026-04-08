<?php
/**
 * ERP Module Auto-Activation Script
 * Run this on the production server via:
 * php artisan tinker activate_erp_modules.php
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;

$modules = [
    'Zoom', 'OnlineExam', 'ParentRegistration', 'RazorPay', 'BBB', 'Jitsi', 
    'Saas', 'XenditPayment', 'AppSlider', 'KhaltiPayment', 'Raudhahpay', 
    'InfixBiometrics', 'Gmeet', 'PhonePay', 'Lms', 'CcAveune', 'AiContent', 
    'WhatsappSupport', 'Certificate', 'InAppLiveClass', 'MercadoPago', 
    'University', 'ToyyibPay', 'News', 'PDF', 'SaasHr', 'Forum', 
    'CustomMenu', 'QRCodeAttendance', 'SslCommerz', 'DashboardAnalytics', 
    'AdvancedStudentPortal', 'AdvancedHrPortal', 'AdvancedExamPortal', 
    'SmartTransport', 'SmartCommunication', 'SmartFrontOffice'
];

echo "🚀 Starting ERP Module Activation Suite...\n";

foreach ($modules as $name) {
    try {
        // 1. Force entry into infix_module_managers
        DB::table('infix_module_managers')->updateOrInsert(
            ['name' => $name],
            [
                'purchase_code' => 'verified-by-erp-suite',
                'activated_date' => date('Y-m-d'),
                'active_status' => 1,
                'is_verified' => 1,
                'version' => '9.0.3',
                'notes' => 'Bulk Activated',
                'installed_domain' => url('/'),
                'email' => 'admin@technoprint.online'
            ]
        );

        // 2. Activate flag in sm_general_settings (if exists)
        if (Schema::hasColumn('sm_general_settings', $name)) {
            DB::table('sm_general_settings')->where('id', 1)->update([$name => 1]);
        }
        
        echo "✅ [SUCCESS] $name is now Verified & Active.\n";
    } catch (\Exception $e) {
        echo "❌ [ERROR] $name: " . $e->getMessage() . "\n";
    }
}

// 3. Force Cache/Session Purge
try {
    Cache::flush();
    session()->forget('all_module');
    echo "🧹 [CLEANUP] All caches flushed.\n";
} catch (\Exception $e) {
    echo "⚠️ [NOTICE] Cache flush skipped: " . $e->getMessage() . "\n";
}

echo "\n✨ DONE! Please refresh your 'Manage Add-ons' page on $name.\n";
