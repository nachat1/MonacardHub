<?php

// アセットのdescriptionを解析しMonacard2.0の形式扱うクラス
class Parsed_Description {

    public $card_name;
    public $owner_name;
    public $add_description;
    public $tag;
    public $cid;
    public $ver;
    public $identifier; // MONACARD識別子

    // descriptionの文字列をMonacard2.0として解析する
    public function load_from_string($text) {

        $json = json_decode($text);

        // 複数APPが指定できるためmonacardの部分を探す
        foreach($json as $key => $value) {

            if($key != "monacard") { continue; }

            $this->identifier = "monacard";
            $this->card_name = $value->name;
            $this->owner_name = $value->owner;
            $this->add_description = $value->desc;
            $this->tag = $value->tag;
            $this->cid = $value->cid;
            $this->ver = $value->ver;

        }

    }

    public function has_card_name() {
        return $this->card_name != "";
    }

    public function has_owner_name() {
        return $this->owner_name != "";
    }

    public function has_cid() {
        return $this->cid != "";
    }

    public function has_ver() {
        return $this->ver != "";
    }

    public function has_description() {
        return $this->add_description != "";
    }

    public function is_available(){

        if($this->identifier != "monacard") {
            return false;
        }

        return $this->has_card_name() && $this->has_owner_name() && $this->has_cid() && $this->has_ver() && $this->has_description(); // すべて有効でないとMonacard2.0ではない
    }

}

class Asset {

    public $asset_longname;
    public $asset;
    public $locked;
    public $divisible;
    public $issuer;
    public $owner;
    public $supply;
    public $description;
    public $listed;
    public $reassignable;
    public $assetgroup;
    public $parsed_description;

    public function load_from_api($asset_name) {

        $asset_info = Counterparty::get_assets_info([$asset_name])[0];
        $this->load_from_object($asset_info);

    }

    private function load_from_object($info) {

        $this->asset_longname = $info->asset_longname;
        $this->asset = $info->asset;
        $this->locked = $info->locked;
        $this->divisible = $info->divisible;
        $this->issuer = $info->issuer;
        $this->owner = $info->owner;
        $this->supply = $info->supply;
        $this->description = $info->description;
        $this->listed = $info->listed;
        $this->reassignable = $info->reassignable;
        $this->assetgroup = $info->assetgroup;

    }

    public function load_description() {

        $this->parsed_description = new Parsed_Description();
        $this->parsed_description->load_from_string($this->description);

    }

    public function get_common_name() {

        if(isset($this->asset_longname)) {
            return $this->asset_longname;
        } else {
            return $this->asset;
        }

    }

    public function get_serialized_supply() {

        if(!$this->divisible) {
            return $this->supply;
        } else {
            return $this->supply / 100000000;
        }

    }

}