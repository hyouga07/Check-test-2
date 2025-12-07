# もぎたて

## 環境構築
**Docker ビルド**
1. `git clone https://github.com/hyouga07/Check-test-2.git`
2. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. `cp .env.example .env`
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```

8. シンボリックリンク
``` bash
php artisan storage:link
```

## URL
- 商品一覧ページ: http://localhost/products
- 商品登録ページ: http://localhost/products/register
- phpMyAdmin： http://localhost:8080/

## 使用技術(実行環境)
- PHP 8.x
- Laravel 9.x
- Composer 2.x
- MySQL8.0.26
- Nginx1.21.1

## ER 図
画像だと透過でER図が見えなかったので 作成元の.drawio.pug もファイルに入れています
Draw.io Extension for VSCode を VSCode 内にインストールして確認してください
