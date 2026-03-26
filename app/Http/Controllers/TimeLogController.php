<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeLog\StoreTimeLogRequest;
use App\Http\Requests\TimeLog\UpdateTimeLogRequest;
use App\Models\TimeLog;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TimeLog::with('trainer');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('trainer', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('trainer_id')) {
            $query->where('trainer_id', $request->trainer_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $timeLogs = $query->latest('date')->paginate(10)->withQueryString();
        $trainers = Trainer::orderBy('name')->get();

        $totalLogs = TimeLog::count();
        $totalMinutes = TimeLog::all()->sum(function ($log) {
            return (strtotime($log->end_time) - strtotime($log->start_time)) / 60;
        });

        $totalHours = floor($totalMinutes / 60);
        $totalRemainingMinutes = $totalMinutes % 60;

        $totalWorkedHours = "{$totalHours}h {$totalRemainingMinutes}m";

        return view('time-logs.index', compact(
            'timeLogs',
            'trainers',
            'totalLogs',
            'totalWorkedHours'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = Trainer::orderBy('name')->get();

        return view('time-logs.create', compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimeLogRequest $request)
    {
        TimeLog::create($request->validated());

        return redirect()
            ->route('time-logs.index')
            ->with('success', 'Time log created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeLog $timeLog)
    {
        $trainers = Trainer::orderBy('name')->get();

        return view('time-logs.edit', compact('timeLog', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimeLogRequest $request, TimeLog $timeLog)
    {
        $timeLog->update($request->validated());

        return redirect()
            ->route('time-logs.index')
            ->with('success', 'Time log updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeLog $timeLog)
    {
        $timeLog->delete();

        return redirect()
            ->route('time-logs.index')
            ->with('success', 'Time log deleted successfully.');
    }
}
