# Company Profile Kharisma Tunggal

## Pendahuluan

Ini adalah proyek aplikasi Company Profile kharisma tunggal Berbasis web.Kharisma Tunggal adalah mitra terpercaya bagi peternak ruminansia. Dengan pengalaman bertahun-tahun, Mereka menawarkan beragam produk pakan yang diformulasikan khusus untuk memenuhi kebutuhan nutrisi berbagai jenis ternak ruminansia.  

## Daftar Isi

- [Pendahuluan](#pendahuluan)
- [Daftar Isi](#daftar-isi)
- [Instalasi](#instalasi)
- [Fitur](#fitur)
- [Dokumentasi API](#dokumentasi-api)
- [Kontributor](#kontributor)
- [Lisensi](#lisensi)

## Instalasi

Ikuti langkah-langkah untuk menginstal aplikasi di mesin lokal.

### Prasyarat

Pastikan Anda sudah menginstal hal-hal berikut di komputer:

- PHP >= 8.0
- Composer
- MySQL atau database lain yang didukung
- Git (opsional, untuk kloning repository)

### Langkah Instalasi

1. **Clone Repository**
    ```bash
    git clone https://github.com/TIM-UYE/projek_profile.git
    cd project-profile
    ```

2. **Instal Dependensi**
    ```bash
    composer install
    ```

3. **Konfigurasi File Lingkungan**
    - Salin file `.env.example` dan ubah `.env.example` menjadi `.env`
    - Atur konfigurasi database dan informasi penting lainnya di file `.env`
    ```bash
    php artisan key:generate
    ```

4. **Migrasi dan Seed Database**
    ```bash
    php artisan migrate --seed
    ```

5. **Jalankan Server**
    ```bash
    php artisan serve
    ```

    Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.


## Fitur

- Autentikasi pengguna
- Manajemen artikel
- Manajemen tag artikel
- Manajemen barang
- Manajemen kategori barang
- RESTful API untuk akses data
- Panel Admin
- Manajemen pengguna

## Dokumentasi API

Berikut adalah dokumentasi untuk beberapa endpoint API yang disediakan oleh aplikasi ini.

### Autentikasi

#### Login
- **Endpoint:** `POST /api/login`
- **Deskripsi:** Autentikasi pengguna dan menghasilkan token JWT.
- **Header:**
  - `Content-Type: application/json`
- **Body:**
    ```json
    {
        "email": "user@example.com",
        "password": "password"
    }
    ```
- **Respon Sukses:**
    - **Kode:** 200 OK
    - **Contoh:**
        ```json
        {
            "token": "jwt-token-string"
        }
        ```

#### Registrasi
- **Endpoint:** `POST /api/register`
- **Deskripsi:** Mendaftarkan pengguna baru.
- **Header:**
  - `Content-Type: application/json`
- **Body:**
    ```json
    {
        "name": "Nama Pengguna",
        "email": "user@example.com",
        "password": "password",
        "password_confirmation": "password"
    }
    ```
- **Respon Sukses:**
    - **Kode:** 201 Created
    - **Contoh:**
        ```json
        {
            "user": {
                "id": 1,
                "name": "Nama Pengguna",
                "email": "user@example.com",
                "created_at": "2024-08-27T00:00:00.000000Z",
                "updated_at": "2024-08-27T00:00:00.000000Z"
            },
            "token": "jwt-token-string"
        }
        ```

### Artikel

#### Daftar Artikel
- **Endpoint:** `GET /api/artikel`
- **Deskripsi:** Mengambil daftar semua artikel.
- **Header:**
  - `Authorization: Bearer {token}`
- **Respon Sukses:**
    - **Kode:** 200 OK
    - **Contoh:**
        ```json
        [
            {
                "id": 1,
                "title": "Judul Artikel",
                "body": "Isi artikel...",
                "created_at": "2024-08-27T00:00:00.000000Z",
                "updated_at": "2024-08-27T00:00:00.000000Z"
            },
            {
                "id": 2,
                "title": "Judul Artikel Lain",
                "body": "Isi artikel lain...",
                "created_at": "2024-08-27T00:00:00.000000Z",
                "updated_at": "2024-08-27T00:00:00.000000Z"
            }
        ]
        ```

#### Tambah Artikel
- **Endpoint:** `POST /api/articles`
- **Deskripsi:** Menambahkan artikel baru.
- **Header:**
  - `Authorization: Bearer {token}`
  - `Content-Type: application/json`
- **Body:**
    ```json
    {
        "title": "Judul Baru",
        "body": "Isi dari artikel baru..."
    }
    ```
- **Respon Sukses:**
    - **Kode:** 201 Created
    - **Contoh:**
        ```json
        {
            "id": 3,
            "title": "Judul Baru",
            "body": "Isi dari artikel baru...",
            "created_at": "2024-08-27T00:00:00.000000Z",
            "updated_at": "2024-08-27T00:00:00.000000Z"
        }
        ```


## Kontributor

- M Dien Vito Alivio Hidayat (E41231065) - [GitHub](https://github.com/arallel)
- Dema Adzhani   (E41231272) - [GitHub](https://github.com/dema)
- Nandita Putri Hanifa Jannah (E41231216) - [GitHub](https://github.com/nanditaputrihj)
- Muhammad Yusron Kurniawan (E41231318) - [GitHub](https://github.com/username)
- Abdul Muqid (E41231328) - [GitHub](https://github.com/username)
- Dymas Ersa Ramadhan (E41231177) - [GitHub](https://github.com/username)

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
