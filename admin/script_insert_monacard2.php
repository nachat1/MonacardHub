<?php

echo("Start to insert monacard2.0 cards.");

require_once __DIR__ . '/../classes/card.php';
require_once __DIR__ . '/../classes/monacard2.php';
require_once __DIR__ . '/../classes/database/card_table.php';

$monacard = new Monacard2_List();
$monacard->load_all();

$pdo = Card_Table::GetDbHandle();
foreach($monacard->card_list as $card) {
    Card_Table::insert_or_update_monacard2($pdo, $card);
    echo $card->asset;
    echo "<br>";
}

echo("Inserted successfully.");

?>