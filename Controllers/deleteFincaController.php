<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Capsule\Manager as DB;
use Src\Models\Repositories\FincaRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoFinca = $_POST['codigo_finca'] ?? null;

    if ($codigoFinca) {
        try {
            $repoFinca = new FincaRepository;
            $deleted = $repoFinca->deleteFincaCod($codigoFinca);

            if ($deleted) {
                header("Location: ../Views/principalFrames/homeFrame.php?success=deleted");
                exit;
            } else {
                header("Location: ../Views/principalFrames/homeFrame.php?error=not_found");
                exit;
            }
        } catch (Exception $e) {
            header("Location: ../Views/principalFrames/homeFrame.php?error=" . urlencode($e->getMessage()));
            exit;
        }
    } else {
        header("Location: ../Views/principalFrames/homeFrame.php?error=missing_id");
        exit;
    }
}


