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
            ]
        );

        if ($validator->fails()) {
            return [
                'status' => 422,
                'errors' => $validator->errors(),
            ];
        }

        $repoUser = new UsuarioRepository();
        $repoUser->createUser($user);

        return [
            'status' => 200,
            'message' => 'User registered successfully',
        ];
    }
}
