<?php

require_once __DIR__ . '/../classes/card.php';

class Monacard1 {

    public $card;

    public function load($asset_name) {

        $monacard1_list = new Monacard1_List();
        $monacard1_list->load();
        $this->card = $monacard1_list->search_card($asset_name);

    }

}

class Monacard1_List {

    public $cards = [];

    public function load_all() {

        $json = file_get_contents(__DIR__ . '/../data/monacard1.0_metadata.json');
        if ($json === false) {
            exit("Monacard1.0のメタデータが配置されていません。管理者はscript_download_monacard1_metadata.phpを実行し案内の通りにダウンロードしたファイルを配置してください。");
        }

        $json = json_decode($json, true);

        foreach($json["details"] as $row) {

            $card = $this->change_format_to_card($row);
            $this->cards[] = $card;

        }

    }

    public function search_card($asset_name) {

        foreach($this->cards as $card) {
            if($card->asset == $asset_name) {
                return $card;
            }
        }

        return null;

    }

    private function change_format_to_card($json) {

        $card = new card();

        $card->id = $json['id'];
        $card->asset = $json['asset'];
        $card->asset_longname = $json['asset_longname'];
        $card->card_name = $json['card_name'];
        $card->owner_name = $json['owner_name'];
        $card->imgur_url = $json['imgur_url'];
        $card->description = $json['add_description'];
        $card->tw_id = $json['tw_id'];
        $card->tw_name = $json['tw_name'];
        $card->status = $json['is_good_status'];
        $card->tag = $json['tag'];
        $card->cid = $json['cid'];
        $card->ver = $json['ver'];
        $card->regist_time = $json['regist_time'];
        $card->update_time = $json['update_time'];

        return $card;

    }

}