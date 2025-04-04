<?php

namespace Src\Models\Entities;

use Illuminate\Database\Eloquent\Model; 

class finca extends Model{

    private $id;
    private $cod_finca;
    private $nombre_finca;
    private $numHectareas;
    private $metrosCuadrados;
    private $propietario_id;
    private $capataz_id;
    private $vededor_id;
    private $pais;
    private $departamento;
    private $ciudad;
    private $siProduceLeche;
    private $siProduceCereales;
    private $siProduceFrutas;
    private $siProduceVerduras;

    public function __construct($cod_finca, $nombre_finca, $numHectareas, $metrosCuadrados, $propietario_id, $capataz_id, $vededor_id, $pais, $departamento, $ciudad, $siProduceLeche, $siProduceCereales, $siProduceFrutas, $siProduceVerduras){
        $this->cod_finca = $cod_finca;
        $this->nombre_finca = $nombre_finca;
        $this->numHectareas = $numHectareas;
        $this->metrosCuadrados = $metrosCuadrados;          
        $this->propietario_id = $propietario_id;
        $this->capataz_id = $capataz_id;
        $this->vededor_id = $vededor_id;
        $this->pais = $pais;
        $this->departamento = $departamento;
        $this->ciudad = $ciudad;
        $this->siProduceLeche = $siProduceLeche;
        $this->siProduceCereales = $siProduceCereales;
        $this->siProduceFrutas = $siProduceFrutas;
        $this->siProduceVerduras = $siProduceVerduras;
    }


    public function getId(){
        return $this->id;
    }
    public function getCodFinca(){
        return $this->cod_finca;
    }
    public function setCodFinca($cod_finca){
        $this->cod_finca = $cod_finca;
    }

    public function getNombreFinca(){
        return $this->nombre_finca;
    }
    public function setNombreFinca($nombre_finca){
        $this->nombre_finca = $nombre_finca;
    }   

    public function getNumHectareas(){
        return $this->numHectareas;
    }
    public function setNumHectareas($numHectareas){
        $this->numHectareas = $numHectareas;
    }

    public function getMetrosCuadrados(){
        return $this->metrosCuadrados;
    }
    public function setMetrosCuadrados($metrosCuadrados){
        $this->metrosCuadrados = $metrosCuadrados;
    }

    public function getPropietarioId(){
        return $this->propietario_id;
    }
    public function setPropietarioId($propietario_id){
        $this->propietario_id = $propietario_id;
    }

    public function getCapatazId(){
        return $this->capataz_id;
    }
    public function setCapatazId($capataz_id){
        $this->capataz_id = $capataz_id;
    }

    public function getVededorId(){
        return $this->vededor_id;
    }
    public function setVededorId($vededor_id){
        $this->vededor_id = $vededor_id;
    }

    public function getPais(){
        return $this->pais;
    }
    public function setPais($pais){
        $this->pais = $pais;
    }

    public function getDepartamento(){
        return $this->departamento;
    }
    public function setDepartamento($departamento){
        $this->departamento = $departamento;
    }

    public function getCiudad(){
        return $this->ciudad;
    }
    public function setCiudad($ciudad){
        $this->ciudad = $ciudad;
    }

    public function getSiProduceLeche(){
        return $this->siProduceLeche;
    }
    public function setSiProduceLeche($siProduceLeche){
        $this->siProduceLeche = $siProduceLeche;
    }

    public function getSiProduceCereales(){
        return $this->siProduceCereales;
    }
    public function setSiProduceCereales($siProduceCereales){
        $this->siProduceCereales = $siProduceCereales;
    }

    public function getSiProduceFrutas(){
        return $this->siProduceFrutas;
    }
    public function setSiProduceFrutas($siProduceFrutas){
        $this->siProduceFrutas = $siProduceFrutas;
    }
    
    public function getSiProduceVerduras(){
        return $this->siProduceVerduras;
    }
    public function setSiProduceVerduras($siProduceVerduras){
        $this->siProduceVerduras = $siProduceVerduras;
    }
  

}




