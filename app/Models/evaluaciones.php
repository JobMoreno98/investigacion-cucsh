<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class evaluaciones extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'evaluador_id', 'proyectos_id', 'ciclo_id'];

    public function proyecto()
    {
        return $this->hasOne(proyectos::class, 'evaluacion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evaluador()
    {
        return $this->belongsTo(User::class);
    }

    public function ciclo()
    {
        return $this->belongsTo(ciclo::class);
    }
}
