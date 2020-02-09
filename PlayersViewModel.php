<?php

include './PlayersModel.php';
include './PlayersView.php';
include './Reader.php';

class PlayersViewModel {

    private $isCLI;

    private $playersModel;

    private $playersView;

    public function __construct($isCLI = null, $source = null, $filename = null, $model = null, $view = null) {
        $this->isCLI = $isCLI;

        if(!$model) {
            $model = new PlayersModel;
        }
        if(!$view) {
            $view = new PlayersView;
        }

        $this->playersModel = $model;
        $this->playersView = $view;

        if($source) {
            $this->setPlayerData($source, $filename);
        }
    }

    public function setPlayerData($source, $filename = null) {
        $players = $this->readPlayers($source, $filename);
        $this->playersModel->setPlayersArray($players);
    }

    public function displayView($isCLI = null) {
        if($isCLI == null) {
            $isCLI = $this->isCLI;
        }
        $this->playersView->display($isCLI, $this->playersModel->getPlayersArray());
    }

    // this seems out of place; maybe I should make a writer class
    public function savePlayersDataToFile($filename) {
        file_put_contents($filename, json_encode($this->playersModel->getPlayersArray()));
    }

    /**
     * @param $source string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $filename string Only used if we're reading players in 'file' mode.
     * @return string json
     */
    private function readPlayers($source, $filename = null) {
        $factory = new PlayersReaderFactory();
        $factory->setSource($source);
        if($filename) {
            $factory->setFileName($filename);
        }
        
        $reader = $factory->makePlayersReader();
        $playersData = $reader->getPlayersData();

        return $playersData;
    }

}

?>