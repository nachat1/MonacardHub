<?php

echo("Start to insert monacard1.0 cards.");

require_once __DIR__ . '/../classes/card.php';
require_once __DIR__ . '/../classes/monacard1.php';
require_once __DIR__ . '/../classes/database/card_table.php';

$monacard = new Monacard1_List();
$monacard->load_all();

$pdo = Card_Table::GetDbHandle();
foreach($monacard->cards as $card) {
    Card_Table::insert_monacard1($pdo, $card);
}

echo("Inserted successfully.");

?>