<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $fillable = ['nombre','precio','cant','estado'];
    protected $primaryKey = 'id_producto';
    public function detalles(){
        return $this->hasMany(Ventadetalle::class,'id_producto');
    }
}
