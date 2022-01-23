<?php

require_once __DIR__ . '/../api_header.php';
require_once __DIR__ . '/../../classes/database/card_table.php';
require_once __DIR__ . '/../../classes/utils.php';
require_once __DIR__ . '/../../classes/card.php';

// キーによって処理を変える
switch(array_keys($_POST)[0]) {

    case 'assets':

        $target = $_POST['assets'];

        // トークンの命名規則に合っていない場合
        if (!preg_match("/^[a-zA-Z0-9\.\-_@!,]+$/", $target)) {
            echo '{"error":{"message":"Inccorect parameters."}}';
            exit;
        }

        $targets = explode(',', $target);
        $card_details_db = Card_Table::select_cards_by_asset_list($targets);
        $card_details_db = array_merge($card_details_db, Card_Table::select_cards_by_asset_longname_list($targets));

        break;

    case 'tag':

        $target = $_POST['tag'];
        $card_details_db = Card_Table::select_cards_by_tag($target);

        break;

    case 'update_time':

        $target = $_POST['update_time'];
        $card_details_db = Card_Table::select_cards_by_updatetime($target);

        break;

    default:
        echo '{"error":{"message":"No parameters."}}';
        exit;

}

// db接続失敗した場合
if($card_details_db === false) {
    echo '{"error":{"message":"Database error."}}';
    exit;
}

// 該当がない場合
if(count($card_details_db) == 0) {
    echo '{"error":{"message":"No matched assets."}}';
    exit;
}

// オブジェクト形式に変換する
$card_details = new Card_Detail_List_For_Api();
foreach($card_details_db as $detail) {
    $card_detail = new Card_Detail_For_Api();
    $card_detail->load_from_db_row($detail);
    $card_detail->sanitize();
    $card_details->add($card_detail);
}

// json形式で出力
$json = json_encode($card_details, JSON_UNESCAPED_UNICODE);
echo $json;

?>