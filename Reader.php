<?php

interface PlayersReader {
    public function getPlayersData();
}

class PlayersArrayReader implements PlayersReader {
    public function getPlayersData() {
        $players = [];

        $jonas = new \stdClass();
        $jonas->name = 'Jonas Valenciunas';
        $jonas->age = 26;
        $jonas->job = 'Center';
        $jonas->salary = '4.66m';
        $players[] = $jonas;

        $kyle = new \stdClass();
        $kyle->name = 'Kyle Lowry';
        $kyle->age = 32;
        $kyle->job = 'Point Guard';
        $kyle->salary = '28.7m';
        $players[] = $kyle;

        $demar = new \stdClass();
        $demar->name = 'Demar DeRozan';
        $demar->age = 28;
        $demar->job = 'Shooting Guard';
        $demar->salary = '26.54m';
        $players[] = $demar;

        $jakob = new \stdClass();
        $jakob->name = 'Jakob Poeltl';
        $jakob->age = 22;
        $jakob->job = 'Center';
        $jakob->salary = '2.704m';
        $players[] = $jakob;

        return $players;
    }
}

class PlayersJsonReader implements PlayersReader {
    public function getPlayersData() {
        $json = '[{"name":"Jonas Valenciunas","age":26,"job":"Center","salary":"4.66m"},{"name":"Kyle Lowry","age":32,"job":"Point Guard","salary":"28.7m"},{"name":"Demar DeRozan","age":28,"job":"Shooting Guard","salary":"26.54m"},{"name":"Jakob Poeltl","age":22,"job":"Center","salary":"2.704m"}]';
        return json_decode($json);
    }
}

class PlayersFileReader implements PlayersReader {
    private $filename;

    // it seems silly to have to create a new file reader for each file you need to read,
    // but I don't want the interface to know about the filename
    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function getPlayersData() {
        assert(substr($this->filename,-5) == '.json');
        $fileData = file_get_contents($this->filename);
        return json_decode($fileData);
    }
}

class PlayersReaderFactory {
    private $source;
    private $filename;

    public function setSource($source) {
        $this->source = $source;
    }

    public function setFileName($filename) {
        $this->filename = $filename;
    }

    public function makePlayersReader() {
        $reader = null;
        switch ($this->source) {
            case 'array':
                $reader = new PlayersArrayReader();
                break;
            case 'json':
                $reader = new PlayersJsonReader();
                break;
            case 'file':
                assert($this->filename);
                $reader = new PlayersFileReader($this->filename);
                break;
            default:
                throw new Error('source could not be parsed');
        }

        return $reader;
    }
}

?>