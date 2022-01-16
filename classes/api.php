<?php

class card_list_for_api{

    public $list = array();

    public function Add($asset_name) {
        $this->list[] = $asset_name;
    }

}

class card_details_for_api {

    public $details = array();

    public function Add($card) {
        $this->details[] = $card;
    }

}

class card_detail_for_api {

    public function LoadFromArray($row_info) {

        $card = new card();
        $card->LoadFromArray($row_info);

        $this->asset_common_name = $card->asset_common_name;
        $this->asset = $card->asset;
        $this->asset_longname = $card->asset_longname;
        $this->assetgroup = $card->assetgroup;
        $this->card_name = $card->card_name;
        $this->owner_name = $card->owner_name;
        $this->imgur_url = $card->GetFilteredUrl();
        $this->add_description = $card->add_description;
        $this->tw_id = $card->tw_id;
        $this->tw_name = $card->tw_name;
        $this->tag = $card->tag;
        $this->cid = $card->cid;
        $this->ver = $card->ver;
        $this->is_good_status = $card->IsGoodStatus();
        $this->regist_time = $card->regist_time;
        $this->update_time = $card->update_time;

        $this->id = $card->id;

    }

    public function Sanitize() {

        $this->card_name = Utils::c($this->card_name);
        $this->owner_name = Utils::c($this->owner_name);
        $this->imgur_url = Utils::c($this->imgur_url);
        $this->add_description = Utils::c($this->add_description);
        $this->tw_id = Utils::c($this->tw_id);
        $this->tw_name = Utils::c($this->tw_name);
        $this->tag = Utils::c($this->tag);
        $this->cid = Utils::c($this->cid);
        $this->ver = Utils::c($this->ver);

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