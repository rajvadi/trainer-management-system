# 🧑‍🏫 Trainer Management System

## 📌 Project Overview

A Laravel-based web application to manage trainers, their roles & permissions, and track their working time logs. It includes authentication, role-based access control, and a clean UI built with Tailwind CSS.

---

## 🚀 Tech Stack

* **Backend:** Laravel 13
* **Frontend:** Tailwind CSS + Blade
* **Database:** MySQL
* **Authentication:** Laravel Breeze
* **JS Support:** Alpine.js

---

## ⚙️ Installation Guide

### 1. Clone the repository

```bash
git clone <your-repo-url>
cd trainer-management-system
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials.

---

### 4. Run migrations

```bash
php artisan migrate:fresh --seed
```

### 5. Build assets

```bash
npm run build
```

or for development:

```bash
npm run dev
```

---

### 6. Run the project

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

---

## 🧑‍💻 Author

**Raj Vadi**
