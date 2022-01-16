<?php

require_once __DIR__ . '/../classes/monacard1.php';
require_once __DIR__ . '/../classes/monacard2.php';

class CardInfoManager {

    private $asset_name;

    function __construct($asset_name) {
        $this->asset_name = $asset_name;
    }

    private function get_monacard1() {

        $monacard = new Monacard1();
        $monacard->load();
        return $monacard->search_card($this->asset_name);

    }

    private function get_monacard2() {

        $monacard = new Monacard2();
        $monacard->load($this->asset_name);
        return $monacard->card;

    }

    public function get_card() {

        $monacard2 = $this->get_monacard2();
        if(!empty($monacard2->card_name)) {
            return $monacard2;
        }

        $monacard1 = $this->get_monacard1();
        if(!empty($monacard1->card_name)) {
            return $monacard1;
        }

        return null;

    }

}