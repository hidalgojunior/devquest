<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'github_username' => 'nullable|string|max:255|unique:users,github_username,'.$user->id,
            'github_repository' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ];

        if ($user->isStudent()) {
            $rules['cpf'] = 'nullable|string|max:20';
        }

        if ($user->isTeacher() || $user->isAdmin()) {
            $rules['instagram'] = 'nullable|string|max:255';
            $rules['whatsapp'] = 'nullable|string|max:30';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('avatar')) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('profile.edit')->with('status','Perfil atualizado');
    }
}
