<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    public function index() {
        $perfil = User::first();
        return view('adm.perfil.index', compact('perfil'));
    }

    public function update(Request $request) {
        if($request->senha != $request->confirmar) return redirect()->back()->withErrors("As senhas não conferem.");

        $image_name = "";

        $perfil = User::first();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extensao = $image->getClientOriginalExtension();
            $image_name = getItem('client')."-".Str::uuid().".".$extensao;

            if(File::exists('upload/perfil/'.$perfil->image))
                File::delete('upload/perfil/'.$perfil->image);

            $request->file('image')->move(public_path('upload/perfil/'), $image_name);

        }

        $perfil->update([
            'name' => $request->nome,
            'username' => $request->usuario,
            'email' => $request->email,
            'password' => $request->filled('senha') ? password_hash($request->senha, PASSWORD_DEFAULT) : $perfil->password,
            'image' => $image_name != "" ? $image_name : $perfil->image,
        ]);
        return redirect()->back()->with('success', 'Imagem removida com sucesso!');
    }

    public function deleteImage() {
        $perfil = User::first();

        if(File::exists('upload/perfil/'.$perfil->image))
            File::delete('upload/perfil/'.$perfil->image);


        $perfil->update(['image' => 'user.png']);
        return redirect()->back()->with('success', 'Imagem removida com sucesso!');
    }
}
