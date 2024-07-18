<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnlaceModulo extends Model
{
    use HasFactory;
    protected $fillable = ['enlace', 'modulo_id', 'titulo', 'estilo', 'parametro'];
    
}
