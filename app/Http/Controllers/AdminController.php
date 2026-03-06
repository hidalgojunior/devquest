<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\ClassGroup;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function teachers()
    {
        $teachers = User::where('role','teacher')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function teachersCreate()
    {
        return view('admin.teachers.create');
    }

    public function teachersStore(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
        ]);
        $data['role']='teacher';
        $data['password']=bcrypt('password');
        User::create($data);
        return redirect()->route('admin.teachers');
    }

    public function subjects()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function subjectsCreate()
    {
        return view('admin.subjects.create');
    }

    public function subjectsStore(Request $request)
    {
        $data = $request->validate(['name'=>'required']);
        Subject::create($data);
        return redirect()->route('admin.subjects');
    }

    public function groups()
    {
        $groups = ClassGroup::all();
        return view('admin.groups.index', compact('groups'));
    }

    public function groupsCreate()
    {
        return view('admin.groups.create');
    }

    public function groupsStore(Request $request)
    {
        $data = $request->validate(['name'=>'required']);
        ClassGroup::create($data);
        return redirect()->route('admin.groups');
    }
}
