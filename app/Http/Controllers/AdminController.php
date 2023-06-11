<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function allUsers()
    {
        $user = User::withCount('news')->get();

        return view('admin.users-all', compact('user'));
    }

    public function edit($id) 
    {
        $user = User::find($id);

        return view('admin.user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => ['required', Password::min(8)
                    ->letters()
                    ->numbers()],
            ],
            [
                'required' => 'O campo é obrigatório.',
                'email.unique' => 'Este email ja esta sendo usado.',
                'email.email' => 'Precisa ser um email válido.',
                'password' => 'A senha precisa ter pelo menos 8 caracteres com números e letras.'
            ],
        );

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect()->back()->with('user-update', '402');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('user-delete', '402');
    }

}
