<?php

echo("Start to make cards table.");

require_once __DIR__ . '/../classes/database/create_table.php';
Create_Table::create_cards_table();

echo("Created successfully.");
?>