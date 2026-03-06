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
        $activities = Activity::with('classGroup')->orderBy('due_date');
        if(auth()->user()->isStudent()){
            $user = auth()->user();
            $activities = $activities->where(function($q) use($user){
                $q->where('open_to_all', true)
                  ->orWhere('class_group_id', $user->class_group_id);
            })
            ->where('is_draft', false)
            ->where(function($q){
                $q->whereNull('visible_from')
                  ->orWhere('visible_from','<=',now());
            });
        }
        $activities = $activities->get();
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
            'title' => ['required','string','max:255','regex:/^[A-Za-z0-9._-]+$/'],
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'class_group_id' => 'nullable|exists:class_groups,id',
            'is_bonus' => 'boolean',
            'open_to_all' => 'boolean',
            'is_draft' => 'boolean',
            'visible_from' => 'nullable|date',
        ]);
        $data['is_bonus'] = $request->has('is_bonus');

        if(!empty($data['open_to_all'])){
            $data['class_group_id'] = null;
        }
        Activity::create($data);
        return redirect()->route('activities.index')->with('status', 'Atividade criada.');
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
            'title' => ['required','string','max:255','regex:/^[A-Za-z0-9._-]+$/'],
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'class_group_id' => 'nullable|exists:class_groups,id',
            'is_bonus' => 'boolean',
            'closed' => 'boolean',
            'open_to_all' => 'boolean',
            'is_draft' => 'boolean',
            'visible_from' => 'nullable|date',
        ]);
        $data['is_bonus'] = $request->has('is_bonus');
        $data['closed'] = $request->has('closed');
        if(!empty($data['open_to_all'])){
            $data['class_group_id'] = null;
        }
        $activity->update($data);
        return redirect()->route('activities.index')->with('status', 'Atividade atualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return back()->with('status', 'Atividade removida.');
    }
}
