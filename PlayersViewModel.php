<?php

include './PlayersModel.php';
include './PlayersViewer.php';
include './Reader.php';
include './Writer.php';

class PlayersViewModel {

    private $isCLI;

    private $playersModel;

    public function __construct($isCLI = null, $source = null, $filename = null, $model = null) {
        $this->isCLI = $isCLI;

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

    public function displayView($isCLI = null) {
        if($isCLI == null) {
            // I'd guess that a viewModel would normally be viewed in the same way each time
            $isCLI = $this->isCLI;
        }

        $factory = new PlayersViewerFactory();
        $factory->setIsCli($isCLI);

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