<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $groups = Group::withCount('students')
            ->orderBy('id', 'asc')
            ->get();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'start_from' => ['required', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Group::create($validated);

        return redirect()
            ->route('groups.index')
            ->with('success', 'Группа успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group): View
    {
        $group->load('students');

        return view('groups.show', compact('group'));
    }
}
