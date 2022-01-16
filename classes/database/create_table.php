<?php

require_once __DIR__ . '/../../config/config.php';

CreateTable::create_cards_table();

class CreateTable {

    public static function create_cards_table() {

        try {

            $pdo = CreateTable::GetDbHandle();

            $prepare = $pdo->prepare(CreateTable::create_card_table_sql());

            $prepare->execute();

        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit('Faild to create cards table. ' . $e->getMessage());
        }

    }

    private static function create_card_table_sql() {

        $sql = "";
        $sql .= "CREATE TABLE `cards` (";
        $sql .= " `id` int(11) NOT NULL AUTO_INCREMENT,";
        $sql .= " `asset` varchar(255) DEFAULT NULL,";
        $sql .= " `asset_longname` varchar(255) DEFAULT NULL,";
        $sql .= " `assetgroup` varchar(255) DEFAULT NULL,";
        $sql .= " `name` varchar(255) DEFAULT NULL,";
        $sql .= " `issuer` varchar(255) DEFAULT NULL,";
        $sql .= " `imgur` varchar(255) DEFAULT NULL,";
        $sql .= " `description` varchar(2000) DEFAULT NULL,";
        $sql .= " `status` varchar(100) NOT NULL DEFAULT 'ok',";
        $sql .= " `tag` varchar(255) NOT NULL DEFAULT '',";
        $sql .= " `cid` varchar(255) NOT NULL,";
        $sql .= " `ver` varchar(255) NOT NULL DEFAULT '1',";
        $sql .= " `tx_hash` varchar(255) NOT NULL COMMENT '“o˜^Žž‚Ìissuance‚ÌtxƒnƒbƒVƒ…',";
        $sql .= " `regist_time` bigint(20) DEFAULT NULL,";
        $sql .= " `update_time` bigint(20) DEFAULT NULL,";
        $sql .= " PRIMARY KEY (`id`),";
        $sql .= " UNIQUE KEY `asset` (`asset`)";
        $sql .= ") ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;";

        return $sql;

    }

    private static function GetDbHandle() {

        $pdo = new PDO(
            'mysql:dbname='.DatabaseConfig::$NAME.';host='.DatabaseConfig::$PATH.';charset=utf8mb4',
            DatabaseConfig::$USER,
            DatabaseConfig::$PASSWORD,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );

        return $pdo;

    }

}