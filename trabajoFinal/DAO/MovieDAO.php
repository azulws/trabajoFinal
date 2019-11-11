<?php namespace DAO;
use Models\Movie as Movie;
use DAO\GenreDBDAO as GenreDBDAO;

class MovieDAO{
  private $movieList;
  private $genreDBDAO;

  public function __construct(){
    $this->genreDBDAO = new GenreDBDAO();
  }

  private function getNowPlayingPage($pageNumber){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.themoviedb.org/3/movie/now_playing?page=".$pageNumber."&language=en-US&api_key=".API_KEY,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS => "{}",
      CURLOPT_SSL_VERIFYPEER => false,
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    if ($err)
      echo "cURL Error #:" . $err;
    else
      return json_decode($response);
    
  }

  private function getDetails($idMovie){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$idMovie."?language=en-US&api_key=".API_KEY,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS => "{}",
      CURLOPT_SSL_VERIFYPEER => false,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      return json_decode($response);
    }
  }

  public function getMovieById($id){
    $response = $this->getDetails($id);
    $movie = new Movie(); 
    $movie->setTitle($response->title);
    $movie->setReleaseDate($response->release_date);
    $movie->setPoints($response->vote_average);
    $movie->setDescription($response->overview);
    $movie->setPoster($response->poster_path);
    $movie->setId($response->id);
    foreach($response as $key=>$value){
        if($key=="runtime"){
            $movie->setRuntime($value);
            if($value==null){
                $movie->setRuntime(120);
            }
        }
    }
    $genres_array=array();
    $responseGenreArray = $response->genres;
    foreach($responseGenreArray as $genre){
      $new = $this->genreDBDAO->read($genre->id);
      array_push($genres_array,$new);
    } 
    $movie->setGenres($genres_array);
    return $movie;
  }

  public function getMoviesByPage($page){
    $movieList = array();
    $responseArrayNP= $this->getNowPlayingPage($page);
    foreach($responseArrayNP as $key=>$value){ //entro al array, las key son los campos del json, incluyendo el array
      if($key=="results"){ //actuo si el valor de la key es el campo del json llamado results(el arreglo de movie)
        foreach($value as $k=>$v){ //value es el array de movie
          //k es la posicion dentro del arreglo, cada posicion contiene una movie
          //v es la informacion de la movie
          $movie=new Movie();
          $movie->setTitle($v->title);
          $movie->setReleaseDate($v->release_date);
          $movie->setPoints($v->vote_average);
          $movie->setDescription($v->overview);
          $movie->setPoster($v->poster_path);
          $movie->setId($v->id);
          //$responseArrayD= $this->getDetails($v->id);
          /*foreach($responseArrayD as $key=>$value){
            if($key=="runtime"){
                $movie->setRuntime($value);
                if($value==null){
                   $movie->setRuntime(120);
                }
            }
          }*/
          $genres_array=array();
          $responseGenreArray = $v->genre_ids;
          foreach($responseGenreArray as $genre){
            $new = $this->genreDBDAO->read($genre);
            array_push($genres_array,$new);
          }
          $movie->setGenres($genres_array);
          array_push($movieList, $movie);
        }
      }
    }
    return $movieList;
  }
}