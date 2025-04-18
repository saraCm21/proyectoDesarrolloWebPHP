<?php

require_once __DIR__ . '/../Src/Models/Services/CreateFincaService.php';
use Src\Models\Entities\Finca;
use Src\Models\Entities\Usuario;


session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'] ?? '';
    $numHectaras = $_POST['numHectaras'] ?? 0;
    $metrosCuadrados = $_POST['metrosCuadrados'] ?? 0;
    $propietario_codigo= $_POST['codigo_propietario'] ?? null;
    $capataz_codigo = $_POST['codigo_capataz'] ?? null;
    $vendedor_codigo = $_POST['codigo_vendedor'] ?? null;
    $pais = $_POST['pais'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    
    $siProduceLeche = isset($_POST['siProduceLeche']) ? (int)$_POST['siProduceLeche'] : 0;
    $siProduceCereales = isset($_POST['siProduceCereales']) ? (int)$_POST['siProduceCereales'] : 0;
    $siProduceFrutas = isset($_POST['siProduceFrutas']) ? (int)$_POST['siProduceFrutas'] : 0;
    $siProduceVerduras = isset($_POST['siProduceVerduras']) ? (int)$_POST['siProduceVerduras'] : 0;
    
    // agregar la alerta en el html
    if (empty($nombre) || empty($pais) || empty($departamento) || empty($ciudad)) {
        header("Location: ../Views/principalFrame/crearFincaFrame.html?error=empty_fields");
        exit;
    }

    $propietario = Usuario::where('codigo_usuario', $propietario_codigo)->first();
    $capataz = Usuario::where('codigo_usuario', $capataz_codigo)->first();
    $vendedor = Usuario::where('codigo_usuario', $vendedor_codigo)->first();
    $propietario_id = $propietario->id_usuario;
    $capataz_id = $capataz->id_usuario;
    $vendedor_id = $vendedor->id_usuario;

    $finca = new Finca([
        'codigo_finca' => random_int(100000, 999999),
        'nombre' => $nombre,
        'numHectareas' => $numHectaras,
        'metrosCuadrados' => $metrosCuadrados,
        'propietario_id' => $propietario_id,
        'capataz_id' => $capataz_id,
        'vendedor_id' => $vendedor_id,
        'pais' => $pais,
        'departamento' => $departamento,
        'ciudad' => $ciudad,
        'siProduceLeche' => $siProduceLeche,
        'siProduceCereales' => $siProduceCereales,
        'siProduceFrutas' => $siProduceFrutas,
        'siProduceVerduras' => $siProduceVerduras
    ]);

    
    $createFincaService = new CreateFincaService();
    $createFincaService->create($finca);

    if ($createFincaService) {
        header("Location: ../Views/principalFrames/registerFinca.html?success");
        exit;
    } else {
        header("Location: ../Views/principalFrame/crearFincaFrame.html?error=error_crear_finca");
        exit;
    }


}