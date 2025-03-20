<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['titulo', 'detalles', 'estado', 'prioridad'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class)->withPivot('usuarios_tareas');
    }
}
