# サービス名 【 mogitate 】

![mogitate画面](readme-products.png)


【 機能一覧 】


/products                       商品一覧ページ

/products/{productId}	        商品詳細ページ

/products/{productId}/update    更新処理ルート

/products/register	            商品登録ページ

/products/{productId}/delete	商品削除ルート



【 環境構築 】



【 リポジトリをクローン 】

```bash
git clone git@github.com:kohsai/mogitate.git
```


【 DockerDesktopアプリを起動する 】

```bash
docker-compose up -d --build
```


【 MySQLデータベースと権限の設定 】


DockerコンテナでMySQLデータベースが自動作成されるよう設定済みです。

作成される内容：

データベース名: laravel_db

ユーザー名: laravel_user

パスワード: laravel_pass

必要な設定は docker-compose.yml に記述済みです。



【 Laravel環境構築 】

```bash
docker-compose exec php bash
```

```bash
composer install
```

【 .env ファイルを作成 】


プロジェクトをクローンした場合、.env ファイルが存在しないため、次の手順で作成します。

.env.example ファイルを .env ファイルとしてコピーします。

```bash
cp .env.example .env
```

.env ファイルを編集し、以下の内容を確認または修正してください。


.envに以下の環境変数を設定します。

```env
DB_CONNECTION=mysql

DB_HOST=mysql

DB_PORT=3306

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass
```


【 アプリケーションキーの作成 】

```bash
php artisan key:generate
```


【 マイグレーションの実行 】

```bash
php artisan migrate
```


【 初期データの登録（シードの実行） 】

```bash
php artisan db:seed
```


注意:
シードの実行により、初期データがデータベースに挿入されます。この操作は必須です。


【 シンボリックリンクの作成（画像表示のため） 】

```bash
php artisan storage:link
```


【 パーミッション設定（重要！） 】

```bash
chmod -R 777 storage bootstrap/cache
```
（※storage/logs, storage/framework/viewsに書き込めないエラーを防ぐため）


【 画像ファイル配置（重要！） 】

・プロジェクト直下の storage/app/public/images/ フォルダに商品画像を手動で配置してください。

・画像ファイルがないと商品一覧に画像が表示されません。

必要なファイル例：

banana.png

strawberry.png

orange.png

watermelon.png

kiwi.png

muscat.png

peach.png

grapes.png

melon.png

pineapple.png

※もしローカルにない場合は、オリジナルのダミー画像を用意するか、パスだけ存在する状態でも動作は可能です。



【 使用技術（実行環境）】


・PHP: 7.4.9

・Laravel Framework: 8.83.29

・MySQL: 8.0.26


【 ER図 】


![ER図](readme-er.png)


【 開発用アクセスURL 】


・Laravelアプリ：http://localhost/products
（※ php artisan serve は不要です。Apache経由で動作します）

・phpMyAdmin：http://localhost:8080
