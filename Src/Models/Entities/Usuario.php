<?php

namespace Src\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model 
{
    protected $table = 'usuarios';
    public $timestamps = false;
    protected $fillable = ['codigo_usuario', 'username', 'password', 'nombre', 'email', 'rol'];
    protected $primaryKey = 'id_usuario';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    
    
}

