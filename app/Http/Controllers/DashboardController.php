<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\TimeLog;
use App\Models\Trainer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTrainers = Trainer::count();
        $activeTrainers = Trainer::where('status', 'Active')->count();
        $inactiveTrainers = Trainer::where('status', 'Inactive')->count();

        $totalRoles = Role::count();
        $totalPermissions = Permission::count();
        $totalTimeLogs = TimeLog::count();
        //$totalWorkedHours = TimeLog::all()->sum('worked_hours');
        $totalMinutes = TimeLog::all()->sum(function ($log) {
            return (strtotime($log->end_time) - strtotime($log->start_time)) / 60;
        });

        $totalHours = floor($totalMinutes / 60);
        $totalRemainingMinutes = $totalMinutes % 60;

        $totalWorkedHours = "{$totalHours}h {$totalRemainingMinutes}m";

        $recentTrainers = Trainer::with('role')->latest()->take(5)->get();
        $recentTimeLogs = TimeLog::with('trainer')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalTrainers',
            'activeTrainers',
            'inactiveTrainers',
            'totalRoles',
            'totalPermissions',
            'totalTimeLogs',
            'totalWorkedHours',
            'recentTrainers',
            'recentTimeLogs'
        ));
    }
}
