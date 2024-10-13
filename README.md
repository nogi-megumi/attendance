勤怠管理システム
- 作成した目的：人事評価のため
- アプリケーションURL（デプロイのURL）
- 機能一覧
  　会員登録、メール認証機能、ログイン機能、ログアウト機能
  　勤務開始時間・終了時間の記録および休憩開始時間・終了時間の記録、
  　日付別勤怠情報の取得機能、ユーザー一覧およびユーザー別勤怠情報の取得機能
  
- 使用技術（実行環境）
 　php 7.4.9
 　mysql 8.0.26
 　Laravel8.83.27
  
- テーブル設計（画像）スプレッドシートから
  
- ER図（画像）スプレッドシートから
  
- 環境構築
    Dockerビルド
    1 git clone “githubの作成したリポジトリのSSHを指定する”
    2 DockerDesktopアプリを立ち上げる
    3 docker compose up -d —build
  
    laravel環境構築  
    1.docker-compose exec php bash
    2.composer install
    3..env.exampleファイルから.envを作成し、環境変数を変更
    4,.envに以下の環境変数を追加
    
    　DB_CONNECTION=mysql
    　DB_HOST=mysql
    　DB_PORT=3306
    　DB_DATABASE=laravel_db
    　DB_USERNAME=laravel_user
    　DB_PASSWORD=laravel_pass
  
    　MAIL_HOST=sandbox.smtp.mailtrap.io
    　MAIL_PORT=2525
    　MAIL_USERNAME=83618edbf84613
    　MAIL_PASSWORD=98a9bd7ccd61b1
    　MAIL_ENCRYPTION=tls
    　MAIL_FROM_ADDRESS=info@example.com
       
    5. アプリケーションキーの作成
    php artisan key:generate
    
    6. マイグレーションの実行
    php artisan migrate
    
    7. シーディングの実行
    php artisan db:seed
