<?php

include './PlayersViewModel.php';

// I'm assuming I can refactor as much as I like, as long as this part still works

// Test all 3 so that I know I haven't broken anything: (careful, they all print the same thing, so I need to make sure they don't just call the other test...)
$vmFromArray = new PlayersViewModel();
$vmFromArray->setPlayerData('array');
$vmFromArray->displayView(php_sapi_name() === 'cli' ? 'cli' : 'web');

$vmFromJson = new PlayersViewModel();
$vmFromJson->setPlayerData('json');
$vmFromJson->displayView(php_sapi_name() === 'cli' ? 'cli' : 'web');

$vmFromFile = new PlayersViewModel();
$vmFromFile->setPlayerData('file', './playerdata.json');
$vmFromFile->displayView(php_sapi_name() === 'cli' ? 'cli' : 'web');

$vmFromFile->writePlayers('players.json');

?>