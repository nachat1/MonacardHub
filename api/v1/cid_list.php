<?php

require_once __DIR__ . '/../api_header.php';
require_once __DIR__ . '/../../classes/card.php';

$target = $_GET['update_time'];
if(empty($target)) {
    $target = 0;
}
$card_list_db = Card_Table::select_cards_by_updatetime($target);


// db接続失敗した場合
if($card_list_db == false) {
    echo '{"error":{"message":"Database error."}}';
    exit;
}

// オブジェクト化する
$card_list = new Card_List_For_Api();
foreach($card_list_db as $card) {

    if(!empty($card['cid']) && $card['status'] == "good") {
        $cid_info = new Cid_Info();
        $cid_info->cid = $card['cid'];
        $cid_info->update_time = $card['update_time'];
        $card_list->add($cid_info);
    }

}

// json形式で出力
$json = json_encode($card_list);
echo $json;

?>

<?php

class Cid_Info {

    public $cid;
    public $update_time;

}


?>