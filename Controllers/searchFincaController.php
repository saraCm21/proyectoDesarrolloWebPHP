<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

use Src\Models\Services\SearchFinca;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $searchInput = $_POST['search_input'] ?? null;

        if (empty($searchInput)) {
            header('Location: ../Views/principalFrames/homeFrame.php?');
            exit;
        }

        $searchService = new SearchFinca();
        $result = $searchService->searchFinca($searchInput);

        if ($result) {
            $queryParams = http_build_query([
                'codigo_finca' => $result->codigo_finca,
                'nombre' => $result->nombre,
                'pais' => $result->pais,
                'departamento' => $result->departamento,
                'ciudad' => $result->ciudad,
                'metros' => $result->metrosCuadrados,
                'hectareas' => $result->numHectareas,
                'leche' => $result->siProduceLeche,
                'cereales' => $result->siProduceCereales,
                'frutas' => $result->siProduceFrutas,
                'verduras' => $result->siProduceVerduras,
            ]);
            header("Location: ../Views/principalFrames/homeFrame.php?$queryParams");
            exit;
        } else {
            header('Location: ../Views/principalFrames/homeFrame.php?error=finca_not_found');
            exit;
        }
    } catch (Exception $e) {
        header('Location: ../Views/principalFrames/homeFrame.php?error=error_searching_finca');
        exit;
    }
}