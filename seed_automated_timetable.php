<?php

use Illuminate\Support\Facades\DB;
use App\InfixModuleManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

echo "🚀 Automated Timetable Module Seeder Starting...\n";

// 1. Activate Module
try {
    DB::table('infix_module_managers')->updateOrInsert(
        ['name' => 'AutomatedTimetable'],
        [
            'email' => 'admin@infixedu.com', 
            'purchase_code' => 'verified-by-ai',
            'activated_date' => date('Y-m-d'),
            'active_status' => 1,
            'is_verified' => 1,
            'version' => '1.0',
            'notes' => 'Bulk Activated'
        ]
    );
    echo "✅ AutomatedTimetable registered as Verified in DB.\n";
} catch (\Exception $e) {
    echo "⚠️ Could not update infix_module_managers: " . $e->getMessage() . "\n";
}

// 2. Enable in General Settings
try {
    if (\Illuminate\Support\Facades\Schema::hasColumn('sm_general_settings', 'AutomatedTimetable')) {
        DB::table('sm_general_settings')->update(['AutomatedTimetable' => 1]);
        echo "✅ AutomatedTimetable active_status flag set in General Settings.\n";
    }
} catch (\Exception $e) {
    echo "⚠️ Could not update general settings: " . $e->getMessage() . "\n";
}

// 3. Create Sidebar Menu directly (Top Level)
$route = 'automatedtimetable.index';
try {
    $parent = DB::table('sm_menus')->where('route', $route)->first();
    
    if(!$parent) {
        $parentId = DB::table('sm_menus')->insertGetId([
            'name' => 'Automated Timetable',
            'route' => $route,
            'parent_id' => 0,
            'lang_name' => 'Automated Timetable',
            'icon' => 'flaticon-calendar-1',
            'permission_id' => 1,
            'role_id' => 1,
            'status' => 1,
            'position' => 10,
            'school_id' => 1
        ]);
        echo "✅ Top level 'Automated Timetable' menu created (ID: $parentId).\n";
        
        // Let's add sub-menus
        DB::table('sm_menus')->insert([
            ['name' => 'Grid Editor', 'route' => 'automatedtimetable.editor', 'parent_id' => $parentId, 'lang_name' => 'Grid Editor', 'icon' => '', 'permission_id' => 1, 'role_id' => 1, 'status' => 1, 'position' => 1, 'school_id' => 1],
            ['name' => 'Teacher Subs', 'route' => 'automatedtimetable.substitutes', 'parent_id' => $parentId, 'lang_name' => 'Teacher Subs', 'icon' => '', 'permission_id' => 1, 'role_id' => 1, 'status' => 1, 'position' => 2, 'school_id' => 1]
        ]);
    } else {
         echo "ℹ️ Sidebar entries already exist.\n";
    }
} catch (\Exception $e) {
     echo "⚠️ Error seeding sm_menus: " . $e->getMessage() . "\n";
}

// 4. Update modules_statuses.json
$jsonPath = base_path('modules_statuses.json');
if (file_exists($jsonPath)) {
    $statuses = json_decode(file_get_contents($jsonPath), true);
    $statuses['AutomatedTimetable'] = true;
    file_put_contents($jsonPath, json_encode($statuses, JSON_PRETTY_PRINT));
    echo "✅ modules_statuses.json updated.\n";
}

// 5. Clear Caches
try {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Cache::forget('activator.installed');
    echo "🧹 Caches cleared.\n";
} catch (\Exception $e) {}

echo "✨ Automated Timetable Module Seeder Complete!\n";
