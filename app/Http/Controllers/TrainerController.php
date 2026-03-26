<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Role;
use App\Http\Requests\Trainer\StoreTrainerRequest;
use App\Http\Requests\Trainer\UpdateTrainerRequest;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $query = Trainer::with('role');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        $trainers = $query->latest()->paginate(10)->withQueryString();
        $roles = Role::orderBy('name')->get();

        return view('trainers.index', compact('trainers', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('trainers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainerRequest $request)
    {
        Trainer::create($request->validated());

        return redirect()
            ->route('trainers.index')
            ->with('success', 'Trainer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Trainer $trainer)
    {
        $roles = Role::orderBy('name')->get();

        return view('trainers.edit', compact('trainer', 'roles'));
    }

    public function update(UpdateTrainerRequest $request, Trainer $trainer)
    {
        $trainer->update($request->validated());

        return redirect()
            ->route('trainers.index')
            ->with('success', 'Trainer updated successfully.');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();

        return redirect()
            ->route('trainers.index')
            ->with('success', 'Trainer deleted successfully.');
    }
}
