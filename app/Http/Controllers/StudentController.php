<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Group $group): View
    {
        return view('students.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Group $group): RedirectResponse
    {
        $validated = $request->validate([
            'surname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $group->students()->create($validated);

        return redirect()
            ->route('groups.show', $group)
            ->with('success', 'Студент успешно добавлен в группу!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group, Student $student): View
    {
        if ($student->group_id !== $group->id) {
            abort(404);
        }

        return view('students.show', compact('group', 'student'));
    }
}
