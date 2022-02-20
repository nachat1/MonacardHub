<?php

require_once __DIR__ . '/../classes/monacard1.php';
require_once __DIR__ . '/../classes/asset.php';
require_once __DIR__ . '/../classes/utils.php';
require_once __DIR__ . '/../classes/database/card_table.php';
require_once __DIR__ . '/../config/config.php';

class Card {

    public $id;
    public $asset;
    public $asset_longname;
    public $asset_group;
    public $card_name;
    public $owner_name;
    public $imgur_url;
    public $description;
    public $tw_id;
    public $tw_name;
    public $status;
    public $tag;
    public $cid;
    public $ver;
    public $tx_hash;
    public $tx_index;
    public $regist_time;
    public $update_time;

    public function load_from_issuance_info($json) {

        $parsed_description = new Parsed_Description();
        $parsed_description->load_from_string($json->description);

        // Monacard2.0‚Ìd—l‚ğ–‚½‚µ‚Ä‚¢‚È‚¢ê‡
        if(!$parsed_description->is_available()) {
            return;
        }

        $this->asset = $json->asset;
        $this->asset_longname = $json->asset_longname;
        $this->asset_group = $json->asset_group;
        $this->card_name = $parsed_description->card_name;
        $this->owner_name = $parsed_description->owner_name;
        $this->imgur_url = "";
        $this->cid = $parsed_description->cid;
        $this->ver = $parsed_description->ver;
        $this->description = $parsed_description->add_description;
        $this->tag = $parsed_description->tag;
        $this->tx_hash = $json->tx_hash;
        $this->tx_index = $json->tx_index;

    }

    public function load_from_database($asset_name) {

        $result = Card_Table::select_card($asset_name);
        $this->load_from_db_row($result);

    }

    public function load_from_db_row($row) {

        $this->id = $row["id"];
        $this->asset = $row["asset"];
        $this->asset_longname = $row["asset_longname"];
        $this->asset_group = $row["asset_group"];
        $this->card_name = $row["name"];
        $this->owner_name = $row["issuer"];
        $this->imgur_url = $row["imgur"];
        $this->cid = $row["cid"];
        $this->ver = $row["ver"];
        $this->description = $row["description"];
        $this->status = $row["status"];
        $this->tag = $row["tag"];
        $this->tx_hash = $row["tx_hash"];
        $this->tx_index = $row["tx_index"];
        $this->regist_time = $row["regist_time"];
        $this->update_time = $row["update_time"];

    }

    public function get_common_name() {

        if(isset($this->asset_longname)) {
            return $this->asset_longname;
        } else {
            return $this->asset;
        }

    }

    public function get_limited_card_name($limit = 15) {
        return mb_substr($this->card_name, 0, $limit);
    }

    public function get_limited_description($limit = 1000) {
        return mb_substr($this->description, 0, $limit);
    }

    public function get_m_size_image_url() {

        $parsed_url = parse_url($this->imgur_url);

        switch($parsed_url['host']) {
            case 'i.imgur.com':
                $no_extention = preg_replace("/(.+)(\.[^.]+$)/", "$1", $this->GetFilteredUrl());
                return $no_extention . 'm.png';
            case 'img.monaffy.jp':
                return str_replace('original', 'preview', $this->GetFilteredUrl());
            default:
                return $this->imgur_url;
        }

    }

    public function get_display_img_url() {

        if(empty(Config::$URL_SHARE_IMAGE_URL)) {
            return $this->get_filtered_url_ipfs();
        } else {
            return '/img/' . $this->get_filtered_cid();
        }

    }

    public function get_filtered_url_imgur() {

        if($this->status == 'good') {
            return $this->imgur_url;
        } else {
            return 'https://i.imgur.com/ZS5x3gL.png'; // ˆá”½‰æ‘œ
        }

    }

    public function get_filtered_url_ipfs() {

        if($this->status == 'good') {
            return 'https://cloudflare-ipfs.com/ipfs/' . Utils::sanitize($this->cid);
        } else {
            return 'https://cloudflare-ipfs.com/ipfs/bafkrmigia4yfuknnygijg3yrv4zfb4onbvg5f2pegqidbppgqasfi7ybqm';
        }

    }

    public function get_filtered_cid() {

        if($this->status == 'good') {
            return Utils::sanitize($this->cid);
        } else {
            return 'bafkrmigia4yfuknnygijg3yrv4zfb4onbvg5f2pegqidbppgqasfi7ybqm';
        }

    }

    public function is_status_good() {
        if($this->status == 'ok') {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function get_warning() {
        return '';
    }

}

class Card_List_For_Api {

    public $list = [];

    public function add($asset_name) {
        $this->list[] = $asset_name;
    }

}

class Card_Detail_List_For_Api {

    public $details = array();

    public function add($card) {
        $this->details[] = $card;
    }

}

class Card_Detail_For_Api {

    public function load_from_db_row($row) {

        $card = new Card();
        $card->load_from_db_row($row);

        $this->id = $card->id;
        $this->asset_common_name = $card->get_common_name();
        $this->asset = $card->asset;
        $this->asset_longname = $card->asset_longname;
        $this->assetgroup = $card->asset_group;
        $this->card_name = $card->card_name;
        $this->owner_name = $card->owner_name;
        $this->imgur_url = $card->get_filtered_url_imgur();
        $this->add_description = $card->description;
        $this->tw_id = $card->tw_id;
        $this->tw_name = $card->tw_name;
        $this->tag = $card->tag;
        $this->cid = $card->cid;
        $this->ver = $card->ver;
        $this->is_good_status = $card->is_status_good();
        $this->regist_time = $card->regist_time;
        $this->update_time = $card->update_time;

    }

    public function sanitize() {

        $this->card_name = Utils::sanitize($this->card_name);
        $this->owner_name = Utils::sanitize($this->owner_name);
        $this->imgur_url = Utils::sanitize($this->imgur_url);
        $this->add_description = Utils::sanitize($this->add_description);
        $this->tw_id = Utils::sanitize($this->tw_id);
        $this->tw_name = Utils::sanitize($this->tw_name);
        $this->tag = Utils::sanitize($this->tag);
        $this->cid = Utils::sanitize($this->cid);
        $this->ver = Utils::sanitize($this->ver);

    }

    public $id;
    public $asset_common_name;
    public $asset;
    public $asset_longname;
    public $assetgroup;
    public $card_name;
    public $owner_name;
    public $imgur_url;
    public $add_description;
    public $tw_id;
    public $tw_name;
    public $tag;
    public $cid;
    public $ver;
    public $is_good_status;
    public $regist_time;
    public $update_time;

}
