<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['titulo', 'detalles', 'estado', 'prioridad'];

    protected $with = ['usuarios'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuarios_tareas', 'tarea_id', 'user_id')->withPivot('estado');
    }
}
