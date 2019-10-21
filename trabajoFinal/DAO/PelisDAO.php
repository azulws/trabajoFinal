<?php namespace DAO;
use Models\Pelicula as Pelicula;
class PelisDAO{
  private $peliculaList = array();

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


  public function getPeliculas($pageNumber){
    $responseArray= $this->getNowPlayingPage($pageNumber);
    foreach($responseArray as $key=>$value){ //entro al array, las key son los campos del json, incluyendo el array
      if($key=="page"){
      echo 'Pagina: '.$value;
    }
    if($key=="results"){ //actuo si el valor de la key es el campo del json llamado results(el arreglo de pelis)
      foreach($value as $k=>$v){ //value es el array de pelicula
        //k es la posicion dentro del arreglo, cada posicion contiene una pelicula
        //v es la informacion de la pelicula
        $pelicula=new Pelicula();
        $pelicula->setTitulo($v->title);
        $pelicula->setFechaEstreno($v->release_date);
        $pelicula->setPuntuacion($v->vote_average);
        $pelicula->setDescripcion($v->overview);
        $pelicula->setPoster($v->poster_path);
        array_push($this->peliculaList, $pelicula);
        //var_dump($pelicula);//veo los datos que hay guardados dentro de cada pelicula
      }
    }
  }
    return $this->peliculaList;
  }

}