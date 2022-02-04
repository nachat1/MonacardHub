<?php

echo("Start to download images.<br>");

require_once __DIR__ . '/../config/config.php';

if(Config::$URL_SHARE_IMAGE_URL == "") {
    exit("Settings not to download");
}

$json = file_get_contents("https://card.mona.jp/api/cid_list");
if ($json === false) {
    exit("Faid to connect API.");
}
$json = json_decode($json, true)["list"];

$cid_list = [];
foreach($json as $row) {
    $cid_list[] = $row["cid"];
}
$cid_list = array_reverse($cid_list);

// すでにある画像一覧を取得する
$img_name_list = glob('./../img/*');
$img_name_list = str_replace("./../img/", "", $img_name_list);

// 画像をダウンロードする
$index = 0;
foreach($cid_list as $cid) {

    if($index >= 300) {break;}

    if(!in_array($cid, $img_name_list)) {
        $img = file_get_contents(Config::$URL_SHARE_IMAGE_URL . $cid);
        file_put_contents('./../img/' . $cid, $img);
        echo $cid . "<br>";
    } else {
        echo "skip: " . $cid . "<br>";
        continue;
    }

    $index++;

}

echo("download successfully.");

?>