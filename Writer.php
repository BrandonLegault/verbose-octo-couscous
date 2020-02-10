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
        assert(substr($this->filename,-5) == '.json');
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