<?php

require_once __DIR__ . '/../config/config.php';

class Counterparty {

    static function get_asset_info($asset_name) {

        $result = Counterparty_Reader::read_api('get_assets_info', ['assetsList' => [$asset_name]]);
        return $result[0];

    }

    static function get_broadcast($tx_hash) {

        $result = Counterparty_Reader::read_proxy_api('get_broadcasts', ['filters' => ['field' => "tx_hash", 'op' => "==", 'value' => $tx_hash] ]);
        return $result[0]->text;

    }

    static function get_issuances($start_block_index) { // 上限1000件, 最初の登録はblock_index:2446815

        $result = Counterparty_Reader::read_proxy_api('get_issuances', ['filters' => [['field' => "block_index", 'op' => ">=", 'value' => $start_block_index], ['field' => "description", 'op' => "LIKE", 'value' => "%monacard%"]] , "order_by" => "tx_index", "order_dir" => "ASC" ]);
        return $result;

    }

}

class Counterparty_Reader {


    public static function read_proxy_api($method, $paramater) {

        $paramater = ['jsonrpc' => '2.0', 'id' => '0','method' => 'proxy_to_counterpartyd','params'=> ['method' => $method, 'params' => $paramater] ];
        return Counterparty_Reader::read_base($paramater);

    }

    public static function read_api($method, $paramater) {

        $paramater = ['jsonrpc' => '2.0', 'id' => '0','method' => $method,'params'=> $paramater ];
        return Counterparty_Reader::read_base($paramater);

    }

    private static function read_base($paramater) {

        try {

            $monapa_array = $paramater;
            $json =  json_encode($monapa_array);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, config::$COUNTERPARTY_API_URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config::$SETTING_CURLOPT_SSL_VERIFYPEER);

            $response = curl_exec($ch);
            $json_result = json_decode($response);
            curl_close($ch);
            return $json_result->result;

        } catch (Exception $ex) {
            exit("Monaparty apiとの接続に失敗しました。APIサーバーが復旧するまで長い時間がかかる可能性があります。");
        }

    }

}