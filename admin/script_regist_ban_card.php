<?php

$asset = $_GET['asset'];
if (!preg_match("/^[a-zA-Z0-9\.\-_@!,]+$/", $target)) {
    echo '{"error":{"message":"Inccorect parameters."}}';
    exit;
}

$status = $_GET['status'];
$update_time = time();

Card_Table::update_card_sutatus($asset, $status, $update_time);

?>