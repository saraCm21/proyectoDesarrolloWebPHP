<?php

namespace Src\Models\Entities;

use Illuminate\Database\Eloquent\Model; 

class finca extends Model{

    protected $table = 'finca';
    public $timestamps = false;  
    protected $fillable = ['codigo_finca', 'nombre', 'numHectareas', 'metrosCuadrados', 'propietario_id', 'capataz_id', 'vededor_id', 'pais', 'departamento', 'ciudad', 'siProduceLeche', 'siProduceCereales', 'siProduceFrutas', 'siProduceVerduras'];
   

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
    }



}




