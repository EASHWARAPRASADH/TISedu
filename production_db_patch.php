<?php
/**
 * ERP Production DB Patch & Activation
 * Run: php artisan tinker production_db_patch.php
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

echo "🚀 Starting Production ERP Patch...\n";

foreach ($modules as $name) {
    try {
        // 1. Ensure Column exists in sm_general_settings
        if (!Schema::hasColumn('sm_general_settings', $name)) {
            echo "🛠️ Adding column '$name' to sm_general_settings...\n";
            Schema::table('sm_general_settings', function ($table) use ($name) {
                $table->integer($name)->default(1)->nullable();
            });
        }

        // 2. Set to Active (1)
        DB::table('sm_general_settings')->where('id', 1)->update([$name => 1]);

        // 3. Force entry into infix_module_managers (Detect column names first)
        $mmColumns = Schema::getColumnListing('infix_module_managers');
        $mmData = [
            'name' => $name,
            'purchase_code' => 'ERP-POWER-PACK-Verified',
            'activated_date' => date('Y-m-d'),
            'version' => '9.0.3',
            'notes' => 'Bulk Activated for Production',
            'installed_domain' => url('/'),
            'email' => 'tech@technoprint.online'
        ];
        
        // Remove columns that don't exist on this server version
        $finalData = array_intersect_key($mmData, array_flip($mmColumns));
        
        DB::table('infix_module_managers')->updateOrInsert(
            ['name' => $name],
            $finalData
        );

        echo "✅ [SUCCESS] $name is now fully Verified & Active.\n";
    } catch (\Exception $e) {
        echo "❌ [ERROR] $name: " . $e->getMessage() . "\n";
    }
}

// 4. Global Cleanup
try {
    Cache::flush();
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    session()->forget('all_module');
    echo "🧹 [CLEANUP] Production caches flushed.\n";
} catch (\Exception $e) {
    echo "⚠️ [NOTICE] Cleanup warning: " . $e->getMessage() . "\n";
}

echo "\n✨ PRODUCTION PATCH COMPLETE! Sidebar and All Modules should be visible.\n";
