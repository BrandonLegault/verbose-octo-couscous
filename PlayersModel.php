<?php

class PlayersModel {

    private $playersArray;

    private $playerJsonString;

    // could I use a php equivalent of Lombok (Java) to automate this boilerplate?
    public function __construct() {
        //We're only using this if we're storing players as an array.
        $this->playersArray = [];

        //We'll only use this one if we're storing players as a JSON string
        $this->playerJsonString = null;
    }

    public function getPlayersArray() {
        return $playersArray;
    }

    public function setPlayersArray($array) {
        $playersArray = $array;
    }

    public function getPlayersJsonString() {
        return $playerJsonString;
    }

    public function setPlayersJsonString($string) {
        return $playerJsonString;
    }
    
}

?>