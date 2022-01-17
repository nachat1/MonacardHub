<?php

require_once __DIR__ . '/../../config/config.php';

class Card_Table {

    public static function insert_monacard1($pdo, Card $card) {

        try {

            $prepare = $pdo->prepare('insert into cards(asset, asset_longname, assetgroup, name, issuer, imgur, description, tag, cid, ver, tx_hash, regist_time, update_time) VALUES (?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?)');

            $prepare->bindValue(1, $card->asset, PDO::PARAM_STR);
            $prepare->bindValue(2, $card->asset_longname, PDO::PARAM_STR);
            $prepare->bindValue(3, $card->assetgroup, PDO::PARAM_STR);
            $prepare->bindValue(4, $card->card_name, PDO::PARAM_STR);
            $prepare->bindValue(5, $card->owner_name, PDO::PARAM_STR);
            $prepare->bindValue(6, $card->imgur_url, PDO::PARAM_STR);
            $prepare->bindValue(7, $card->description, PDO::PARAM_STR);
            $prepare->bindValue(8, $card->tag, PDO::PARAM_STR);
            $prepare->bindValue(9, $card->cid, PDO::PARAM_STR);
            $prepare->bindValue(10, $card->ver, PDO::PARAM_STR);
            $prepare->bindValue(11, "", PDO::PARAM_STR);
            $prepare->bindValue(12, $card->regist_time, PDO::PARAM_INT);
            $prepare->bindValue(13, $card->update_time, PDO::PARAM_INT);
            $prepare->execute();


        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit('Faild to insert new monacard. ' . $e->getMessage());
        }

    }

    public static function insert_or_update_monacard2($pdo, Card $card) {

        try {

            $prepare = $pdo->prepare('insert into cards(asset, asset_longname, assetgroup, name, issuer, imgur, description, tag, cid, ver, tx_hash, tx_index, regist_time, update_time) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?) on duplicate key update name=?, issuer=?, description=?, tag=?, cid=?, ver=?, tx_hash=?, tx_index=?, update_time=?');

            $prepare->bindValue(1, $card->asset, PDO::PARAM_STR);
            $prepare->bindValue(2, $card->asset_longname, PDO::PARAM_STR);
            $prepare->bindValue(3, $card->assetgroup, PDO::PARAM_STR);
            $prepare->bindValue(4, $card->card_name, PDO::PARAM_STR);
            $prepare->bindValue(5, $card->owner_name, PDO::PARAM_STR);
            $prepare->bindValue(6, $card->imgur_url, PDO::PARAM_STR);
            $prepare->bindValue(7, $card->get_limited_description(), PDO::PARAM_STR);
            $prepare->bindValue(8, $card->tag, PDO::PARAM_STR);
            $prepare->bindValue(9, $card->cid, PDO::PARAM_STR);
            $prepare->bindValue(10, $card->ver, PDO::PARAM_STR);
            $prepare->bindValue(11, $card->tx_hash, PDO::PARAM_STR);
            $prepare->bindValue(12, $card->tx_index, PDO::PARAM_INT);
            $prepare->bindValue(13, 0, PDO::PARAM_INT);
            $prepare->bindValue(14, 0, PDO::PARAM_INT);
            $prepare->bindValue(15, $card->card_name, PDO::PARAM_STR);
            $prepare->bindValue(16, $card->owner_name, PDO::PARAM_STR);
            $prepare->bindValue(17, $card->get_limited_description(), PDO::PARAM_STR);
            $prepare->bindValue(18, $card->tag, PDO::PARAM_STR);
            $prepare->bindValue(19, $card->cid, PDO::PARAM_STR);
            $prepare->bindValue(20, $card->ver, PDO::PARAM_STR);
            $prepare->bindValue(21, $card->tx_hash, PDO::PARAM_STR);
            $prepare->bindValue(22, $card->tx_index, PDO::PARAM_INT);
            $prepare->bindValue(23, 0, PDO::PARAM_INT);
            $prepare->execute();

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit('Faild to insert new monacard. ' . $e->getMessage());
        }

    }

    public static function get_last_txid() {

        try {

            $pdo = Card_Table::GetDbHandle();

            $prepare = $pdo->prepare('select max(tx_index) from cards');
            $prepare->execute();
            $result = $prepare->fetchAll();
            return $result[0]["max(tx_index)"];

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit('Faild to insert new monacard. ' . $e->getMessage());
        }

    }

    public static function GetDbHandle() {

        $pdo = new PDO(
            'mysql:dbname='.Database_Config::$NAME.';host='.Database_Config::$PATH.';charset=utf8mb4',
            Database_Config::$USER,
            Database_Config::$PASSWORD,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );

        return $pdo;

    }

}