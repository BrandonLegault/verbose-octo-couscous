<?php

include './PlayersModel.php';
include './PlayersViewer.php';
include './Reader.php';
include './Writer.php';

class PlayersViewModel {

    private $viewType;

    private $playersModel;

    /**
     * @param $model optional model object; otherwise, a new model is created
     * @param $viewType optional string to set default value. 'cli' or 'web'
     * @param $source optional string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $filename optional string Only used if we're reading players in 'file' mode.
     */
    public function __construct($model = null, $viewType = null, $source = null, $filename = null) {
        $this->viewType = $viewType;

        if(!$model) {
            $model = new PlayersModel;
        }
        $this->playersModel = $model;

        if($source) {
            $this->setPlayerData($source, $filename);
        }
    }

    public function setPlayerData($source, $filename = null) {
        $players = $this->readPlayers($source, $filename);
        $this->playersModel->setPlayersArray($players);
    }

    public function displayView($viewType = null) {
        if($viewType == null) {
            $viewType = $this->viewType;
        }

        $factory = new PlayersViewerFactory();
        $factory->setViewType($viewType);

        $viewer = $factory->makePlayersViewer();
        $playersData = $this->playersModel->getPlayersArray();
        $viewer->display($playersData);
    }

    public function writePlayers($filename) {
        $factory = new PlayersWriterFactory();
        $factory->setFileName($filename);
        
        $writer = $factory->makePlayersWriter();
        $playersData = $this->playersModel->getPlayersArray();
        $writer->writePlayersData($playersData);
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