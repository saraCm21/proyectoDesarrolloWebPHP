<?php

namespace Src\Models\Services;
require_once __DIR__ . '/../../../bootstrap.php';
use Src\Models\Entities\Usuario;
use Src\Models\Repositories\UsuarioRepository;
use Carbon\Carbon;

Class ChangePassword
{
    public function changePassword($code, $password, $email)
    {
        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario) {
            return false;
        }

        $limit = Carbon::parse($usuario->time_limit);

        if (trim($usuario->cod_recuperacion) === trim($code) && Carbon::now()->lessThanOrEqualTo($limit)) {
            $usuario->password = password_hash($password, PASSWORD_DEFAULT);
            $usuario->save();
            return true;
        }
        
    }
}

//