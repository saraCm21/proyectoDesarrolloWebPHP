<?php
namespace Src\Models\Services;
require_once __DIR__ . '/../../../bootstrap.php';

use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Container\Container;
use Src\Models\Entities\Usuario;
use Src\Models\Repositories\UsuarioRepository;

class SignUpService
{
    public function validateAndRegisterUser(Usuario $user)
    {
    
        $validatorFactory = Container::getInstance()->make(ValidatorFactory::class);

        $validator = $validatorFactory->make(
            [
                'username' => $user->username,
                'password' => $user->password,
                'nombre'   => $user->nombre,
                'email'    => $user->email,
                'rol'      => $user->rol,
            ],
            [
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'nombre'   => 'required|string|max:255',
                'email'    => 'required|string|email|max:255',
                'rol'      => 'required|string|max:255',
                // recordar mejorara las validaciones para verificar que el rol sea valido, la contraseña sea 
                //valida, el email sea valido y el unique, etc.
                // mandar el error de que el usuario ya existe, el email ya existe, etc.
                // mandar error de que la contraseña no tiene 8 caractares
            ]
        );

        $repoUser = new UsuarioRepository();
        $resp = $repoUser->createUser($user);

        if ($resp) {
            return true;
        }else {
            return false;
        }

    }
}
