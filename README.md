# 📚 Website E-Book Sederhana

<img src="public/favicon.ico" alt="Logo" width="512" height="512">

Sebuah aplikasi web sederhana yang dibangun dengan **Laravel** untuk mengelola dan membaca koleksi e-book. Proyek ini tidak menggunakan sistem otentikasi dan fokus pada fungsionalitas CRUD (Create, Read, Update, Delete) untuk buku dan kategori, dengan antarmuka yang bersih menggunakan **Tailwind CSS**.

---

## ## Fitur Utama

-   **Homepage Dinamis**: Menampilkan sampul buku secara acak untuk rekomendasi dan dilengkapi bar pencarian untuk navigasi cepat.
-   **Manajemen Buku (CRUD)**:
    -   **Create**: Menambahkan data buku baru, termasuk judul, penulis, tanggal rilis, sinopsis, konten, jumlah halaman, dan unggah sampul buku.
    -   **Read**: Menampilkan daftar semua buku dengan paginasi.
    -   **Update**: Mengedit data buku yang sudah ada.
    -   **Delete**: Menghapus data buku beserta file sampulnya dari penyimpanan.
-   **Manajemen Kategori (CRUD)**:
    -   Fungsionalitas penuh untuk menambah, melihat, mengedit, dan menghapus kategori buku.
    -   Dikelola dalam satu halaman untuk kemudahan penggunaan.
    -   Validasi untuk mencegah penghapusan kategori yang masih terikat dengan buku.
-   **Relasi Many-to-Many**: Satu buku dapat memiliki lebih dari satu kategori, memberikan fleksibilitas dalam pengorganisasian koleksi.
-   **Sistem Filter & Pencarian Lanjutan**:
    -   Pencarian teks berdasarkan **Judul**, **Penulis**, atau **Penerbit**.
    -   Filter berdasarkan **Tanggal Rilis**.
    -   Filter berdasarkan **Kategori** dengan logika **AND** (hanya menampilkan buku yang memiliki *semua* kategori yang dipilih).
-   **Halaman Baca Buku**: Halaman detail buku menampilkan semua informasi dan konten lengkap buku dalam area yang dapat di-scroll, memungkinkan pengguna untuk membaca langsung di browser.

---

## ## Teknologi yang Digunakan

-   **Backend**: PHP 8.3, Laravel 12
-   **Frontend**: Tailwind CSS, Vanilla JavaScript
-   **Database**: MySQL
-   **Development Environment**: Laragon / XAMPP

---

## ## Struktur Direktori Views
/resources
└── /views
├── /books
│   ├── /categories
│   │   └── index.blade.php
│   ├── /partials
│   │   └── form-fields.blade.php
│   ├── add.blade.php
│   ├── detail.blade.php
│   ├── index.blade.php
│   └── update.blade.php
└── /layouts
│   └── navbar.blade.php
├── homepage.blade.php

---

## ## Instalasi & Setup

1.  **Clone repository**
    ```bash
    git clone [https://github.com/virtusx01/E-book]
    cd [NAMA_FOLDER_PROYEK]
    ```

2.  **Install dependensi**
    ```bash
    composer install
    ```

3.  **Setup file `.env`**
    Salin file `.env.example` menjadi `.env` dan konfigurasikan koneksi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Jalankan migrasi database dan seeder**
    Perintah ini akan membuat semua tabel yang dibutuhkan (`users`, `books`, `categories`, `book_category`, dll).
    ```bash
    php artisan migrate --seed
    atau
    php artisan migrate:fresh --seed
    ```

5.  **Buat symbolic link untuk storage**
    Penting agar file yang diunggah (seperti sampul buku) dapat diakses publik.
    ```bash
    php artisan storage:link
    ```

6.  **Jalankan server development**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.
    
7.  **Build Tailwind**
    Jika tidak ada tampilan maka jalankan
    ```bash
    npm run build
    ```

---

## ## Rute Aplikasi

| Method | URI                               | Name                  | Controller Action                |
| :----- | :-------------------------------- | :-------------------- | :------------------------------- |
| `GET`  | `/`                               | `home`                | `HomeController@index`           |
| `GET`  | `/categories`                     | `categories.index`    | `CategoryController@index`       |
| `POST` | `/categories`                     | `categories.store`    | `CategoryController@store`       |
| `GET`  | `/categories/{category}/edit`     | `categories.edit`     | `CategoryController@edit`        |
| `PUT`  | `/categories/{category}`          | `categories.update`   | `CategoryController@update`      |
| `DEL`  | `/categories/{category}`          | `categories.destroy`  | `CategoryController@destroy`     |
| `GET`  | `/books`                          | `books.index`         | `BookController@index`           |
| `GET`  | `/books/add`                      | `books.add`           | `BookController@addBookForm`     |
| `POST` | `/books/store`                    | `books.store`         | `BookController@storeBook`       |
| `GET`  | `/books/{book}`                   | `books.show`          | `BookController@show`            |
| `GET`  | `/books/{book}/edit`              | `books.edit`          | `BookController@editBook`        |
| `PUT`  | `/books/{book}/update`            | `books.update`        | `BookController@storeBook`       |
| `DEL`  | `/books/{book}`                   | `books.delete`        | `BookController@deleteBook`      |


## ## SEMUA DATA BUKU MERUPAKAN KARANGAN