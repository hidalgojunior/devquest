<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\ClassGroup;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['subject','classGroup'])->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $groups = ClassGroup::all();
        $days = ['monday'=>'Segunda','tuesday'=>'Terça','wednesday'=>'Quarta','thursday'=>'Quinta','friday'=>'Sexta'];
        $times = ['07:10','08:00','08:50','10:00','10:50','11:40','12:30','13:20','14:10','15:00'];
        return view('schedules.create', compact('subjects','groups','days','times'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'day_of_week'=>'required|in:monday,tuesday,wednesday,thursday,friday',
            'subject_id'=>'required|exists:subjects,id',
            'class_group_id'=>'required|exists:class_groups,id',
            'start_time'=>'required|date_format:H:i',
        ]);
        Schedule::create($data);
        return redirect()->route('schedules.index');
    }
}
