udemy Laravel 講座

##ダウウンロード方法

git clone
git clone https://github.com/tanihumi/laravel_umarche_02.git

git clone ブランチを指定してダウウンロードする場合
git clone -b ブランチ名 https://github.com/tanihumi/laravel_umarche_02.git

もしくは zip ファイルでダウンロードしてください。

##インストール方法

cd laravel_umarche
composer install
npm install
npm run dev

.env.example をコピーして、.env ファイルを作成

.env ファイルの中の下記をご利用の環境に合わせて変更してください。

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_umarche
DB_USERNAME=umarche
DB_PASSWORD=pass1234

XAMPP/MAMP または他の開発環境で DB を起動した後に

php artisan migrate:fresh --seed

と実行してください。（データベーステーブルとダミーデータが追加されれば OK）

最後に
php artisan key:generate
と入力してキーを生成後、

php artisan serve
で簡易サーバーを立ち上げ、表示確認してください。

##インストール後の実施事項

画像のダミーデータは
public/images フォルダ内に
sample1.jpg ～ sample6.jpg として
保存しています。

php artisan storage:link で
storage フォルダにリンク後、

storage/app/public/products フォルダ内に
保存すると表示されます。
（products フォルダがない場合は作成してください。）

ショップの画像も表示する場合は、
storage/app/public/shops フォルダを作成し
画像を保存してください。

##section7 の補足

決済のテストとして stripe を利用しています。

必要な場合は、.env に stripe の情報を追記してください。

##section8 の補足

メールのテストとして mailtrap を利用しています。

必要な場合は、.env に mailtrap の情報を追記してください。

メール処理に時間がかかるので、キューを使用しています。

必要な場合は php artisan queue:work で

ワーカーを立ち上げて確認してください。
