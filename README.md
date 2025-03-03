# **Customer & Member Admin Management System**  
**カスタマー&メンバー管理システム**  

## **Overview | 概要**  
This is a simple user management system built with **Laravel**. It provides essential features for **admin and member registration, login, and management**, along with email verification.  
これは **Laravel** を使用して構築された **シンプルなユーザー管理システム** です。**管理者と会員の登録・ログイン・管理機能** および **メール認証機能** を備えています。  

## **Features | 主な機能**  
✅ Admin & member **registration/login** (管理者・会員の登録/ログイン)  
✅ Email **verification system** (メール認証システム)  
✅ **Admin dashboard** with user management (管理者ダッシュボード & ユーザー管理)  
✅ **Search, edit, and delete users** (ユーザーの検索・編集・削除)  
✅ **Secure authentication** using Laravel's built-in security features (Laravelのセキュリティ機能を活用した安全な認証)  

## **Tech Stack | 技術スタック**  
- **Framework:** Laravel 11  
- **Database:** MySQL  
- **Frontend:** Blade, Bootstrap  
- **Authentication:** Laravel Breeze (with Email Verification)  
- **Others:** Composer, Git, Node.js & npm  

## **Installation Guide | インストール手順**  

### **1⤵️ Clone the repository | リポジトリをクローン**  
```bash
git clone https://github.com/sagorahmad/customer-member-admin-management.git
cd customer-member-admin-management
```

### **2⤵️ Install dependencies | 依存関係をインストール**  
```bash
composer install
npm install
npm run dev
```

### **3⤵️ Configure environment variables | .envファイルを設定**  
Create a `.env` file based on `.env.example`, and configure database settings.  
`.env.example` を基に `.env` ファイルを作成し、データベースの設定を行ってください。  
```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:your-key-here
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### **4⤵️ Run migrations | データベースをマイグレート**  
```bash
php artisan migrate
```

### **5⤵️ Generate application key | アプリケーションキーを生成**  
```bash
php artisan key:generate
```

### **6⤵️ Start the development server | 開発サーバーを起動**  
```bash
php artisan serve
```
Now, you can access the application at **http://localhost:8000** 🚀  
これで、**http://localhost:8000** でアプリにアクセスできます 🚀  

## **Usage | 使い方**  
- **Admin Panel:** `/admin/login`  
- **Member Login:** `/login`  
- **Email verification is required after registration.**  
  登録後、メール認証が必要です。  

  

