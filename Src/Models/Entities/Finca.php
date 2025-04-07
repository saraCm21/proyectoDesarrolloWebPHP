<?php

namespace Src\Models\Entities;

use Illuminate\Database\Eloquent\Model; 

class finca extends Model{

    protected $table = 'fincas';
    public $timestamps = false;  
    protected $primaryKey = 'id_finca';
    protected $fillable = ['codigo_finca', 'nombre', 'numHectareas', 'metrosCuadrados', 'propietario_id', 'capataz_id', 'vendedor_id', 'pais', 'departamento', 'ciudad', 'siProduceLeche', 'siProduceCereales', 'siProduceFrutas', 'siProduceVerduras'];
   

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
    }



}




