<?php

namespace Src\Models\Repositories;
use Src\Models\Entities\Finca; 
use Illuminate\Database\Eloquent\Model;

class FincaRepository
{
    public function createFinca(Finca $finca) {
        $finca->save();
        return $finca;
    }

    public function deleteFincaCod($codigo_finca) {
        $finca = Finca::where('codigo_finca', $codigo_finca)->first();
        if ($finca) {
            $finca->delete();
            return true;
        }
        return false;
    }

    public function updateFinca($codigoFinca, array $data)
    {
        $finca = Finca::where('codigo_finca', $codigoFinca)->first();
    
        if (!$finca) {
            throw new \Exception("Finca no encontrada con código: $codigoFinca");
        }
    
        if (isset($data['nombre'])) {
            $finca->nombre = $data['nombre'];
        }
    
        if (isset($data['propietario_id'])) {
            $finca->propietario_id = $data['propietario_id'];
        }

        if (isset($data['capataz_id'])) {
            $finca->capataz_id = $data['capataz_id'];
        }
    
        if (isset($data['vendedor_id'])) {
            $finca->vendedor_id = $data['vendedor_id'];
        }

        if (isset($data['siProduceLeche'])) {
            $finca->siProduceLeche = $data['siProduceLeche'];
        }

        if (isset($data['siProduceCereales'])) {
            $finca->siProduceCereales = $data['siProduceCereales'];
        }

        if (isset($data['siProduceFrutas'])) {
            $finca->siProduceFrutas = $data['siProduceFrutas'];
        }

        if (isset($data['siProduceVerduras'])) {
            $finca->siProduceVerduras = $data['siProduceVerduras'];
        }

        $finca->save();
    
        return $finca;
    }

    public function getFincaCod($codigo_finca) {
        $finca = Finca::where('codigo_finca', $codigo_finca)->first();
        return $finca;
    }

    public function getFincaName($nombre) {
        $finca = Finca::where('nombre', $nombre)->first();
        return $finca;
    }

    public function getFincaAll() {
        $fincas = Finca::all();
        return $fincas; 
    }




}