<?php

namespace Src\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model 
{
    private $id;
    private $cod_usuario;
    private $username;
    private $password;
    private $nombre;
    private $email;
    private $rol;


    public function __construct($cod_usuario, $username, $password, $nombre, $email, $rol) {
        $this->cod_usuario = $cod_usuario;
        $this->username = $username;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->rol = $rol;
    }

    public function getId() {
        return $this->id;
    }

    public function getCodUsuario() {
        return $this->cod_usuario;
    }   

    public function setCodUsuario($cod_usuario) {
        $this->cod_usuario = $cod_usuario;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }


    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    
}

