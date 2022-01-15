<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('users.index', compact('mensagem'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        if (empty($request->newpasswd)){
            $npasswd = $usuario->password;
        }else{
            $npasswd = $request->newpasswd;
            $npasswd = Hash::make($request->newpasswd);
        }

        if ( $request->newpasswd <> $request->confpasswd ) {
            $request->session()
                ->flash(
                    'mensagem',
                    "Senhas não conferem. Verifique por favor!"
                );
        } else {
            $usuario->name = $request->nome;
            $usuario->email = $request->email;
            $usuario->password = $npasswd;

            $usuario->save();

            $request->session()
                ->flash(
                    'mensagem',
                    "Dados Alterados com sucesso!"
                );
        }

        return redirect()->route('profile');
    }

    public function upload(Request $request)
    {
        $usuario = Auth::user();
        $anexo = null;
        if ( $request->hasFile('anexo') ) {
            $anexo = $request->file('anexo')->store('users');
        }

        if ( $usuario->anexo ) {
            echo $usuario->anexo;
            $remove = explode("/", $usuario->anexo);
            echo "<br> $remove[1]";
            Storage::delete($usuario->anexo);

        }

        $usuario->anexo = $anexo;
        $usuario->save();

        $request->session()
            ->flash(
                'mensagem',
                "Avatar Alterado com sucesso!"
            );
        return redirect()->route('profile');

    }

    public function removeAvatar(Request $request)
    {
        $usuario = Auth::user();
        $anexo = null;

        if ( $usuario->anexo ) {
            echo $usuario->anexo;
            $remove = explode("/", $usuario->anexo);
            echo "<br> $remove[1]";
            Storage::delete($usuario->anexo);
        }

        $usuario->anexo = $anexo;
        $usuario->save();
        $request->session()
            ->flash(
                'mensagem',
                "Avatar Removido com sucesso!"
            );
        return redirect()->route('profile');

    }

    public function list()
    {
        $users = User::all();

        return view('users.list', compact('users'));

    }
}
