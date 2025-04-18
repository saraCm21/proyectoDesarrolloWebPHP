<?php

require_once __DIR__ . '/../../../bootstrap.php';

use Illuminate\Database\Capsule\Manager as DB;
use Src\Models\Entities\Finca;  
use Src\Models\Repositories\FincaRepository;

class CreateFincaService
{

    public function create(Finca $finca)
    {

        $repoFinca = new FincaRepository();
        $resp = $repoFinca->createFinca($finca);

        if ($resp) {
            return true;
        }else {
            return false;
        }

    }
   
}