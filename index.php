<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';

use Src\Models\Entities\Usuario;
use Src\Models\Repositories\UsuarioRepository;
use Src\Models\Services\SignUpService;
use Src\Models\Services\LoginService;
use Src\Models\Services\SendEmail;
use Src\Models\Services\ChangePassword;
use Src\Models\Services\SearchFinca;

/*

$usuario = new Usuario([
    'codigo_usuario' => random_int(100000, 999999),
    'username' => 'carol',
    'password' => 'caro1234',
    'nombre' => 'Caroli',
    'email' => 'carol@gmail.com',
    'rol' => 'vendedor'
]);

$signUpUser = new SignUpService();
$signUpUser->validateAndRegisterUser($usuario);
if (is_array($signUpUser)) {
    echo 'Status: ' . $signUpUser['status'] . '<br>';
    echo 'Message: ' . $signUpUser['message'];
}


$loginService = new LoginService();
echo $loginService->login('carolina@gmail.com', 'caro1234');


$serndEmail = new SendEmail();
echo $serndEmail->sendEmail('sasacm0610@gmail.com');


$changePas = new ChangePassword();
echo $changePas->changePassword('599064', 'sari123', 'sasacm0610@gmail.com');


$propietario = Usuario::where('codigo_usuario', 889180)->first();
$capataz = Usuario::where('codigo_usuario', "SaraC")->first();
$vendedor = Usuario::where('codigo_usuario', 960117)->first();
$propietario_id = $propietario->id_usuario;
$capataz_id = $capataz->id_usuario;
$vendedor_id = $vendedor->id_usuario;

echo $propietario_id . '<br>';
echo $capataz_id . '<br>';
echo $vendedor_id . '<br>';
*/

$buscar = new SearchFinca();
$finca = $buscar->searchFinca('173716');
echo $finca;


?>