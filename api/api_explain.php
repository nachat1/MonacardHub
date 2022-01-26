<?php

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        About API - MonacardHub
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

                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div>

                                                <h4 class="card-title">カード化トークン名一覧取得</h4>
                                                <p>
                                                    <a href="/api/v1/card_list.php">/api/v1/card_list.php</a>
                                                </p>

                                                <hr />
                                                <h4 class="card-title">カード詳細情報取得(GET)</h4>
                                                <p>
                                                    詳細情報を取得するカードを複数の方法で指定できます。
                                                </p>
                                                <p>
                                                    <a href="/api/v1/card_detail.php?assets=UNAGI,UNAGI.AFTER">/api/v1/card_detail.php?assets=アセット名1,アセット名2,アセット名N...</a>
                                                </p>
                                                <p>
                                                    <a href="/api/v1/card_detail.php?tag=鰻">/api/v1/card_detail.php?tag=タグ名(複数指定できません)</a>
                                                </p>
                                                <p>
                                                    <a href="/api/v1/card_detail.php?update_time=1518063634">/api/v1/card_detail.php?update_time=時間(指定したUnixtime以降に更新されたカード)</a>
                                                </p>
                                                <ul>
                                                    <li>id: 他のサーバーと同一にならない場合があります。</li>
                                                    <li>asset_common_name: 一般的なトークン名(UNAGI, UNAGI.AFTERなど)</li>
                                                    <li>
                                                        asset: Counterblock apiで使う識別子。親トークンならasset_common_nameと同じ、子トークンの場合は「A10770391013707819263」のような文字列
                                                    </li>
                                                    <li>asset_longname: 子トークン名 (親トークンの場合はnull)</li>
                                                    <li>assetgroup: TrueNFTのグループ名 (TrueNFTでない場合はnull)</li>
                                                    <li>card_name: カード名</li>
                                                    <li>owner_name: 登録者名</li>
                                                    <li>
                                                        imgur_url: imgurまたはmonappyの画像URL
                                                    </li>
                                                    <li>add_description: カードの説明</li>
                                                    <li>tw_id: 登録者Twitterの固有ID</li>
                                                    <li>tw_name: 登録者Twitter名</li>
                                                    <li>tag: タグ情報(カンマ区切り)</li>
                                                    <li>cid: IPFSのCID</li>
                                                    <li>ver: "1"または"2"。1は従来のMonacard, 2はMonacard2.0。</li>
                                                    <li>is_good_status: 規約に違反している場合「false」, 問題ない場合は「true」</li>
                                                    <li>regist_time: 情報の登録日。このサーバーが初めてデータを取得した日時のため他のサーバーとは異なります。</li>
                                                    <li>update_time: 情報の更新日。このサーバーがデータを取得した日時のため他のサーバーとは異なります。</li>
                                                </ul>
                                                <hr />
                                                <h4 class="card-title">カード詳細情報取得(POST)</h4>
                                                <p>
                                                    上記の詳細情報取得APIのPOST版です。URLが長くなりすぎるような場合は、ブラウザなどの仕様で取得に失敗するのでこちらをご利用ください。基本的な仕様はGETと同じです。
                                                </p>
                                                <p>
                                                    URL:
                                                    <a href="/api/v1/card_detail_post.php">/api/v1/card_detail_post.php</a>
                                                    <br />
                                                    Parameter名: assets, tag, update_timeの中から選択
                                                    <br />
                                                    Parameter値: GETの仕様と同じ
                                                </p>
                                                <hr />
                                                <h4 class="card-title">カード登録</h4>
                                                <p>
                                                    モナカードの登録はブロックチェーン上で行います。トークンのdescriptionにMonacard2.0仕様を満たした情報を書き込むことで登録が行われます。
                                                    <br />
                                                    画像のIPFSへのアップロードは当サイトのAPIを通して行いCIDを取得してください。このCIDを使ってMonacard2.0仕様のJSONを作成しトークンのdescriptionに書き込んでください。Monacard2.0の詳しい仕様は以下のリンクを参照してください。
                                                </p>
                                                <p>
                                                    <a href="https://card.mona.jp/monacard2">Monacard2.0仕様について</a>
                                                </p>
                                                <hr />

                                                <h4 class="card-title">カード更新</h4>
                                                <p>
                                                    「カード登録」を行った時に、既に登録されていれば更新処理になります。
                                                </p>

                                                <hr />

                                                <h4 class="card-title">IPFSのCID一覧</h4>
                                                <p>
                                                    IPFSのファイルをPINしていただける場合基本的にこののAPIを使ってください。上記の「カード詳細情報取得API」の場合余計な情報も入りますがCIDの項目があるので使えます。
                                                </p>
                                                <p>
                                                    <a href="/api/v1/cid_list.php">/api/cid_list.php</a>
                                                </p>
                                                <p>
                                                    <a href="/api/v1/cid_list.php?update_time=1632619966">/api/v1/cid_list.php?update_time=時間(指定したUnixtime以降に更新されたカードの情報)</a>
                                                </p>
                                                <ul>
                                                    <li>cid: IPFSファイルのCID</li>
                                                    <li>update_time: カードが更新されたunixtime(カードが更新されてもCIDは変更されていない場合があります)</li>
                                                </ul>

                                                <hr />
                                                <h4 class="card-title">BANカードリスト</h4>
                                                <p>
                                                    <a href="/api/v1/ban_list.php">/api/v1/ban_list.php</a>
                                                    <br />
                                                    <ul>
                                                        <li>asset: 他のサーバーと同一にならない場合があります。</li>
                                                        <li>status: BANされた原因</li>
                                                        <li>update_time: カード情報が最後に更新された時刻(unixtime)</li>
                                                    </ul>
                                                </p>
                                                <h4 class="card-title">エラー時</h4>
                                                <p>
                                                    <a href="/api/v1/error_example.php">ここでエラーを実験できます。</a>
                                                    <br />
                                                    全てのAPIのエラーはこの形式で出力されます。
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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