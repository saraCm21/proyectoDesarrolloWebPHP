<?php

namespace Src\Models\Repositories;
use Src\Models\Entities\Usuario; 
use Illuminate\Database\Eloquent\Model;


class UsuarioRepository extends Model
{
    
    public function createUser(Usuario $usuario) {
        
        $usuario->password = password_hash($usuario->getPassword(), PASSWORD_BCRYPT);
        $usuario->save();
        return $usuario;
    }

    public function deleteUserCod($cod_usuario) {
        $usuario = Usuario::where('cod_usuario', $cod_usuario)->first();
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

    public function updateUser($cod_usuario, $data) {
        $usuario = Usuario::where('cod_usuario',$cod_usuario);
        if ($usuario) {
            if (isset($data['username'])) {
                $usuario->setUsername($data['username']);
            }
            if (isset($data['nombre'])) {
                $usuario->setNombre($data['nombre']);
            }
            if (isset($data['email'])) {
                $usuario->setEmail($data['email']);
            }
            if (isset($data['password'])) {
                $usuario->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
            }
    
            $usuario->save();
            return $usuario;
        }
        return null;
    }


    public function getUserByCod($cod_usuario) {
        return Usuario::where('cod_usuario', $cod_usuario)->first();
    }

    public function getUserByUsername($username) {
        return Usuario::where('username', $username)->first();
    }

    public function getUserByName ($nombre) {
        return Usuario::where('nombre', $nombre)->first();
    }

    public function getAllUsers() {
        return Usuario::all();
    }

}

