<?php

echo("Start to sync banned cards.<br>");

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/database/card_table.php';

$json = file_get_contents(Config::$URL_SHARE_BAN_LIST);
if ($json === false) {
    exit("Faid to connect API.");
}

$json = json_decode($json, true)["list"];

foreach($json as $row) {
    Card_Table::update_card_sutatus($row["asset"], $row["status"], $row["update_time"]);
    echo($row["asset"]. "<br>");
}

echo("Synced successfully.");

?>