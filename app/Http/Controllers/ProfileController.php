<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = $request->validate([
            'locale' => 'required|string',
            'timezone' => 'required|string',
        ]);
        $user->update($data);
        return redirect()->route('profile.edit')->with('status', __('Perfil atualizado'));
    }
}
