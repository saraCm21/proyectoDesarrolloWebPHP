<?php

namespace Src\Models\Repositories;
use Src\Models\Entities\Usuario; 
use Illuminate\Database\Eloquent\Model;


class UsuarioRepository
{
    
    public function createUser(Usuario $usuario) {
        $usuario->password = password_hash($usuario->password, PASSWORD_BCRYPT);
        $usuario->save();
        return true;
    }

    public function deleteUserCod($codigo_usuario) {
        $usuario = Usuario::where('codigo_usuario', $codigo_usuario)->first();
        if ($usuario) {
            $usuario->delete();
            return true;
        }
        return false;
    }

    public function deleteUserName($username) {
        $usuario = Usuario::where('username', $username)->first();
        if ($usuario) {
            $usuario->delete();
            return true;
        }
        return false;
    }

    public function updateUser($codigo_usuario, $data) {
        $usuario = Usuario::where('codigo_usuario', $codigo_usuario)->first();
    
        if ($usuario) {
            if (isset($data['username'])) {
                $usuario->username = $data['username'];
            }
            if (isset($data['nombre'])) {
                $usuario->nombre = $data['nombre'];
            }
            if (isset($data['email'])) {
                $usuario->email = $data['email'];
            }
            if (isset($data['password'])) {
                $usuario->password = password_hash($data['password'], PASSWORD_BCRYPT);
            }
    
            $usuario->save();
            return $usuario;
        }
    
        return null;
    }


    public function getUserByCod($codigo_usuario) {
        return Usuario::where('codigo_usuario', $codigo_usuario)->first();
    }

    public function getUserByUsername($username) {
        return Usuario::where('username', $username)->first();
    }

    public function getUserByName ($nombre) {
        return Usuario::where('nombre', $nombre)->first();
    }

    public function getUserByEmail($email) {
        return Usuario::where('email', $email)->first();
    }

    public function getAllUsers() {
        return Usuario::all();
    }

}

