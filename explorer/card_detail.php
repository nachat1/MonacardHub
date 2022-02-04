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

$asset = new Asset();
$asset->load_from_api($asset_name);

$card = new Card();
$card->load_from_database($asset->asset);

$card_table_html .= '<tr><td style="width:30%">Card Name</td><td>'.Utils::sanitize($card->card_name) .'</td></tr>';
$card_table_html .= '<tr><td>Issuer Name</td><td>'.Utils::sanitize($card->owner_name) .'</td></tr>';
$card_table_html .= '<tr><td>Description</td><td>'.Utils::sanitize($card->description) .'</td></tr>';
$card_table_html .= '<tr><td>Tag</td><td>'.Utils::sanitize($card->tag) .'</td></tr>';
$card_table_html .= '<tr><td>IPFS CID</td><td>'.Utils::sanitize($card->get_filtered_cid()) .'</td></tr>';
$card_table_html .= '<tr><td>Version</td><td>'.Utils::sanitize($card->ver) .'</td></tr>';
$card_table_html .= '<tr><td>Banned reason</td><td>'.Utils::sanitize($card->status) .'</td></tr>';

$asset_table_html .= '<tr><td style="width:30%">Asset</td><td>'.Utils::sanitize($asset->asset) .'</td></tr>';
$asset_table_html .= '<tr><td>Asset Longname</td><td>'.Utils::sanitize($asset->asset_longname) .'</td></tr>';
$asset_table_html .= '<tr><td>Asset Group</td><td>'.Utils::sanitize($asset->asset_group) .'</td></tr>';
$asset_table_html .= '<tr><td>Total Supply</td><td>'.Utils::sanitize($asset->get_serialized_supply()) .'</td></tr>';
$asset_table_html .= '<tr><td>Owner Address</td><td>'.Utils::sanitize($asset->owner) .'</td></tr>';
$asset_table_html .= '<tr><td>Locked</td><td>'. ($asset->locked ? 'true' : 'false') .'</td></tr>';
$asset_table_html .= '<tr><td>DEX</td><td>'.($asset->listed ? 'true' : 'false') .'</td></tr>';
$asset_table_html .= '<tr><td>Reassignable</td><td>'.($asset->reassignable ? 'true' : 'false') .'</td></tr>';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php Utils::sanitized_echo($card->card_name) ?> - MonacardHub</title>
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
                            <img class="card-body-bg" src="<?php Utils::sanitized_echo($card->get_display_img_url()) ?>" />
                        </a>
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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Asset Infomation</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <?php echo $asset_table_html ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <p><a href="/explorer/select_ban_reason.php?asset=<?php Utils::sanitized_echo($card->asset) ?> " class="btn btn-light btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">管理画面</span>
                </a></p>
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