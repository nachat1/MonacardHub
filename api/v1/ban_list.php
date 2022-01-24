<?php

require_once __DIR__ . '/../api_header.php';
require_once __DIR__ . '/../../classes/card.php';

$card_list_db = Card_Table::select_banned_cards();


// db接続失敗した場合
if($card_list_db == false) {
    echo '{"error":{"message":"Database error."}}';
    exit;
}

// オブジェクト化する
$card_list = new Card_List_For_Api();
foreach($card_list_db as $card) {

    if($card['status'] != "good") {
        $ban_info = new Ban_Info();
        $ban_info->asset = $card['asset'];
        $ban_info->status = $card['status'];
        $ban_info->update_time = $card['update_time'];
        $card_list->add($ban_info);
    }

}

// json形式で出力
$json = json_encode($card_list);
echo $json;

?>

<?php

class Ban_Info {

    public $asset;
    public $status;
    public $update_time;

}

?>