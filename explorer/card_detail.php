<?php

$asset_name = $_GET['asset'];
if(!isset($asset_name)) {
//    exit('Set asset name.');
}

var_dump(get_asset_info('UNAGI'));

function get_asset_info($asset_name) {

    $api = "https://monapa.electrum-mona.org/_api";
    //$api = "https://mpchain.info/api/cb";
    //$api = "https://wallet.monaparty.me/_api";

    $monapa_array = ['jsonrpc' => '2.0', 'id' => '0','method' => 'get_assets_info','params'=> ['assetsList' => [$asset_name]] ];
    $jsonstr =  json_encode($monapa_array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonstr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $api);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $res = curl_exec($ch);
    $json = json_decode($res);
    curl_close($ch);
    return $json->result[0];

}


?>