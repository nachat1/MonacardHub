# MonacardHub

## 機能
Monacard explorer, api etc.

## 環境
PHP7.2, MySQL5.7  
今のところはほぼ動きません。環境設定すらほぼできません。

## プロジェクトの目的
card.mona.jpがなくなっても大丈夫なようにするためのプロジェクトです。OSSとしてmonacardを表示したりAPIを提供するサイトになります。  
card.mona.jpにあるようにログイン機能やTwitter連携機能などのあったら便利だけどなくても何とかなる機能は対象外です。保有カード表示機能もありません。  
必要な機能だけがシンプルにまとまったサイトを目指します。

## 初期設定
1. このサイトのコードをPHPの動いているサーバーに設置  
2. /config/config.php_の内容を設定し、config.phpにリネーム  
3. /admin/script_download_monacard1_metadata.phpを実行してチェーンからダウンロードした.jsonファイルを/data下に配置  
4. /admin/script_make_tables.phpを実行しMySQLのテーブルを作成 
5. /admin/script_insert_monacard1.phpを実行
6. /admin/script_insert_monacard2.phpを実行
7. monacard収集用のcronを設定 
8. BANカードリスト同期用のcronを設定 

## サイトの仕組み
このサイトは定期的にmonacardを収集しMySQLに格納します。  
サイトのカード表示機能やAPIにアクセスがあるとMySQLに登録されたモナカードのデータを引っ張ってきて表示します。
