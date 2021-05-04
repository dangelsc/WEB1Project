<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\Ventadetalle;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    private  $validar = [
        'nombre' => 'required',
        'detalle'=>'required',
        
    ];
    public function index(){
        $numero_por_paginas=2;
        $lista= Venta::where('estado',1)
            ->latest()
            ->paginate($numero_por_paginas);
        return view('venta.index',compact('lista'))
            ->with('i',(request()->input('page',1)-1)*$numero_por_paginas);
    }
    public function create(){
        $productos=Producto::where('estado',1)->get();
        //dd($productos);
        return view('venta.create',compact('productos'));
    }
    public function store(Request $req){
        $req->validate($this->validar);
        $venta=null;
        try{
            DB::beginTransaction();
            $venta=Venta::create($req->all())->id_venta;
            //dd($venta);
            $det=json_decode($req->detalle);
            for($i=0;$i<count($det);$i++){
                $det[$i]->id_venta=$venta;
                unset($det[$i]->producto);
                //dd($det[$i]);
                $arr=json_decode(json_encode($det[$i]),true);
                Ventadetalle::create($arr);
            }
            DB::commit();
        }catch(ModelNotFoundException $e){
            
            DB::rollBack();
            return redirect()->route('venta.index')
            ->with('Fallo','No creado Venta, intente mas tarde');
        }

        //Ventadetalle::
        /*return redirect()->route('venta.index')
            ->with('success','Venta creado');*/
        return redirect('venta/print/'.$venta)
            ->with('success','Venta creado');

    }
    public function print($id){
        $Venta=Venta::find($id);
        /*select * from  venta v inner join ventadetalle vd
            on v.id_venta=vd.id_venta
            inner join producto p on p.id_producto=vd.id_producto*/
        return view('venta.print',compact('Venta'));
    }
    public function edit(/*Venta $Venta*/  $id){
        $Venta=Venta::find($id);
        return view('venta.edit',compact('Venta'));
    }
    public function update(Request $req,$id ){
        $Venta= Venta::find($id);
        $req->validate($this->validar);
        $Venta->update($req->all());
        return redirect()->route('venta.index')
            ->with('success','Venta actualizado');
    }
    public function destroy($id){
        $Venta=Venta::find($id);
        $Venta->estado=0;
        $Venta->update(['estado'=>'0']);
        return redirect()->route('venta.index')
        ->with('success','Venta eliminado');
    }
}
