<?php

require_once 'vendor/autoload.php';
require_once 'config/database.php';

use Src\Models\Entities\Usuario;

$usuario = new Usuario("1", "sara12", "sara1234", "sara", "sasa@g", "vendedor");
$usuario->mostrarInfo();