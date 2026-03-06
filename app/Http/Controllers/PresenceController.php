<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\User;
use App\Models\ClassGroup;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        // student view
        if($user->isStudent()){
            $class = $user->classGroup;
            if(!$class || !$class->qr_open){
                // show log only
                $records = Presence::where('user_id',$user->id)->orderBy('date','desc')->get();
                return view('presences.student', compact('records'));
            }
            // student may mark today's presence when QR open
            $date = Carbon::today()->toDateString();
            $present = Presence::where('user_id',$user->id)->where('date',$date)->value('present');
            return view('presences.mark', compact('date','present'));
        }

        // teacher/admin view
        $date = $request->get('date', Carbon::today()->toDateString());
        $groups = ClassGroup::all();
        $selected = $request->get('group_id');
        $students = [];
        if ($selected) {
            $students = User::where('class_group_id', $selected)->where('role','student')->get();
        }
        $presences = Presence::where('date', $date)->pluck('present','user_id')->toArray();
        return view('presences.index', compact('date','groups','selected','students','presences'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'group_id' => 'required|exists:class_groups,id',
            'present' => 'array',
            'present.*' => 'boolean',
        ]);

        foreach (User::where('class_group_id',$data['group_id'])->where('role','student')->get() as $student) {
            $was = in_array($student->id, array_keys($request->input('present',[])));
            Presence::updateOrCreate(
                ['user_id'=>$student->id,'date'=>$data['date']],
                ['present'=>$was]
            );
        }

        return back()->with('status', 'Presenças atualizadas.');
    }
}

