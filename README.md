# Proyek E-Commerce SI

Ini adalah aplikasi web e-commerce sederhana yang dibangun dari awal menggunakan framework Laravel. Proyek ini mencakup halaman depan (toko) untuk pengguna dan panel admin khusus untuk manajemen konten.

## ✨ Fitur Utama

-   **Autentikasi Pengguna:**

    -   Pendaftaran & Login (halaman dan modal).
    -   Fungsionalitas Logout yang aman.

-   **Sistem Peran (Role-Based Access Control):**

    -   Peran **Admin** dan **User** yang terpisah.
    -   Pengalihan (redirect) otomatis setelah login berdasarkan peran.
    -   Rute dan menu yang dilindungi khusus untuk Admin.

-   **Halaman Depan (Frontend):**

    -   Halaman utama dengan _Hero Section_ dan _Grid Produk_.
    -   Halaman Detail Produk yang dinamis.
    -   Fungsionalitas filter produk berdasarkan Kategori.
    -   Tombol _scroll-to-section_ untuk navigasi halaman.
    -   Navbar custom yang modern dengan _search bar_ dan dropdown.

-   **Panel Admin (Backend):**
    -   Layout _dashboard_ 2 kolom custom dengan _sidebar_.
    -   Kartu statistik dinamis (jumlah produk, pengguna, dll.).
    -   Fitur **CRUD** (Create, Read, Update, Delete) penuh untuk manajemen Produk.
    -   Fungsionalitas _upload_ gambar produk.
    -   Grafik penjualan (_placeholder_).

## 🚀 Teknologi yang Digunakan

-   **Backend:** Laravel, PHP
-   **Frontend:** Tailwind CSS, Alpine.js, Vite
-   **Database:** MySQL

## ⚙️ Cara Menjalankan Proyek Secara Lokal

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Clone repository:**

    ```bash
    git clone [URL_REPOSITORY_ANDA]
    cd [NAMA_FOLDER_PROYEK]
    ```

2.  **Install dependensi PHP:**

    ```bash
    composer install
    ```

3.  **Install dependensi JavaScript:**

    ```bash
    npm install
    ```

4.  **Siapkan file environment:**

    ```bash
    cp .env.example .env
    ```

5.  **Generate application key:**

    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database:**
    Buka file `.env` dan sesuaikan pengaturan database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

7.  **Jalankan Migrasi & Seeder:**
    Perintah ini akan membuat semua tabel dan mengisinya dengan data dummy (user admin, produk, kategori).

    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Buat Symbolic Link:**
    Perintah ini penting agar gambar produk bisa diakses.

    ```bash
    php artisan storage:link
    ```

9.  **Jalankan Server:**
    Buka dua terminal terpisah:

    -   Di terminal pertama, jalankan Vite:
        ```bash
        npm run dev
        ```
    -   Di terminal kedua, jalankan server Laravel:
        ```bash
        php artisan serve
        ```

10. Buka `http://127.0.0.1:8000` di browser Anda.
