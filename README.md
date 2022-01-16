# MonacardHub
Monacard explorer, api etc.
MIT License.
PHP7.2, MySQL5.7

今のところはほぼ動きません。環境設定すらほぼできません。

[目的]
card.mona.jpがなくなっても大丈夫なようにするためのプロジェクトです。OSSとしてmonacardを表示したりAPIを提供するサイトになります。
card.mona.jpにあるようにログイン機能やTwitter連携機能などのあったら便利だけどなくても何とかなる機能は対象外です。保有カード表示機能もありません。

[初期設定]
このサイトを使うための準備
1. このサイトのコードをPHPの動いているサーバーに設置
2. /config/config.phpの内容を設定
3. /admin/script_download_monacard1_metadata.phpを実行してチェーンからダウンロードした.jsonファイルを/data下に配置
4. /admin/script_make_tables.phpを実行しMySQLのテーブルを作成
5. monacard収集用のcronを設定

[動き]
このサイトは定期的にmonacardを収集しMySQLに格納します。サイトのカード表示機能やAPIにアクセスがあるとMySQLに登録されたモナカードのデータを引っ張てきて表示します。