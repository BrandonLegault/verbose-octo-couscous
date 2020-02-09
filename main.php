<?php

include './PlayersViewModel.php';

// I'm assuming I can refactor as much as I like, as long as this part still works
$playersViewModel = new PlayersViewModel();

// Test all 3 so that I know I haven't broken anything: (careful, they all print the same thing, so I need to make sure they don't just call the other test...)
$playersViewModel->displayView(php_sapi_name() === 'cli', 'array');
$playersViewModel->displayView(php_sapi_name() === 'cli', 'json');
$playersViewModel->displayView(php_sapi_name() === 'cli', 'file', './playerdata.json');

?>