<?php

interface PlayersViewer {
    public function display($players);
}

class PlayersWebViewer implements PlayersViewer {
    public function display($players) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                li {
                    list-style-type: none;
                    margin-bottom: 1em;
                }
                span {
                    display: block;
                }
            </style>
        </head>
        <body>
        <div>
            <span class="title">Current Players</span>
            <ul>
                <?php foreach($players as $player) { ?>
                    <li>
                        <div>
                            <span class="player-name">Name: <?= $player->name ?></span>
                            <span class="player-age">Age: <?= $player->age ?></span>
                            <span class="player-salary">Salary: <?= $player->salary ?></span>
                            <span class="player-job">Job: <?= $player->job ?></span>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </body>
        </html>
        <?php
    }
}

class PlayersCliViewer implements PlayersViewer {
    public function display($players) {
        echo "Current Players: \n";
            foreach ($players as $player) {

                echo "\tName: $player->name\n";
                echo "\tAge: $player->age\n";
                echo "\tSalary: $player->salary\n";
                echo "\tJob: $player->job\n\n";
            }
    }
}

class PlayersViewerFactory {
    private $isCLI = null;

    public function setIsCli($isCLI) {
        $this->isCLI = $isCLI;
    }

    public function makePlayersViewer() {
        assert($isCLI != null);
        $viewer = null;
        if($this->isCLI) {
            $viewer = new PlayersCliViewer();
        } else {
            $viewer = new PlayersWebViewer();
        }
        return $viewer;
    }
}

?>