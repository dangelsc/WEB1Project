<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Reuest\RegisterUserRequest;
use App\Http\Requests\ValidatedAuthUserRequest;

class UsuarioController extends Controller
{
    private  $validar = [
        'nombre' => 'required',
        'apellidos'=>'max:20',
        'login'=>'required|min:6',
        'password'=>'required|min:6'
    ];
    public function index(){
        
        $numero_por_paginas=2;
        $lista=Usuario::where('estado',1)
            ->latest()
            ->paginate($numero_por_paginas);
        return view('usuario.index',compact('lista'))
            ->with('i',(request()->input('page',1)-1)*$numero_por_paginas);
    }
    public function create(){
        return view('usuario.create');
    }
    public function store(Request $req){
        $req->validate($this->validar);
        Usuario::create($req->all());
        return redirect()->route('usuario.index')
            ->with('success','usuario creado');
    }
    public function edit(/*Usuario $Usuario*/  $id){
        $Usuario=Usuario::find($id);
        return view('usuario.edit',compact('Usuario'));
    }
    public function update(Request $req,$id ){
        $Usuario= Usuario::find($id);
        $req->validate($this->validar);
        $Usuario->update($req->all());
        return redirect()->route('usuario.index')
            ->with('success','usuario actualizado');
    }
    public function destroy($id){
        $Usuario=Usuario::find($id);
        $Usuario->estado=0;
        $Usuario->update(['estado'=>'0']);
        return redirect()->route('usuario.index')
        ->with('success','usuario eliminado');
    }
    public function login(){
        return view('usuario.login');
    }
    public function authenticate(
        //ValidatedAuthUserRequest $req,
        Usuario $usu){
            echo "**";
          //dd($req);
    }

}
