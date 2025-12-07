Docker ビルド
・git clone https://github.com/hyouga07/Check-test-2.git
・docker-compose up -d --build

Laravel 環境構築
・docker-compose exec php bash
・composer install
・cp .env.example .env、開発変数を適宜変更
・php artisan key:generate
・php artisan migrate
・php artisan db:seed
・php artisan storage:link

URL
・商品一覧ページ: http://localhost/products
・商品登録ページ: http://localhost/products/register
・phpMyAdmin： http://localhost:8080/

使用技術(実行環境)
・PHP 8.x
・Laravel 9.x
・Composer 2.x
・MySQL8.0.26
・Nginx1.21.1

ER 図
画像だと透過でER図が見えなかったので 作成元の.drawio.pug もファイルに入れています
Draw.io Extension for VSCode を VSCode 内にインストールして確認してください
