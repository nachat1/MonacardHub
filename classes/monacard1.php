<?php

require_once __DIR__ . '/../classes/card.php';

//$monacard = new Monacard1();
//$monacard->load();

class Monacard1 {

    public $cards = [];

    public function load() {

        $json = file_get_contents(__DIR__ . '/../data/monacard1.0_metadata.json');
        if ($json === false) {
            exit("Monacard1.0�̃��^�f�[�^���z�u����Ă��܂���B�Ǘ��҂�script_download_monacard1_metadata.php�����s���ē��̒ʂ�Ƀ_�E�����[�h�����t�@�C����z�u���Ă��������B");
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
        $card->card_name = $json['card_name'];
        $card->owner_name = $json['owner_name'];
        $card->imgur_url = $json['imgur_url'];
        $card->add_description = $json['add_description'];
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