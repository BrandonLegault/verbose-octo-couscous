<?php

class PlayersModel {

    private $playersArray;

    // could I use a php equivalent of Lombok (Java) to automate this boilerplate?
    public function __construct() {
        $this->playersArray = [];
    }

    public function getPlayersArray() {
        // should I clone to avoid leaking the reference?
        return $this->playersArray;
    }

    public function setPlayersArray($array) {
        // should I clone to avoid something having access to our array?
        $this->playersArray = $array;
    }

}

?>