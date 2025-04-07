<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';

use Src\Models\Entities\Usuario;
use Src\Models\Repositories\UsuarioRepository;

$repoUser = new UsuarioRepository();
$usuario = new Usuario([
    'codigo_usuario' => 'user24',
    'username' => 'lina',
    'password' => 'lina1234',
    'nombre' => 'lina',
    'email' => 'lina@g',
    'rol' => 'vendedor'
]);

$repoUser->createUser($usuario);
$data = [
    'username' => 'lili',
    'nombre' => 'lilian1',
    'email' => 'lilin1@g',
    'password' => 'lilian2114'
];
$repoUser->updateUser('user23', $data);


echo $repoUser->getUserByCod('user23');
echo "<br>";
echo $repoUser->getUserByUsername('sarilu');


$repoUser->deleteUserName('lina');

?>