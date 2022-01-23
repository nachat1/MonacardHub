<?php

require_once __DIR__ . '/../api_header.php';
require_once __DIR__ . '/../../classes/database/card_table.php';
require_once __DIR__ . '/../../classes/card.php';

$card_list_db = Card_Table::select_cards();

if($card_list_db == false) {
    echo '{"error":{"message":"Database error."}}';
    exit;
}

$card_list = new Card_List_For_Api();
foreach($card_list_db as $card) {
    $asset_common_name = $card['asset'];
    if($card['asset_longname'] != null) {
        $asset_common_name = $card['asset_longname'];
    }
    $card_list->list[] = $asset_common_name;
}

$json = json_encode($card_list);
echo $json;


?>