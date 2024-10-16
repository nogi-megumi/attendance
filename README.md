# 勤怠管理システム
本アプリケーションは勤務開始時間、勤務終了時間、休憩開始時間、休憩終了時間を記録し、それらに基づいて1日の労働時間を計算する勤怠管理システムです。

## 作成した目的
本システムは従業員の勤務状況を把握し、人事評価に役立てることを目的として作成しました。

## アプリケーションURL（デプロイのURL）

## 機能一覧
  - 会員登録機能、会員登録時のメール認証機能
  - ログイン機能、ログアウト機能
  - 勤務開始時間、勤務終了時間の記録
  - 休憩開始時間、休憩終了時間の記録
  - 日付別勤怠情報の取得機能
  - ユーザー一覧およびユーザー別勤怠情報の取得機能
  
## 使用技術（実行環境）
  - php 7.4.9
  - mysql 8.0.26
  - Laravel8.83.27
  - AMAZON AWS
  
## テーブル設計
![スクリーンショット 2024-10-14 104836](https://github.com/user-attachments/assets/52291c95-040b-4fab-8c43-fba171d993ed)

  
## ER図
![attendance-er drawio](https://github.com/user-attachments/assets/a1a32f40-6b36-4666-a4fe-ebb28a5573e5)

  
## 環境構築
    Dockerビルド
    1. git clone “githubの作成したリポジトリのSSHを指定する”
    2. DockerDesktopアプリを立ち上げる
    3. docker compose up -d —build
  
    laravel環境構築  
    1. docker-compose exec php bash
    2. composer install
    3. .env.exampleファイルから.envを作成し、環境変数を変更
    4. .envに以下の環境変数を追加
    
    　DB_CONNECTION=mysql
    　DB_HOST=mysql
    　DB_PORT=3306
    　DB_DATABASE=laravel_db
    　DB_USERNAME=laravel_user
    　DB_PASSWORD=laravel_pass
  
    　MAIL_HOST=sandbox.smtp.mailtrap.io
    　MAIL_PORT=2525
    　       
    5. アプリケーションキーの作成
    php artisan key:generate
    
    6. マイグレーションの実行
    php artisan migrate
    
    7. シーディングの実行
    php artisan db:seed
