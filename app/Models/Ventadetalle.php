<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventadetalle extends Model
{
    use HasFactory;
    protected $table = 'ventadetalle';
    protected $fillable = ['id_venta','id_producto','precio','cant'];
    protected $primaryKey = 'id_ventadetalle';
    public function venta(){
        return $this->belongsTo(Venta::class,'id_venta');
    }
    public function producto(){
        return $this->belongsTo(Producto::class,'id_producto');
    }
}
