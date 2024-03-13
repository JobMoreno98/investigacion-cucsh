<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyectos extends Model
{
    use HasFactory;
    protected $appends = ['folio', 'total','datosInv','dictamen'];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function evaluador() {
        return $this->belongsTo(User::class);
    }

    public function ciclo() {
        return $this->belongsTo(ciclos::class);
    }

    public function recursos() {
        return $this->belongsTo(Recursos::class);
    }

 public function evaluacion() {
        return $this->belongsTo(evaluaciones::class);
    }
    
 public function getFolioAttribute(){
        return $this->ciclo->anio . '/' . $this->id;
    }

    public function getTotalAttribute()
    {
        $total = 0;
        if(isset($this->recursos)){
            for ($i = 0; $i < 11; $i++) {
                $numero = 'p_0' . strval($i + 1);
                $total = $total + $this->recursos->$numero;
            }
        }
        
        return $total;
    }

    public function getDatosInvAttribute()
    {
        if(isset($this->user->datos)){
            return $this->user->datos;
        }else{
            return "";
        }       
    }

   public function getDictamenAttribute()
    {
        if(isset($this->evaluacion->dictamen)){
            return $this->evaluacion->dictamen;
        }else{
            return "";
        }       
    }

}
