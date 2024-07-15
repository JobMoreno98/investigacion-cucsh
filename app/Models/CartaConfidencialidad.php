<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaConfidencialidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'anio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name', 'email');
    }
}
