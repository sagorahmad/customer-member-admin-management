# Laravel課題プロジェクト

## 概要
このプロジェクトは、Laravelを使用して構築された課題用のウェブアプリケーションです。  
管理者と会員の登録・管理機能、メール認証機能などを実装しています。  

---

## 必要条件
- PHP 8.2以上  
- Composer  
- MySQL  
- Laravel 11  
- Git  
- Node.js & npm  

---

## セットアップ手順 (ローカル環境)

### 1. リポジトリをクローンする

git clone https://toebisu729.backlog.com/git/TECH_TEST_HOSSAIN_01/source_code.git
cd source_code
git checkout feature-TECH_TEST_HOSSAIN_01-3


### 2. 依存関係をインストールする

composer install
npm install
npm run dev


### 3. `.env`ファイルを設定する
以下を参考に`.env`ファイルを作成してください。
env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:RWhSwr1qWT9Q/synanqYQR3or8vpBOJBtWYXroaFBuY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=hossain01_laravel
DB_USERNAME=hossain01
DB_PASSWORD=QS8vAMNzJw@Q6wFsyKYH

MAIL_MAILER=smtp
MAIL_HOST=server97.web-hosting.com
MAIL_PORT=465
MAIL_USERNAME=sagor@rasits.com
MAIL_PASSWORD=sagor44SS..@
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="sagor@rasits.com"
MAIL_FROM_NAME="Laravel"

**注意:** 上記のメール設定でエラーが発生する場合は、別のメールサーバーやアカウントを使用してください。

### 4. アプリケーションキーを生成する

php artisan key:generate


### 5. データベースをマイグレートする

php artisan migrate


### 6. アセットをビルドする

npm run build


### 7. アプリケーションを起動する (ローカル環境のみ)

php artisan serve

> **注:** `php artisan serve` はローカルサーバーでのテストにのみ使用します。本番環境ではウェブサーバー (例: Apache, Nginx) を設定してください。

---

## セットアップ手順 (サーバー環境)

### 1. リポジトリをクローンする

git clone https://toebisu729.backlog.com/git/TECH_TEST_HOSSAIN_01/source_code.git
cd source_code
git checkout feature-TECH_TEST_HOSSAIN_01-3


### 2. 依存関係をインストールする

composer install
npm install
npm run build


### 3. `.env`ファイルを設定する
`.env` ファイルを以下のように設定してください (メール設定も含む):
env
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:RWhSwr1qWT9Q/synanqYQR3or8vpBOJBtWYXroaFBuY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=http://your-production-url

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=hossain01_laravel
DB_USERNAME=hossain01
DB_PASSWORD=QS8vAMNzJw@Q6wFsyKYH

MAIL_MAILER=smtp
MAIL_HOST=server97.web-hosting.com
MAIL_PORT=465
MAIL_USERNAME=sagor@rasits.com
MAIL_PASSWORD=sagor44SS..@
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="sagor@rasits.com"
MAIL_FROM_NAME="Laravel"

**注意:** メール設定が動作しない場合、サーバー管理者にお問い合わせください。

### 4. アプリケーションキーを生成する

php artisan key:generate


### 5. データベースをマイグレートする

php artisan migrate --force


### 6. キャッシュを設定する

php artisan config:cache
php artisan route:cache
php artisan view:cache


### 7. ウェブサーバーの設定 (ApacheまたはNginx)
- ウェブサーバーのルートディレクトリを `public` に設定してください。
- `storage` ディレクトリとそのサブディレクトリに書き込み権限を付与してください。

---

## 機能一覧

### 管理画面
- 管理者登録機能
- 管理者ログイン機能
- 管理者編集・一覧表示機能
- 会員登録・編集機能
- 会員一覧表示・検索・CSV出力機能

### フロント画面
- 会員登録ページ (メール認証付き)
- 会員編集ページ
- ログインページ

---

# Laravel Task Project

## Overview
This project is a Laravel-based web application developed as a task project.  
It includes features such as admin and member registration/management and email verification.

---

## Requirements
- PHP 8.2 or higher  
- Composer  
- MySQL  
- Laravel 11  
- Git  
- Node.js & npm  

---

## Setup Instructions (Local Environment)

### 1. Clone the Repository

git clone https://toebisu729.backlog.com/git/TECH_TEST_HOSSAIN_01/source_code.git
cd source_code
git checkout feature-TECH_TEST_HOSSAIN_01-3


### 2. Install Dependencies

composer install
npm install
npm run dev


### 3. Configure the `.env` File
Create and configure the `.env` file as follows:
env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:RWhSwr1qWT9Q/synanqYQR3or8vpBOJBtWYXroaFBuY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=hossain01_laravel
DB_USERNAME=hossain01
DB_PASSWORD=QS8vAMNzJw@Q6wFsyKYH

MAIL_MAILER=smtp
MAIL_HOST=server97.web-hosting.com
MAIL_PORT=465
MAIL_USERNAME=sagor@rasits.com
MAIL_PASSWORD=sagor44SS..@
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="sagor@rasits.com"
MAIL_FROM_NAME="Laravel"

**Note:** If the above email configuration does not work, consider using a different email server or account.

### 4. Generate the Application Key

php artisan key:generate


### 5. Run Migrations

php artisan migrate


### 6. Build Assets

npm run build


### 7. Start the Application (Local Environment Only)

php artisan serve

> **Note:** `php artisan serve` is for local development only. Use a web server (e.g., Apache, Nginx) for production.

---

## Setup Instructions (Production Server)

### 1. Clone the Repository

git clone https://toebisu729.backlog.com/git/TECH_TEST_HOSSAIN_01/source_code.git
cd source_code
git checkout feature-TECH_TEST_HOSSAIN_01-3


### 2. Install Dependencies

composer install
npm install
npm run build


### 3. Configure the `.env` File
Set up the `.env` file as follows (including email configuration):
env
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:RWhSwr1qWT9Q/synanqYQR3or8vpBOJBtWYXroaFBuY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=http://your-production-url

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=hossain01_laravel
DB_USERNAME=hossain01
DB_PASSWORD=QS8vAMNzJw@Q6wFsyKYH

MAIL_MAILER=smtp
MAIL_HOST=server97.web-hosting.com
MAIL_PORT=465
MAIL_USERNAME=sagor@rasits.com
MAIL_PASSWORD=sagor44SS..@
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="sagor@rasits.com"
MAIL_FROM_NAME="Laravel"

**Note:** If the email settings fail, contact your server administrator for assistance.

### 4. Generate the Application Key

php artisan key:generate


### 5. Run Migrations

php artisan migrate --force


### 6. Set Up Cache

php artisan config:cache
php artisan route:cache
php artisan view:cache


### 7. Configure the Web Server (Apache or Nginx)
- Set the web server's root directory to `public`.
- Ensure the `storage` directory and its subdirectories have write permissions.

---

## Features

### Admin Panel
- Admin Registration
- Admin Login
- Admin Edit and List
- Member Registration and Edit
- Member List, Search, and CSV Export

### Front-End
- Member Registration Page (with Email Verification)
- Member Edit Page
- Login Page

