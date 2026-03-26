# 🧑‍🏫 Trainer Management System

## 📌 Project Overview

The **Trainer Management System** is a web application built using **Laravel 13** and **Tailwind CSS** to manage trainers, their roles & permissions, and track their working time logs.

This system provides a structured way to:

* Manage trainers
* Control access using roles & permissions
* Track working hours
* View analytics via dashboard

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
php artisan migrate
```

(Optional: if using seeders)

```bash
php artisan migrate:fresh --seed
```

---

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

## 📌 Validation Highlights

* Unique email for trainers
* Phone number validation (Indian format)
* Time log overlap prevention
* Required fields validation using Form Requests

---

## 🎯 Key Implementation Points

* Clean MVC architecture
* Use of Form Requests for validation
* Proper database normalization
* Eloquent relationships
* Computed attributes (worked hours)
* Modular structure
* Reusable UI patterns

---

## 📈 Future Improvements

* Export reports (CSV/PDF)
* Charts for analytics
* Role management for users UI
* API support
* Advanced filtering

---

## 🧑‍💻 Author

**Raj Vadi**
