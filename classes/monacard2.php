<?php

require_once __DIR__ . '/../classes/asset.php';
require_once __DIR__ . '/../classes/card.php';
require_once __DIR__ . '/../classes/counterparty.php';

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

class Monacard2_List {

    public $card_list = [];

    public function load($start_block_index) {

        $json = Counterparty::get_issuances($start_block_index);

        foreach($json as $row) {
            $card = new Card();
            $card->load_from_issuance_info($row);
            if(!empty($card->card_name)) {
                $this->card_list[] = $card;
            }
        }

        $last_block_index = end($json)->block_index;
        return $last_block_index;

    }

    public function load_all() {

        $FIRST_MONACARD2_BLOCK = 2446815;
        $json = Counterparty::get_issuances($FIRST_MONACARD2_BLOCK);

        foreach($json as $row) {
            $card = new Card();
            $card->load_from_issuance_info($row);
            if(!empty($card->card_name)) {
                $this->card_list[] = $card;
            }
        }
        $last_block_index = end($json)->block_index;

        $loop_count = 0;
        while(true) {

            if(count($json) < 1000) {
                break;
            }
            if($loop_count++ > 100) {
                break; // –³ŒÀƒ‹[ƒv–hŽ~
            }

            $json = Counterparty::get_issuances($last_block_index);
            foreach($json as $row) {
                $card = new Card();
                $card->load_from_issuance_info($row);
                if(!empty($card->card_name)) {
                    $this->card_list[] = $card;
                }
            }
            $last_block_index = end($json)->block_index;

        }

    }

    public function load_from($tx_index) {

        $json = Counterparty::get_issuances_tx_index($tx_index);

        foreach($json as $row) {
            $card = new Card();
            $card->load_from_issuance_info($row);
            if(!empty($card->card_name)) {
                $this->card_list[] = $card;
            }
        }

    }

}