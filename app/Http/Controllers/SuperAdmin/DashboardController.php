<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdminAuditLog;
use App\SmSchool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the SuperAdmin dashboard with aggregate statistics.
     *
     * Provides a platform-wide overview including school counts,
     * student/staff totals, subscription data, and recent activities.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $superAdmin = Auth::guard('superadmin')->user();

        // Initialize metrics with defaults
        $totalSchools = 0;
        $activeSchools = 0;
        $inactiveSchools = 0;
        $totalStudents = 0;
        $totalStaff = 0;
        $totalParents = 0;
        $totalUsers = 0;
        $activeSubscriptions = 0;
        $totalRevenue = 0;

        try {
            // School Statistics
            if (DB::getSchemaBuilder()->hasTable('sm_schools')) {
                $totalSchools = SmSchool::count();
                $activeSchools = SmSchool::where('active_status', 1)->count();
                $inactiveSchools = $totalSchools - $activeSchools;

                // Subscription Statistics (Native SaaS Sync)
                $activeSubscriptions = SmSchool::where('id', '!=', 1)
                    ->where('active_status', 1)
                    ->where('ending_date', '>=', now())
                    ->count();
            }

            // User Statistics (across all schools)
            if (DB::getSchemaBuilder()->hasTable('sm_students')) {
                $totalStudents = DB::table('sm_students')->count();
            }
            if (DB::getSchemaBuilder()->hasTable('sm_staffs')) {
                $totalStaff = DB::table('sm_staffs')->count();
            }
            if (DB::getSchemaBuilder()->hasTable('sm_parents')) {
                $totalParents = DB::table('sm_parents')->count();
            }
            if (DB::getSchemaBuilder()->hasTable('users')) {
                $totalUsers = DB::table('users')->count();
            }

            // Revenue Statistics
            if (DB::getSchemaBuilder()->hasTable('sm_subscription_payments')) {
                $totalRevenue = DB::table('sm_subscription_payments')
                    ->where('approve_status', 'approved')
                    ->sum('amount');
            }

            // Recent Activities (last 10 audit logs)
            $recentActivities = SuperAdminAuditLog::with('superAdmin')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            // Recent Schools (last 5 created)
            $recentSchools = DB::getSchemaBuilder()->hasTable('sm_schools') 
                ? SmSchool::orderBy('created_at', 'desc')->limit(5)->get()
                : collect();

            // System Health
            $systemHealth = [
                'php_version' => PHP_VERSION,
                'laravel_version' => app()->version(),
                'server_time' => now()->format('Y-m-d H:i:s'),
                'cache_driver' => config('cache.default'),
                'session_driver' => config('session.driver'),
                'queue_driver' => config('queue.default'),
                'disk_free' => @disk_free_space('/') ? round(disk_free_space('/') / (1024 * 1024 * 1024), 2) . ' GB' : 'N/A',
            ];

            return view('backEnd.superAdmin.dashboard', compact(
                'superAdmin',
                'totalSchools',
                'activeSchools',
                'inactiveSchools',
                'totalStudents',
                'totalStaff',
                'totalParents',
                'totalUsers',
                'activeSubscriptions',
                'totalRevenue',
                'recentActivities',
                'recentSchools',
                'systemHealth'
            ));

        } catch (\Exception $e) {
            Log::error('SuperAdmin Dashboard error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Fallback to minimal dashboard if critical error occurs
            return view('backEnd.superAdmin.dashboard', [
                'superAdmin' => $superAdmin,
                'totalSchools' => $totalSchools,
                'activeSchools' => $activeSchools,
                'inactiveSchools' => $inactiveSchools,
                'totalStudents' => $totalStudents,
                'totalStaff' => $totalStaff,
                'totalParents' => $totalParents,
                'totalUsers' => $totalUsers,
                'activeSubscriptions' => $activeSubscriptions,
                'totalRevenue' => $totalRevenue,
                'recentActivities' => $recentActivities ?? collect(),
                'recentSchools' => $recentSchools ?? collect(),
                'systemHealth' => $systemHealth ?? [],
            ]);
        }
    }

    /**
     * Display system health information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function systemHealth()
    {
        $health = [
            'status' => 'operational',
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'server_time' => now()->toIso8601String(),
            'database' => $this->checkDatabaseHealth(),
            'cache' => $this->checkCacheHealth(),
            'storage' => $this->checkStorageHealth(),
        ];

        return response()->json($health);
    }

    /**
     * Check database connectivity.
     */
    private function checkDatabaseHealth(): array
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'connected', 'driver' => config('database.default')];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Check cache health.
     */
    private function checkCacheHealth(): array
    {
        try {
            cache()->put('health_check', true, 10);
            $result = cache()->get('health_check');
            cache()->forget('health_check');
            return ['status' => $result ? 'working' : 'error', 'driver' => config('cache.default')];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Check storage health.
     */
    private function checkStorageHealth(): array
    {
        $free = @disk_free_space('/');
        $total = @disk_total_space('/');

        if ($free === false || $total === false) {
            return ['status' => 'unknown'];
        }

        return [
            'status' => 'available',
            'free_gb' => round($free / (1024 * 1024 * 1024), 2),
            'total_gb' => round($total / (1024 * 1024 * 1024), 2),
            'used_percent' => round((1 - $free / $total) * 100, 1),
        ];
    }
}
