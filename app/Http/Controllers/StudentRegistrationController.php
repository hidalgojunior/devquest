<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class StudentRegistrationController extends Controller
{
    public function show()
    {
        $groups = ClassGroup::all();
        return view('students.register', compact('groups'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'rm' => 'required|unique:users,rm',
            'name' => 'required|string|max:255',
            'cpf' => ['required','regex:/^(\d{11}|\d{3}\.\d{3}\.\d{3}-\d{2})$/'],
            'phone' => ['required','regex:/^(\d{10,11}|\(\d{2}\)\s?\d{4,5}-\d{4})$/'],
            'birthdate' => 'required|date',
            'github_username' => 'required|string',
            'class_group_id' => 'required|exists:class_groups,id',
        ]);

        // verify github user exists
        $res = Http::get("https://api.github.com/users/{$data['github_username']}");
        if ($res->failed()) {
            return back()->withErrors(['github_username' => 'Usuário GitHub não encontrado']);
        }

        // generate password
        $cpfDigits = preg_replace('/\D/', '', $data['cpf']);
        $phoneDigits = preg_replace('/\D/', '', $data['phone']);
        $year = date('Y', strtotime($data['birthdate']));
        $passwordPlain = substr($cpfDigits,0,3) . $year . substr($phoneDigits,-4);

        $data['password'] = Hash::make($passwordPlain);
        $data['role'] = 'student';

        User::create($data);

        return redirect('/login')->with('status', 'Cadastro realizado! use RM e senha gerada.');
    }
}