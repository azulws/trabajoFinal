<?php namespace Models;
class Pelicula {
    
    private $titulo;
    private $fechaEstreno;
    private $puntuacion;
    private $descripcion;
    private $poster;

    public function __construct(){

    }

    public function setTitulo($titulo){
        $this->titulo = $titulo ;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setFechaEstreno($fechaEstreno){
        $this->fechaEstreno = $fechaEstreno ;
    }

    public function getFechaEstreno(){
        return $this->fechaEstreno ;
    }
    public function setPuntuacion($puntuacion){
        $this->puntuacion = $puntuacion ;
    }

    public function getPuntuacion (){
        return $this->puntuacion ;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion ;
    }

    public function getDescripcion(){
        return $this->descripcion ;
    }
    public function setPoster($poster){
        $this->poster = $poster ;
    }

    public function getPoster(){
        return $this->poster ;
    }

    public function echoToString(){
        return "Titulo: ".$this->getTitulo()
        ." - Estreno: ".$this->getFechaEstreno()
        ."\nPuntuacion: ".$this->getPuntuacion()
        ."\nDescripcion: ".$this->getDescripcion();
    
    }
}
/*
 [popularity] => 695.215 [vote_count] => 1838 [video] => 
 [poster_path] => /udDclJoHjfjb8Ekgsd4FDteOkCU.jpg
 [id] => 475557 
 [adult] =>[backdrop_path] => /n6bUvigpRFqSwmPp1m2YADdbRBc.jpg 
 [original_langua ge] => en 
 [original_title] => Joker
  [genre_ids]  => Array ( [0] => 80 [1] => 18 [2] => 53 )
   [title] =>  Joker 
   [vote_average] => 8.7 
   [overview  ] => During the 1980s, a failed stand-up comedia
 n is driven insane and turns to a life
  of crime and chaos in Gotham City while becoming an infamo
 us psychopathic crime figure. 
 [release_date] => 2019-10-04 )*/