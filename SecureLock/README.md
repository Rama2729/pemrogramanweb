# SecureLock

SecureLock merupakan aplikasi web sederhana berbasis PHP Native dan MySQL yang dirancang sebagai sistem keamanan akses brankas menggunakan metode One Time Password (OTP). Aplikasi ini dikembangkan sebagai implementasi proyek mata kuliah Rekayasa Perangkat Lunak dengan menerapkan konsep analisis sistem, perancangan basis data, Data Flow Diagram (DFD), Entity Relationship Diagram (ERD), serta implementasi Front End dan Back End.

---

## Fitur Utama

- Login dan Logout
- Dashboard
- Manajemen Data User (CRUD)
- Generate One Time Password (OTP)
- Verifikasi OTP
- Pengaturan Sistem
- Access Log
- Database MySQL

---

## Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| PHP Native | Bahasa Pemrograman |
| MySQL | Database |
| HTML5 | Struktur Halaman |
| CSS3 | Tampilan Antarmuka |
| XAMPP | Web Server Lokal |

---

## Struktur Project

```
SecureLock/

│
├── css/
│     style.css
│
├── database/
│     securelock.sql
│
├── koneksi.php
│
├── index.php
│
├── login.php
│
├── cek_login.php
│
├── logout.php
│
├── dashboard.php
│
├── user.php
│
├── tambah_user.php
│
├── edit_user.php
│
├── hapus_user.php
│
├── otp.php
│
├── generate.php
│
├── verifikasi.php
│
├── setting.php
│
├── access_log.php
│
└── README.md
```

---

## Cara Menjalankan Project

### 1. Install XAMPP

Pastikan Apache dan MySQL telah aktif.

---

### 2. Salin Project

Copy folder SecureLock ke dalam folder:

```
C:\xampp\htdocs\
```

---

### 3. Import Database

1. Jalankan phpMyAdmin.

```
http://localhost/phpmyadmin
```

2. Buat database baru.

```
securelock
```

3. Import file:

```
database/securelock.sql
```

---

### 4. Konfigurasi Database

Pastikan file `koneksi.php` menggunakan konfigurasi berikut.

```php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "securelock"
);
```

---

### 5. Jalankan Aplikasi

Buka browser.

```
http://localhost/SecureLock
```

atau

```
http://localhost/SecureLock/index.php
```

---

## Modul Aplikasi

### Login

Melakukan autentikasi pengguna menggunakan username dan password.

---

### Dashboard

Menampilkan ringkasan informasi sistem.

---

### Data User

Implementasi CRUD (Create, Read, Update, Delete) untuk pengelolaan data pengguna.

---

### OTP

Digunakan untuk menghasilkan kode One Time Password serta melakukan proses verifikasi.

---

### Pengaturan

Digunakan untuk mengatur konfigurasi dasar aplikasi seperti nama aplikasi, panjang OTP, dan masa berlaku OTP.

---

### Access Log

Menampilkan riwayat akses pengguna ke dalam sistem beserta waktu akses, perangkat, status akses, dan alamat IP.

---

## Struktur Database

Database terdiri dari empat tabel utama.

- users
- devices
- otp_logs
- access_logs

---

## Alur Sistem

```
Login
   │
   ▼
Dashboard
   │
   ├── Data User
   │      ├── Tambah
   │      ├── Edit
   │      └── Hapus
   │
   ├── OTP
   │      ├── Generate OTP
   │      └── Verifikasi OTP
   │
   ├── Pengaturan
   │
   ├── Access Log
   │
   └── Logout
```

---

## Kebutuhan Sistem

### Software

- Windows 10 / Windows 11
- XAMPP
- PHP 8.x
- MySQL
- Web Browser (Google Chrome atau Microsoft Edge)

---

### Hardware

- Processor Intel Core i3 atau setara
- RAM minimal 4 GB
- Penyimpanan minimal 500 MB

---

## Pengembang

Nama Project

SecureLock

Mata Kuliah

Rekayasa Perangkat Lunak

Platform

Web Application

Bahasa Pemrograman

PHP Native

Database

MySQL

---

## Lisensi

Project ini dibuat untuk keperluan pembelajaran dan tugas mata kuliah Rekayasa Perangkat Lunak.

Seluruh kode dapat dikembangkan kembali sesuai kebutuhan pengguna.