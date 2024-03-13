<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    use HasFactory;

    public function proyecto() {
        return $this->hasOne(proyectos::class);
    }
    
}
