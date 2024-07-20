<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modulos extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','permiso','color','icono','orden'];
    public function enlaces(): HasMany
    {
        return $this->hasMany(EnlaceModulo::class, 'modulo_id', 'id');
    }
}
