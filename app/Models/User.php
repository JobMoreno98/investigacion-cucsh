<?php

namespace App\Models;

use App\Http\Controllers\DatosGeneralesController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function datos()
    {
        return $this->hasOne(datosGenerales::class);
    }

    public function proyecto()
    {
        return $this->hasOne(proyectos::class);
    }
    public function adminlte_profile_url()
    {
        return route('usuario.edit', $this->id);
    }
    public function adminlte_image()
    {
        if (isset($this->foto) && strcmp('', $this->foto) != 0) {
            return asset('storage/fotos_perfil/' . $this->foto);
        }
        return asset('images/user-logo.png');
    }
    public function adminlte_desc()
    {
        return strtoupper($this->getRoleNames()[    0]);
    }
}
