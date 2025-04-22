<?php

namespace Src\Models\Services;

use Illuminate\Database\Capsule\Manager as DB;
use Src\Models\Repositories\FincaRepository;

class SearchFinca{

    public function searchFinca($codigo_nombre) {

        $repoFinca = new FincaRepository;
        if ($finca = $repoFinca->getFincaCod($codigo_nombre)){
            return $finca;
        }else if ($finca = $repoFinca->getFincaName($codigo_nombre)){
            return $finca;
        }else{
            return null;
        }


    }


}