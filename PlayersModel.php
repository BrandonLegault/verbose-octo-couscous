<?php

class PlayersModel {

    private $playersArray;

    // could I use a php equivalent of Lombok (Java) to automate this boilerplate?
    public function __construct() {
        $this->playersArray = [];
    }

    public function getPlayersArray() {
        return $this->playersArray;
    }

    public function setPlayersArray($array = null, $json = null) {
        if($array) {
            // TODO: assert structure
            $this->playersArray = $array;
        } else if($json) {
            // TODO: assert valid json
            $arrayFromJson = json_decode($json);
            $this->playersArray = $arrayFromJson;
        }
        
    }

}

?>