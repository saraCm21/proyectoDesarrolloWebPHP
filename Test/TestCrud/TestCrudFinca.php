<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';

use Src\Models\Entities\Finca;
use Src\Models\Repositories\FincaRepository;

// Crear una nueva finca
$repoFinca = new FincaRepository();

$finca = new Finca([
    'codigo_finca' => 'finca1',
    'nombre' => 'la principal',
    'numHectareas' => '2',
    'metrosCuadrados' => '300',
    'propietario_id' => '16',
    'capataz_id' => '3',
    'vendedor_id' => '2',
    'pais' => 'Colombia',
    'departamento' => 'Cundinamarca',
    'ciudad' => 'Bogota',
    'siProduceLeche' => '1',
    'siProduceCereales' => '1',
    'siProduceFrutas' => '1',
    'siProduceVerduras' => '1'
]);
$repoFinca->createFinca($finca);


$data = [
    'nombre' => 'la principal actualizada',
    'capataz_id' => '11',
    'vendedor_id' => '3'
];

echo $repoFinca->updateFinca('finca1', $data);   


echo $repoFinca->getFincaCod('finca1');
echo $repoFinca->getFincaName('la principal actualizada');
?>