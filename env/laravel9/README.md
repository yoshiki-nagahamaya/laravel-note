# Laravel9環境

Laravel9の環境を構築します。

- Laravelについては以下を参照
  - <https://epkotsoftware.github.io/training/laravel.html>

## 開発環境

Dockerを使って環境を構築します。  
本リポジトリで使用する場合、自分のユーザーディレクトリ内に [env/laravel9/](./../../env/laravel9/) をコピーしてお使いください。

### 開発環境について

- ソースコードについては2022/02/15時点で「`composer create-project laravel/laravel {ディレクトリ名}`」コマンドで生成したものになります。
  - <https://laravel.com/docs/9.x/installation>
  - 日本語(Laravel8)
    - <https://readouble.com/laravel/8.x/ja/installation.html>
- 「`vendor`」ディレクトリは含まれていないので「`composer install`」が必要です。
- Laravelの「`.env`」ファイルは含まれていないので準備が必要です。
  - 「[`app/.env.dev`](./app/.env.dev)」ファイルを用意したので、コピーしてお使いください。
  - 初期DBは「`laravel`」にしてあります、お好みで変更してください。  
    以下にDBの記載があります。
    - [`docker/db/init.sql`](./docker/db/init.sql)
    - [`app/.env.dev`](./app/.env.dev)
- WEBサーバーは社内の開発では「`Apache（アパッチ）`」が使われることが多いため環境をあわせてあります。
  - 現場により、リクエスト数が多いサービス・DBサーバー等が分かれている環境では「`NGINX(エンジンエックス)`」が採用されることがあります。

### Docker

以下のコマンドを実行します（[docker/docker-compose-dev.yml](./docker/docker-compose-dev.yml) ファイルを指定）。

```bash
docker-compose -f docker/docker-compose-dev.yml up -d
```

#### 使用しているDockerイメージ

- PHP (`php:<version>-apache`)
  - <https://hub.docker.com/_/php?tab=tags>
  - composer (マルチステージビルドで使用しています)
    - <https://hub.docker.com/_/composer?tab=tags>
- MySQL
  - <https://hub.docker.com/_/mysql?tab=tags>
- phpMyAdmin
  - <https://hub.docker.com/r/phpmyadmin/phpmyadmin/tags>

### Laravel

Laravel関連のコマンドはDockerで用意した、WEBサーバー上で行います。

```bash
# ■ Git Bashで入力
# WEBサーバーに入るコマンド
docker exec -it env-laravel9-web bash
```

#### composer install

```bash
# ■ WEBサーバーで入力
# 「composer.json」、「composer.lock」に記載されているパッケージをvendorディレクトリにインストール
#   ※ 時間がかかるので注意。
composer install
```

`composer install` 実行後に「`Exception`」が出ていると失敗しているので  
[app/vendor/](./app/vendor/)ディレクトリを削除して、再実行してみましょう。  
「`successfully`」が出ていれば成功です。

#### Laravel初期設定

```bash
# ■ WEBサーバーで入力
cd /var/www/app
# 「.env」ファイル
## 「.env.dev」ファイルを「.env」にコピー
cp .env.dev .env
## 「.env」ファイルの APP_KEY 生成
php artisan key:generate
# storage ディレクトリに読み取り・書き込み権限を与える（storage内に書き込み（ログ出力時等）に「Permission denied」のエラーが発生する）
chmod -R 777 storage/
```

#### 確認

- WEB ※ ポート番号は [`docker/.env`](./docker/.env) の `PORT_WEB` を参照
  - <http://localhost:80/>
- phpMyAdmin ※ ポート番号は [`docker/.env`](./docker/.env) の `PORT_PHPMYADMIN` を参照
  - <http://localhost:8080>

### SQLクライアント

- `A5:SQL Mk-2`
  - <https://a5m2.mmatsubara.com/>
- 接続情報 ※ [`docker/.env`](./docker/.env) の情報にあわせて設定すること
  - ホスト名: `localhost`  ～  `IP` 参照 (localhost = 127.0.0.1)
  - ユーザーID: `root`
  - パスワード: `root`  ～  `DB_ROOT_PASSWORD` 参照
  - ポート番号: `3306`  ～  `PORT_DB` 参照

### envファイル設定

Laravelの「`.env`」ファイルの設定を確認してください。  
DB設定については「`.env.dev`」に記載していて、それをコピーした「`.env`」にも既に記載されていますが、確認してください。

