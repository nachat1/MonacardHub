<?php

require_once __DIR__ . '/../classes/asset.php';
require_once __DIR__ . '/../classes/card.php';

class Monacard2 {

    public $card;

    public function load($asset_name) {

        $asset = new Asset_Info();
        $asset_info_array = Counterparty::get_asset_info($asset_name);
        $asset->load_from_object($asset_info_array);
        $asset->load_description();

        $this->card = $this->change_format_to_card($asset);

    }

    private function change_format_to_card($asset) {

        $card = new card();

        $card->card_name = $asset->parsed_description->card_name;
        $card->owner_name = $asset->parsed_description->owner_name;
        $card->add_description = $asset->parsed_description->add_description;
        $card->tag = $asset->parsed_description->tag;
        $card->cid = $asset->parsed_description->cid;
        $card->ver = $asset->parsed_description->ver;

        return $card;

    }

}