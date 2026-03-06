<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private function ensureAdmin(): void
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();
        return view('admin.dashboard');
    }

    public function teachers()
    {
        $this->ensureAdmin();
        $teachers = User::where('role','teacher')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function teachersCreate()
    {
        $this->ensureAdmin();
        return view('admin.teachers.create');
    }

    public function teachersStore(Request $request)
    {
        $this->ensureAdmin();
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
        $this->ensureAdmin();
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function subjectsCreate()
    {
        $this->ensureAdmin();
        return view('admin.subjects.create');
    }

    public function subjectsStore(Request $request)
    {
        $this->ensureAdmin();
        $data = $request->validate(['name'=>'required']);
        Subject::create($data);
        return redirect()->route('admin.subjects');
    }

    public function groups()
    {
        $this->ensureAdmin();
        $groups = ClassGroup::all();
        return view('admin.groups.index', compact('groups'));
    }

    public function groupsCreate()
    {
        $this->ensureAdmin();
        return view('admin.groups.create');
    }

    public function groupsStore(Request $request)
    {
        $this->ensureAdmin();
        $data = $request->validate(['name'=>'required']);
        ClassGroup::create($data);
        return redirect()->route('admin.groups');
    }

    public function purgeTestData(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'admin_secret' => 'required|string',
        ]);

        if ($data['admin_secret'] !== '@Jr34139251@') {
            return back()->withErrors(['admin_secret' => 'Senha de autorização inválida.']);
        }

        DB::transaction(function () {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            DB::table('git_commits')->truncate();
            DB::table('submissions')->truncate();
            DB::table('presences')->truncate();
            DB::table('occurrences')->truncate();
            DB::table('messages')->truncate();
            DB::table('activities')->truncate();
            DB::table('schedules')->truncate();
            DB::table('subjects')->truncate();
            DB::table('class_groups')->truncate();

            User::where('role', '!=', 'admin')->delete();

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        });

        return back()->with('status', 'Dados de teste apagados com sucesso.');
    }
}
