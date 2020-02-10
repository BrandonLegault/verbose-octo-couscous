<?php

interface PlayersWriter {
    public function writePlayersData($players);
}

class PlayersFileWriter implements PlayersWriter {
    private $filename;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function writePlayersData($players) {
        // TODO: assert that it is json file
        file_put_contents($this->filename, json_encode($players));
    }
}

class PlayersWriterFactory {
    private $filename = null;

    public function setFileName($filename) {
        $this->filename = $filename;
    }

    public function makePlayersWriter() {
        return new PlayersFileWriter($this->filename);
    }
}

?>