<?php

namespace Src\Models\Services;
require_once __DIR__ . '/../../../bootstrap.php';
use Src\Models\Entities\Usuario;
use Src\Models\Repositories\UsuarioRepository;
use Carbon\Carbon;

Class SendEmail
{
    public function sendEmail($email)
    {
       
        $usuario = Usuario::where('email', $email)->first();

        if (!$usuario) {
            return false;
            //return ['status' => 404, 'message' => 'Usuario no encontrado'];
            //return "error de envio " . $usuario->email;
        }else {
            $codigo = random_int(100000, 999999);
            $usuario->cod_recuperacion = $codigo;
            $usuario->time_limit = Carbon::now()->addMinutes(15);
            $usuario->save();

            mail(
                $usuario->email,
                "Código de recuperación",
                "Tu código de recuperación es: $codigo. Tiene validez de 15 minutos."
            );
            return true;
            //return ['status' => 200, 'message' => 'Código enviado correctamente'];
            //return "codigo de recuperación enviado a " . $usuario->email;

        }
        
    }
}