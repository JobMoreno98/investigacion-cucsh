<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciclos extends Model
{
    use HasFactory;
    protected $fillable = ['anio','fecha_inicio','fecha_fin'];

    public function proyecto() {
        return $this->hasOne(proyectos::class);
    }
}
