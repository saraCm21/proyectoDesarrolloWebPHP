<?php

require_once __DIR__ . '/vendor/autoload.php';

use Src\Models\Entities\Usuario;
use Src\Models\Repositories\UsuarioRepository;
use Src\Models\Services\SignUpService;
use Src\Models\Services\LoginService;
use Src\Models\Services\SendEmail;
use Src\Models\Services\ChangePassword;

/*
$usuario = new Usuario([
    'codigo_usuario' => 'Carolina1234',
    'username' => 'carolix',
    'password' => 'caro1234',
    'nombre' => 'Carolina',
    'email' => 'carolina@gmail.com',
    'rol' => 'vendedor'
]);

$signUpUser = new SignUpService();
echo $signUpUser->validateAndRegisterUser($usuario);


$loginService = new LoginService();
echo $loginService->login('carolina@gmail.com', 'caro1234');


$serndEmail = new SendEmail();
echo $serndEmail->sendEmail('sasacm0610@gmail.com');
*/

$changePas = new ChangePassword();
echo $changePas->changePassword('599064', 'sari123', 'sasacm0610@gmail.com');


?>