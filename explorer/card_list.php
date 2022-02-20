<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/asset.php';
require_once __DIR__ . '/../classes/utils.php';
require_once __DIR__ . '/../classes/card.php';
require_once __DIR__ . '/../classes/database/card_table.php';
require_once __DIR__ . '/../classes/warning_setting.php';

$cards = Card_Table::select_cards();

$table_html = "";
foreach($cards as $row) {
    $card = new Card();
    $card->load_from_db_row($row);
    $table_html .= '<tr>';
    $table_html .= '<td><a href="/explorer/card_detail.php?asset='.Utils::sanitize($card->get_common_name()) .'">'.Utils::sanitize($card->asset) .'</td>';
    $table_html .= '<td>'.Utils::sanitize($card->card_name) .'</td>';
    $table_html .= '</tr>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>MonacardHub</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Card List</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Asset</th>
                                            <th>Card Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $table_html ?>
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