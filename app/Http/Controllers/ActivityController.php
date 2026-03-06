<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ClassGroup;
use Carbon\Carbon;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with('classGroup')->orderBy('due_date')->get();
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = ClassGroup::all();
        return view('activities.form', ['activity' => new Activity(), 'groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'class_group_id' => 'required|exists:class_groups,id',
            'is_bonus' => 'boolean',
        ]);
        $data['is_bonus'] = $request->has('is_bonus');

        Activity::create($data);
        return redirect()->route('activities.index')->with('status', __('Atividade criada.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = Activity::findOrFail($id);
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activity::findOrFail($id);
        $groups = ClassGroup::all();
        return view('activities.form', compact('activity','groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activity = Activity::findOrFail($id);
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'class_group_id' => 'required|exists:class_groups,id',
            'is_bonus' => 'boolean',
            'closed' => 'boolean',
        ]);
        $data['is_bonus'] = $request->has('is_bonus');
        $data['closed'] = $request->has('closed');
        $activity->update($data);
        return redirect()->route('activities.index')->with('status', __('Atividade atualizada.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return back()->with('status', __('Atividade removida.'));
    }
}
