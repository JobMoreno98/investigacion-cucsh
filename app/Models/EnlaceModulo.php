<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Modulos;

class EnlaceModulo extends Model
{
    use HasFactory;
    protected $fillable = ['enlace','permiso', 'modulo_id', 'titulo', 'estilo', 'parametro'];

    public function modulos(): BelongsTo
    {
        return $this->belongsTo(Modulos::class,'modulo_id');
    }
    
}
