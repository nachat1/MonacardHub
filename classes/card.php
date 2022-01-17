<?php

require_once __DIR__ . '/../classes/monacard1.php';
require_once __DIR__ . '/../classes/asset.php';

class Card {

    public $id;
    public $asset;
    public $asset_longname;
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

    public function get_filtered_url_imgur() {

        if($this->status == 'ok') {
            return $this->imgur_url;
        } else {
            return 'https://i.imgur.com/ZS5x3gL.png'; // ˆá”½‰æ‘œ
        }

    }

    public function get_filtered_url_ipfs() {

        if($this->status == 'ok') {
            return 'https://ipfs.io/ipfs/' . Utils::c($this->cid);
        } else {
            return 'https://i.imgur.com/ZS5x3gL.png'; // ˆá”½‰æ‘œ
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