<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'teacher') {
            $groups = \App\Models\ClassGroup::withCount('users')->get();
            return view('dashboard.teacher', compact('user','groups'));
        }
        // student dashboard could go here
        return view('dashboard.student', compact('user'));
    }
}
