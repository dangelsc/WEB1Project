<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorial extends Model
{
    use HasFactory;
    protected $table = 'categoria';
    protected $fillable = ['nombre','estado','id_categoria'];
    protected $primaryKey = 'id_categoria';

}
