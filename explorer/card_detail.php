<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/counterparty.php';
require_once __DIR__ . '/../classes/asset.php';
require_once __DIR__ . '/../classes/utils.php';

//$asset_name = $_GET['asset'];
//if(!isset($asset_name)) {
//    exit('Invalid parameter.');
//}

$asset = new Asset_Info();
$asset_info_array = Counterparty::get_asset_info('HINAICHI.2022');
$asset->load_from_object($asset_info_array);
$asset->load_description();

$image_url = "https://ipfs.io/ipfs/" . Utils::sanitize($asset->parsed_description->cid);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        Card Details - MonacardHub by <?php Utils::sanitized_echo(config::$ADMINISTRATOR_NAME) ?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <div class="card-list-box">
        <?php
        echo '<div class="panel panel-warning panel-card" style="margin-bottom:30px">';
        echo '  <!--<div class="panel-heading card-heading">'.Utils::sanitized_echo($asset->parsed_description->card_name).'</div>-->';
        echo '  <div class="panel-body card-body-bg"><a href="'.$image_url.'"><img class="img-responsive" src="'.$image_url.'" /></a></div>';
        echo '</div>';
        ?>
    </div>

    <div class="card">
        <div class="card-content">
            <form>

                <div class="form-group">
                    <label>カード名</label>
                    <input type="text" class="form-control card_detail" readonly="readonly" value="<?php Utils::sanitized_echo($asset->parsed_description->card_name) ?>" />
                </div>

                <div class="form-group">
                    <label>発行者の名前</label>
                    <input type="text" class="form-control card_detail" readonly="readonly" value="<?php Utils::sanitized_echo($asset->parsed_description->owner_name) ?>" />
                </div>

                <div class="form-group">
                    <label>カードの説明</label>
                    <textarea class="form-control card_detail" rows="5" readonly="readonly">
                        <?php Utils::sanitized_echo($asset->parsed_description->add_description) ?>
                    </textarea>
                </div>

                <div class="form-group">
                    <label>IPFS CID</label>
                    <a style="overflow-wrap: break-word; font-size:0.8em" class="break has_underline form-control" href="https://ipfs.io/ipfs/<?php Utils::sanitized_echo($asset->parsed_description->cid) ?>" target="_blank">
                        <?php Utils::sanitized_echo($asset->parsed_description->cid) ?>
                    </a>
                </div>

                <div class="form-group">
                    <label>タグ</label>
                    <br />
                    <?php echo $asset->parsed_description->tag ?>
                </div>

                <div class="form-group">
                    <label>Version</label>
                    <input type="text" class="form-control card_detail" readonly="readonly" value="<?php Utils::sanitized_echo($asset->parsed_description->ver) ?>" />
                </div>

                <div class="form-group">
                    <label>JSON</label>
                    <textarea class="form-control card_detail" rows="10" readonly="readonly">
                        <?php Utils::sanitized_echo($asset->description) ?>
                    </textarea>
                </div>

            </form>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

