<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\News;

class UserController extends Controller
{

    public function create() 
    {
        return view('user.user-create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
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

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('user-store', '402');
    }

    public function edit() 
    {
        $user = Auth::user();
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->first();

        return view('user.user-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $userId = auth()->user()->id;

        $user = User::find($userId);

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

    public function myNews()
    {
        $userId = Auth::id();
        $news = News::where('user_id', '=', $userId)->get();

        return view('news.news-all', compact('news'));
    }

}
