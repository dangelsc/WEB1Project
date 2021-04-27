<?php

namespace App\Http\Controllers;

use App\Models\categorial;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private  $validar = [
        'nombre' => 'required'
    ];
    //listar
        // index mosatrar datos de la db
    public function index(){
        //paginacion
        $numero_por_paginas=2;
        $lista=categorial::where('estado',1)
            ->latest()
            ->paginate($numero_por_paginas);
        //return view('categoria.index',['lista'=>$lista]);
        return view('categoria.index',compact('lista'))
            ->with((request()->input('page',1)-1)*$numero_por_paginas);
    }
    //crear
        //->create  formulario vacio
    public function create(){
        return view('categoria.create');
    }
        //->store   almacena en db
        //Post -> url= dominio.com/categoria/store
    public function store(Request $req){
        $req->validate($this->validar);
        categorial::create($req->all());
        //$this->index();
        return redirect()->route('categoria.index')
            ->with('success','Categoria creada');
    }
    //actualizar
        //-> edit  formulario con datos
    public function edit(/*categorial $categorial*/  $id){
        $categorial=categorial::find($id);
        //dd($categorial);
        
        return view('categoria.edit',compact('categorial'));
    }
        //-> update almacena en db
    public function update(Request $req,$id ){
        $categorial= categorial::find($id);
        $req->validate($this->validar);
        $categorial->update($req->all());
        return redirect()->route('categoria.index')
            ->with('success','Categoria actualizada');
    }
    //borrar
        //destroy actualiza estado a 0
    public function destroy($id){
        //$cate->delete();
        $categorial=categorial::find($id);
        $categorial->estado=0;
        $categorial->update(['estado'=>'0']);
        return redirect()->route('categoria.index')
        ->with('success','Categoria eliminada');
    }
    
}
