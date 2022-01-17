<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/counterparty.php';
require_once __DIR__ . '/../classes/asset.php';
require_once __DIR__ . '/../classes/utils.php';
require_once __DIR__ . '/../classes/card.php';
require_once __DIR__ . '/../classes/database/card_table.php';

$asset_name = $_GET['asset'];
if(!isset($asset_name)) {
    exit('Invalid parameter.');
}

$asset = new Asset();
$asset->load_from_api($asset_name);

$card = new Card();
$card->load_from_database($asset->asset);

var_dump($asset);
var_dump($card);

?>
