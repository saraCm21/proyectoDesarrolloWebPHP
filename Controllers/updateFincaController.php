<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Capsule\Manager as DB;
use Src\Models\Repositories\FincaRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoFinca = $_POST['codigo_finca'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $codigoPropietario = $_POST['codigo_propietario'] ?? null;
    $codigoCapataz = $_POST['codigo_capataz'] ?? null;
    $codigoVendedor = $_POST['codigo_vendedor'] ?? null;
    $siProduceLeche = $_POST['siProduceLeche'] ?? null;
    $siProduceCereales = $_POST['siProduceCereales'] ?? null;
    $siProduceFrutas = $_POST['siProduceFrutas'] ?? null;
    $siProduceVerduras = $_POST['siProduceVerduras'] ?? null;

    if (!$codigoFinca) {
        header("Location: ../Views/principalFrames/homeFrame.php?error=missing_id");
        exit;
    }

    try {
        $propietario = DB::table('usuarios')->where('codigo_usuario', $codigoPropietario)->value('id_usuario');
        $capataz = DB::table('usuarios')->where('codigo_usuario', $codigoCapataz)->value('id_usuario');
        $vendedor = DB::table('usuarios')->where('codigo_usuario', $codigoVendedor)->value('id_usuario');

        if (!$propietario || !$capataz || !$vendedor) {
            header("Location: ../Views/principalFrames/homeFrame.php?error=user_not_found");
            exit;
        }

        $data = [
            'nombre' => $nombre,
            'propietario_id' => $propietario,
            'capataz_id' => $capataz,
            'vendedor_id' => $vendedor,
            'siProduceLeche' => $siProduceLeche,
            'siProduceCereales' => $siProduceCereales,
            'siProduceFrutas' => $siProduceFrutas,
            'siProduceVerduras' => $siProduceVerduras
        ];

        $repoFinca = new FincaRepository;
        $updated = $repoFinca->updateFinca($codigoFinca, $data);

        if ($updated) {
            header("Location: ../Views/principalFrames/homeFrame.php");
            exit;
        }
        
        exit;
    } catch (Exception $e) {
        header("Location: ../Views/principalFrames/homeFrame.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}