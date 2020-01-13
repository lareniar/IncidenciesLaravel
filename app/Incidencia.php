<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $fillable = [
        'description', 'classroom', 'equipment_name', 'estado'
    ];

}
