
<img src="public/images/logo-light.png">

**ARCH** adalah sebuah platform ruang digital yang dirancang untuk menemani proses menulis, merenung, dan merawat diri. Aplikasi ini memungkinkan pengguna untuk membuat jurnal sebagai kenangan yang dapat diingat. Harapannya di masa depan, ARCH dapat digunakan untuk membantu orang-orang dalam mengingat momen-momen berharga secara personal kepada orang lain.

Proyek ini dikembangkan sebagai **Final Project** untuk mata kuliah **Pemrograman Aplikasi Web**.

---

## 👥 Kelompok 9

  * **[Cheren Agatha Davona Syallom](https://instagram.com/cherenads)**
  * **[Keihan Radja Vasya](https://instagram.com/khnharv)**
  * **[Syatira Zulaikanisa](https://instagram.com/syatiraaz)**

## 🛠️ Teknologi yang Digunakan (Tech Stack)

* **Framework Backend:** [Laravel 11](https://laravel.com) (PHP 8.2+)
* **Frontend Tooling:** [Vite](https://vitejs.dev)
* **Styling:** [Tailwind CSS](https://tailwindcss.com)
* **Templating Engine:** Blade
* **Database:** MySQL (via XAMPP)
* **Authentication:** Laravel Breeze

---

## 📋 Prasyarat (Prerequisites)

Sebelum menginstal proyek ini, pastikan komputer Anda telah terinstal:

1.  **XAMPP** (Pastikan Apache & MySQL berjalan).
2.  **PHP** (Minimal versi 8.2).
3.  **Composer** (Package manager untuk PHP).
4.  **Node.js & NPM** (Untuk compile aset frontend).
5.  **Git** (Untuk clone repository).

---

## ⚙️ Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah berikut secara berurutan di terminal (Command Prompt / Git Bash / PowerShell):

### 1. Clone Repository
Unduh kode sumber proyek ke komputer lokal Anda.
```bash
git clone [https://github.com/KeihanRV/PAW_final_project.git](https://github.com/KeihanRV/PAW_final_project.git)
cd PAW_final_project
````

### 2\. Install Dependensi

Install library PHP dan JavaScript yang dibutuhkan.

**Backend (Laravel):**

```bash
composer install
```

**Frontend (Node modules):**

```bash
npm install
```

### 3\. Konfigurasi Environment (.env)

Duplikat file contoh konfigurasi `.env.example` menjadi `.env`.

```bash
cp .env.example .env
```

*(Untuk pengguna Windows Command Prompt: `copy .env.example .env`)*

### 4\. Generate App Key

Buat kunci enkripsi aplikasi.

```bash
php artisan key:generate
```

-----

## 🗄️ Setup Database

1.  Buka **XAMPP Control Panel**, nyalakan **Apache** dan **MySQL**.
2.  Buka browser dan akses [http://localhost/phpmyadmin](https://www.google.com/search?q=http://localhost/phpmyadmin).
3.  Buat database baru dengan nama: **`paw_project`** (atau sesuai keinginan Anda).
4.  Buka file **`.env`** di teks editor, cari dan sesuaikan konfigurasi database:

<!-- end list -->

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paw_project
DB_USERNAME=root
DB_PASSWORD=
```

### 5\. Migrasi Database

Jalankan perintah ini untuk membuat tabel-tabel yang diperlukan (Users, Postcards, dll):

```bash
php artisan migrate
```

### 6\. Setup Storage

Agar gambar profil dan gambar postcard bisa muncul, Anda wajib membuat *symbolic link*:

```bash
php artisan storage:link
```

-----

## 🚀 Cara Menjalankan Aplikasi

Anda memerlukan **dua terminal** yang berjalan bersamaan.

**Terminal 1 (Menjalankan Server Laravel):**

```bash
php artisan serve
```

**Terminal 2 (Menjalankan Vite - Frontend):**

```bash
npm run dev
```

Setelah keduanya berjalan, buka browser dan akses:
👉 **http://127.0.0.1:8000**

-----

## ⚠️ Konfigurasi Khusus & Troubleshooting

### 1\. Mengizinkan Upload Gambar Besar (\>2MB)

Aplikasi ini dikonfigurasi untuk menerima upload gambar hingga **40MB**. Agar fitur ini berjalan di XAMPP/Apache, Anda perlu memastikan konfigurasi server sudah benar.

**Cek file `public/.htaccess`:**
Pastikan kode berikut ada di baris paling bawah file tersebut:

```apache
php_value upload_max_filesize 50M
php_value post_max_size 50M
php_value memory_limit 256M
```

*Catatan: Jika Anda hanya menggunakan `php artisan serve` tanpa Apache/XAMPP, Anda mungkin perlu mengedit file `php.ini` secara manual.*

### 2\. Gambar Tidak Muncul (Broken Image)

Jika gambar yang diupload tidak muncul:

1.  Hapus folder `public/storage`.
2.  Jalankan ulang perintah: `php artisan storage:link`.

-----

# Selamat menggunakan!
