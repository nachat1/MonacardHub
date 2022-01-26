<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/counterparty.php';
require_once __DIR__ . '/../classes/asset.php';
require_once __DIR__ . '/../classes/utils.php';
require_once __DIR__ . '/../classes/card.php';
require_once __DIR__ . '/../classes/database/card_table.php';
require_once __DIR__ . '/../classes/warning_setting.php';

$asset_name = $_GET['asset'];
if(!isset($asset_name)) {
    exit('Invalid parameter.');
}

$card = new Card();
$card->load_from_database($asset_name);

$card_table_html .= '<tr><td style="width:30%">Card Name</td><td>'.Utils::sanitize($card->card_name) .'</td></tr>';
$card_table_html .= '<tr><td>Issuer Name</td><td>'.Utils::sanitize($card->owner_name) .'</td></tr>';
$card_table_html .= '<tr><td>Description</td><td>'.Utils::sanitize($card->description) .'</td></tr>';
$card_table_html .= '<tr><td>Tag</td><td>'.Utils::sanitize($card->tag) .'</td></tr>';
$card_table_html .= '<tr><td>IPFS CID</td><td>'.Utils::sanitize($card->get_filtered_cid()) .'</td></tr>';
$card_table_html .= '<tr><td>Version</td><td>'.Utils::sanitize($card->ver) .'</td></tr>';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        <?php Utils::sanitized_echo($card->card_name) ?> - MonacardHub
    </title>
    <?php require_once __DIR__ . '/../template/include_header.php' ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once __DIR__ . '/../template/sidebar.php' ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once __DIR__ . '/../template/topbar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Card Detail</h1>
                    </div>

                    <div style="width:100%; text-align: center;">
                        <a href="<?php Utils::sanitized_echo($card->get_filtered_url_ipfs()) ?>">
                            <img class="card-body-bg" src="<?php Utils::sanitized_echo($card->get_filtered_url_ipfs()) ?>" />
                        </a>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">管理者設定</h6>
                        </div>
                        <div class="card-body">
                            <form class="form-inline" action="/admin/change_card_status.php" method="post">
                                <button type="submit" name="status" value="copyright" class="btn btn-outline-warning">著作権侵害</button>
                                <button type="submit" name="status" value="publicity" class="btn btn-outline-warning">肖像権侵害</button>
                                <button type="submit" name="status" value="displeasure" class="btn btn-outline-warning">不快を与える</button>
                                <button type="submit" name="status" value="too_h" class="btn btn-outline-warning">卑猥すぎる</button>
                                <button type="submit" name="status" value="ban" class="btn btn-outline-warning">禁止ユーザー</button>
                                <button type="submit" name="status" value="delete" class="btn btn-outline-danger">削除(フラグ)</button>
                                <button type="submit" name="status" value="good" class="btn btn-outline-info">問題なし</button>
                                <div class="form-group" style="display:none">
                                    <input type="text" class="form-control" readonly="readonly" name="asset" id="asset" value="<?php Utils::sanitized_echo($card->asset) ?>" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Card Infomation</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <?php echo $card_table_html ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once __DIR__ . '/../template/footer.php' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php require_once __DIR__ . '/../template/include_footer.php' ?>

</body>

</html>