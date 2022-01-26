<?php

require_once __DIR__ . '/../classes/database/card_table.php';

$asset = $_POST['asset'];
$status = $_POST['status'];
$update_time = time();

Card_Table::update_card_sutatus($asset, $status, $update_time);

header( 'location: /explorer/card_detail.php?asset=' . $asset);
exit;

?>