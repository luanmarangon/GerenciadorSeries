<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function create()
    {
        return view('registro.create');
    }

    public function store(Request $request)
    {
        $anexo = null;
        if ( $request->hasFile('anexo') ) {
            $anexo = $request->file('anexo')->store('users');
        }

//        $data = $request->except('_token');
//        $data['password'] = Hash::make($data['password']);
        $passwd = Hash::make($request->password);
//        $passwd =$request->password;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $passwd,
            'anexo' => $anexo
        ]);

///   //        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('listar_series');
    }


}
