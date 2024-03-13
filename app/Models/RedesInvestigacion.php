<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedesInvestigacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'nivel',
        'proyecto_id',
    ];
}
