<?php
    namespace DAO;
    use Models\Genre;
    class GenreDAO{
        private $genreList = array();
        public function getMoviesGenres(){
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/genre/movie/list?api_key=".API_KEY."&language=en-US",
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
        
        public function getGenres(){
            $responseArray= $this->getMoviesGenres();
             
            foreach($responseArray as $k){
                
               /* $genre = new Genre();
                $genre->setId($k["id"]);
                $genre->setDescription($k->name);*/
                echo '<pre>';
                print_r($responseArray);
                echo '</pre>';
                //array_push($this->genreList,$genre);
            }
            return $this->genreList;
        }
    }