```ini
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

### データベースの確認

「[`docker/.env`](./docker/.env)」ファイルの`DB_DATABASE`のデータベースが実際に追加されていることを確認してください(`laravel`)。

### 日本設定

#### 言語ファイルダウンロード

「[`resources/lang/`](./app/resources/lang/)」に「`ja`」ディレクトリが生成され4つの言語ファイルが追加されます。  
※ 2022/02 現在、Laravel8向けの言語ファイルしか用意されていません。  
　Laravel8の言語ファイルを使う場合、Laravel9と言語ファイルの格納場所が異なるためご注意ください。  

| Laravel | 言語ディレクトリパス |
| --- | --- |
| Laravel8 | app/resources/lang/ja |
| Laravel9 | app/lang/ja |

```bash
# ■ WEBサーバーで入力
cd /var/www/app
php -r "copy('https://readouble.com/laravel/8.x/ja/install-ja-lang-files.php', 'install-ja-lang.php');"
php -f install-ja-lang.php
php -r "unlink('install-ja-lang.php');"
```

- auth.php言語ファイル <https://readouble.com/laravel/8.x/ja/auth-php.html>
- pagination.php言語ファイル <https://readouble.com/laravel/8.x/ja/pagination-php.html>
- passwords.php言語ファイル <https://readouble.com/laravel/8.x/ja/passwords-php.html>
- validation.php言語ファイル <https://readouble.com/laravel/8.x/ja/validation-php.html>

#### app.php

| Key | Value | 備考 |
| --- | :---: | --- |
| timezone | `Asia/Tokyo` | デフォルト: `UTC` |
| locale  | `ja` | デフォルト: `en` |
| fallback_locale' | `en` | デフォルト: `en`<br>locale の言語が見つからない場合に適用する言語<br>デフォルトの`en`を指定するのが良い |
| faker_locale | `ja_JP` | デフォルト: `en_US` |

### パッケージ

#### Laravel Debugbar

Laravelで作成した画面の下にデバッグバーが表示され、様々な情報が見れるようになります。

- GitHub
  - <https://github.com/barryvdh/laravel-debugbar>
  - Release
    - <https://github.com/barryvdh/laravel-debugbar/releases>

```bash
# ■ WEBサーバーで入力
cd /var/www/app
# composer.json にパッケージを追加し、インストールする。 「--dev」をつけることで開発環境のみに適用。
composer require --dev barryvdh/laravel-debugbar
# config/debugbar.php を追加。
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

#### その他

以下が参考になりそうです。

- Laravelで便利なおすすめComposerパッケージ一覧
  - <https://qiita.com/minato-naka/items/4b47a22ba07b2604ce02>

### スターターキット

#### Laravel UI

非推奨の「`Laravel UI`」を使用したログイン機能の追加方法です。  
「`Laravel Breeze`」が推奨されており、Controller等の参考にもなるため「`Laravel Breeze`」を推奨します。

- GitHub
  - <https://github.com/laravel/ui>

```bash
# ■ WEBサーバーで入力
composer require laravel/ui
# vue ・ react も選択可能だがLaravel学習は bootstrap が良い。
php artisan ui bootstrap
php artisan ui bootstrap --auth
# 公式の npm install がうまくいかなかったため acorn を指定して実行。
npm install acorn --dev
npm run dev
# migrateを実行し、ログイン機能に使用するテーブルを追加。
php artisan migrate
```

#### Laravel Breeze

「`Laravel Breeze`」を使用したログイン機能の追加方法です。  

- GitHub
  - <https://github.com/laravel/breeze>
  - 「npm install」はエラーになるため、以下で解決
    - <https://laracasts.com/discuss/channels/javascript/tailwindlaravel-mix-dependency-tree-error?page=1&replyId=752990>

```bash
# ■ WEBサーバーで入力
# composer の require-dev に laravel/breeze を追加しインストール。
composer require laravel/breeze --dev
# Laravel Breezeインストール(Vueを選択、reactも選択可能)
php artisan breeze:install vue
# 公式の npm install がうまくいかなかったため acorn を指定して実行。
npm install acorn --dev
npm run dev
# migrateを実行し、ログイン機能に使用するテーブルを追加。
php artisan migrate
```

- ログイン画面の確認 ※ ポート番号は [`docker/.env`](./docker/.env) の PORT_WEB を参照
  - <http://localhost:80/login>
