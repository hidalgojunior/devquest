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
            // ranking
            $students = User::where('role','student')->get();
            $ranking = $students->map(function($s){
                $pts = \App\Services\ScoreCalculator::calculateForUser($s);
                $lb = \App\Services\ScoreCalculator::levelAndBadge($pts);
                return ['user'=>$s,'points'=>$pts,'level'=>$lb['level'],'badge'=>$lb['badge']];
            })->sortByDesc('points')->values();
            return view('dashboard.teacher', compact('user','groups','ranking'));
        }
        // student dashboard could go here
        return view('dashboard.student', compact('user'));
    }
}
