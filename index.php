<?php

require_once __DIR__ . '/classes/database/card_table.php';
require_once __DIR__ . '/classes/card.php';
require_once __DIR__ . '/classes/utils.php';

$card_list = [];

$card_list_raw = Card_Table::select_cards();
foreach($card_list_raw as $row) {

    $card = new Card();
    $card->load_from_db_row($row);
    $card_list[] = $card;

}

foreach($card_list as $card) {
    echo('<a href="/explorer/card_detail.php?asset='.Utils::sanitize($card->asset).'">'.Utils::sanitize($card->card_name).'</a><br>');
}

?>
