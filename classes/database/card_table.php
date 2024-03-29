<?php

require_once __DIR__ . '/../../config/config.php';

class Card_Table {

    public static function insert_monacard1($pdo, Card $card) {

        try {

            $prepare = $pdo->prepare('insert into cards(asset, asset_longname, assetgroup, name, issuer, imgur, description, status, tag, cid, ver, tx_hash, regist_time, update_time) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?)');

            $prepare->bindValue(1, $card->asset, PDO::PARAM_STR);
            $prepare->bindValue(2, $card->asset_longname, PDO::PARAM_STR);
            $prepare->bindValue(3, $card->assetgroup, PDO::PARAM_STR);
            $prepare->bindValue(4, $card->card_name, PDO::PARAM_STR);
            $prepare->bindValue(5, $card->owner_name, PDO::PARAM_STR);
            $prepare->bindValue(6, $card->imgur_url, PDO::PARAM_STR);
            $prepare->bindValue(7, $card->description, PDO::PARAM_STR);
            $prepare->bindValue(8, $card->status, PDO::PARAM_STR);
            $prepare->bindValue(9, $card->tag, PDO::PARAM_STR);
            $prepare->bindValue(10, $card->cid, PDO::PARAM_STR);
            $prepare->bindValue(11, $card->ver, PDO::PARAM_STR);
            $prepare->bindValue(12, "", PDO::PARAM_STR);
            $prepare->bindValue(13, $card->regist_time, PDO::PARAM_INT);
            $prepare->bindValue(14, $card->update_time, PDO::PARAM_INT);
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
            $prepare->bindValue(3, $card->asset_group, PDO::PARAM_STR);
            $prepare->bindValue(4, $card->card_name, PDO::PARAM_STR);
            $prepare->bindValue(5, $card->owner_name, PDO::PARAM_STR);
            $prepare->bindValue(6, $card->imgur_url, PDO::PARAM_STR);
            $prepare->bindValue(7, $card->get_limited_description(), PDO::PARAM_STR);
            $prepare->bindValue(8, $card->tag, PDO::PARAM_STR);
            $prepare->bindValue(9, $card->cid, PDO::PARAM_STR);
            $prepare->bindValue(10, $card->ver, PDO::PARAM_STR);
            $prepare->bindValue(11, $card->tx_hash, PDO::PARAM_STR);
            $prepare->bindValue(12, $card->tx_index, PDO::PARAM_INT);
            $prepare->bindValue(13, time(), PDO::PARAM_INT);
            $prepare->bindValue(14, time(), PDO::PARAM_INT);
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

    public static function select_card($asset_name) {

        try {

            $pdo = Card_Table::GetDbHandle();

            $prepare = $pdo->prepare("select * from cards where asset = ? and status <> 'delete'");
            $prepare->bindValue(1, $asset_name, PDO::PARAM_STR);
            $prepare->execute();
            return $prepare->fetchAll()[0];

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit('Faild to connect db.');
        }

    }

    public static function select_cards() {

        try {

            $pdo = Card_Table::GetDbHandle();

            $prepare = $pdo->prepare("select * from cards where status <> 'delete' order by id desc");
            $prepare->execute();
            return $prepare->fetchAll();

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            return false;
        }

    }

    public static function select_cards_by_asset_list($assets) {

        try {

            $pdo = Card_Table::GetDbHandle();

            $inClause = substr(str_repeat(',?', count($assets)), 1);
            $sql = "select * from cards where asset in ({$inClause}) and status <> 'delete' order by id desc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($assets);
            return $stmt->fetchAll();

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            return false;
        }

    }

    public static function select_cards_by_asset_longname_list($asset_longname_list) {

        try {

            $pdo = Card_Table::GetDbHandle();

            $inClause = substr(str_repeat(',?', count($asset_longname_list)), 1);
            $sql = "select * from cards where asset_longname in ({$inClause}) and status <> 'delete' order by id desc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($asset_longname_list);
            return $stmt->fetchAll();

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            return false;
        }

    }

    public static function select_cards_by_tag($tag) {

        try {

            $pdo = Card_Table::GetDbHandle();

            $prepare = $pdo->prepare("select * from cards where status <> 'delete' and tag like ? order by id desc");
            $prepare->execute(array('%'.$tag.'%'));
            return $prepare->fetchAll();

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            return false;
        }

    }

    public static function select_cards_by_updatetime($unixtime) {

        try {

            $pdo = Card_Table::GetDbHandle();

            $prepare = $pdo->prepare("select * from cards where status <> 'delete' and update_time >= ? order by id desc");
            $prepare->bindValue(1, $unixtime, PDO::PARAM_INT);
            $prepare->execute();
            return $prepare->fetchAll();

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            return false;
        }

    }

    public static function select_banned_cards() {

        try {

            $pdo = Card_Table::GetDbHandle();

            $prepare = $pdo->prepare("select * from cards where status <> 'good' order by id desc");
            $prepare->execute();
            return $prepare->fetchAll();

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            return false;
        }

    }

    public static function update_card_sutatus($asset_name, $status, $update_time) {

        try {

            $pdo = Card_Table::GetDbHandle();

            $prepare = $pdo->prepare("update cards set status = ?, update_time = ? where asset = ?");
            $prepare->bindValue(1, $status, PDO::PARAM_STR);
            $prepare->bindValue(2, $update_time, PDO::PARAM_INT);
            $prepare->bindValue(3, $asset_name, PDO::PARAM_STR);
            $prepare->execute();
            return true;

        }
        catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            return false;
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