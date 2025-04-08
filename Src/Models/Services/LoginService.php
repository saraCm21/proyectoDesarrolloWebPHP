<?php

namespace Src\Models\Services;
require_once __DIR__ . '/../../../bootstrap.php';
use Src\Models\Entities\Usuario;
use Src\Models\Repositories\UsuarioRepository;

class LoginService
{

    public function login($usernameOrEmail, $password)
    {
        $usuario = Usuario::where('username', $usernameOrEmail)
                ->orWhere('email', $usernameOrEmail)
                ->first();

        if ($usuario && password_verify($password, $usuario->password)) {
                
            return true;
        }

        return false;
        
    }
}