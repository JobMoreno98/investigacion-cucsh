<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodologias extends Model
{
    use HasFactory;
    protected $fillable = [
        'metodologia',
        'objetivos',
        'hipotesis',
        'criterios_eticos',
        'referencias',
        'proyecto_id',
        'anexos'
    ];
}
