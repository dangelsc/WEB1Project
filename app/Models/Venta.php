<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $fillable = ['id_venta','nombre','fecha','estado'];
    protected $primaryKey = 'id_venta';
    public function detalles(){
        return $this->hasMany(Ventadetalle::class,'id_venta');
    }
}
