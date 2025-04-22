<?php
// filepath: d:\Documentos D\act1_sara_castellano_desarrollo_web_2025-1\Controllers\reportFincaController.php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Capsule\Manager as DB;

header('Content-Type: application/json');

try {
    // Consulta para obtener la cantidad de fincas por tipo de producción
    $produccion = DB::table('fincas')
        ->selectRaw("
            SUM(siProduceLeche) as leche,
            SUM(siProduceCereales) as cereales,
            SUM(siProduceFrutas) as frutas,
            SUM(siProduceVerduras) as verduras
        ")
        ->first();

    // Consulta para obtener la cantidad de fincas por ciudad
    $ciudades = DB::table('fincas')
        ->select('ciudad', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('ciudad')
        ->get();

    // Formatear los datos para enviarlos al frontend
    $response = [
        'produccion' => [
            'labels' => ['Leche', 'Cereales', 'Frutas', 'Verduras'],
            'data' => [
                $produccion->leche ?? 0,
                $produccion->cereales ?? 0,
                $produccion->frutas ?? 0,
                $produccion->verduras ?? 0,
            ]
        ],
        'ciudades' => [
            'labels' => $ciudades->pluck('ciudad'),
            'data' => $ciudades->pluck('cantidad')
        ]
    ];

    echo json_encode($response);
} catch (Exception $e) {
    // Manejo de errores
    echo json_encode([
        'error' => 'Ocurrió un error al obtener los datos: ' . $e->getMessage()
    ]);
}