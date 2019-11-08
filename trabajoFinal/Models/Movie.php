<?php namespace Models;
class Movie {
    
    private $title;
    private $releaseDate;
    private $points;
    private $description;
    private $poster;
    private $movieId;
    private $runtime;
    private $genres;

    public function __construct($genres=array()){

    }

    public function setTitle($title){
        $this->title = $title ;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setReleaseDate($releaseDate){
        $this->releaseDate = $releaseDate ;
    }

    public function getReleaseDate(){
        return $this->releaseDate ;
    }
    public function setPoints($points){
        $this->points = $points ;
    }

    public function getPoints (){
        return $this->points ;
    }
    public function setDescription($description){
        $this->description = $description ;
    }

    public function getDescription(){
        return $this->description ;
    }
    public function setPoster($poster){
        $this->poster = $poster ;
    }

    public function getPoster(){
        return $this->poster;
    }

    public function setMovieId($movieId){
        $this->movieId = $movieId;
    }

    public function getMovieId(){
        return $this->movieId;
    }

    public function setRuntime($runtime){
        $this->runtime = $runtime;
    }

    public function getRuntime(){
        return $this->runtime;
    }

    public function setGenres($genres){
        $this->genres = $genres;
    }

    public function getGenres(){
        return $this->genres;
    }

    public function echoToString(){
        return "Title: ".$this->getTitle()
        ." - Estreno: ".$this->getReleaseDate()
        ."\nPoints: ".$this->getPoints()
        ."\nDescription: ".$this->getDescription();
    
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