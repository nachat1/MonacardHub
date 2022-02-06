# MonacardHub

## 機能
Monacard explorer, api etc.

## 推奨環境
PHP7.4, MySQL5.7  

## プロジェクトの目的
card.mona.jpがなくなっても大丈夫なようにするためのプロジェクトです。OSSとしてmonacardを表示したりAPIを提供するサイトになります。  
card.mona.jpにあるようにログイン機能やTwitter連携機能などのあったら便利だけどなくても何とかなる機能は対象外です。保有カード表示機能もありません。  
必要な機能だけがシンプルにまとまったサイトを目指します。

## 初期設定
1. このサイトのコードをPHPの動いているサーバーに設置  
2. /config/config.php_の内容を設定し、config.phpにリネームします  
3. SSLを設定しない場合は /.htaccess を削除してください
4. /admin/script_download_monacard1_metadata.phpを実行するとチェーンから取得した7zファイルが/data下に保存されます。これを解凍して生成されたjsonファイルを/data下に配置します  
5. /admin/script_make_tables.phpを実行しMySQLにテーブルが作成されたことを確認します
6. /admin/script_insert_monacard1.phpを実行しMonacard1.0のにデータがテーブルに挿入されたことを確認します
7. /admin/script_insert_monacard2.phpを実行しMonacard2.0のにデータがテーブルに挿入されたことを確認します
8. monacard収集用の/cron/cron_read_new_monacard.phpを5分以下(可能であれば2分)の定周期で実行するように設定します
9. BANカードリスト同期用の/cron/cron_sync_ban_card_list.phpを5分の定周期で実行するように設定します  
10. 画像ダウンロード用の/cron/cron_download_images.phpを5分の定周期で実行するように設定します
11. /adminのスクリプトをユーザーからアクセスできないようにします。/admin/.htaccessの'AuthUserFile'のパスを設定します。次に.htpasswdを作成補助するサイトなどを使って生成した文字列を貼り付けます

## サイトの仕組み
このサイトは定期的にmonacardを収集しMySQLに格納します。  
サイトのカード表示機能やAPIにアクセスがあるとMySQLに登録されたモナカードのデータを引っ張ってきて表示します。
