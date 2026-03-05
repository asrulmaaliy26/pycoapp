# Analisis Konsep Role dan Keamanan Proyek Pycoapp

Dokumen ini menjelaskan bagaimana sistem menangani hak akses (role) dan keamanan sesi pada aplikasi **PsychoApps** dan **Simagis**.

## 1. Mekanisme Keamanan Utama

Sistem ini menggunakan PHP Session untuk melacak status login pengguna. Keamanan diperiksa di setiap halaman melalui file koneksi (seperti `koneksiAdm.php`, `koneksiUser.php`, atau `conAdm.php`).

### Pengecekan Akses (Guard Logic)

Setiap file koneksi melakukan pengecekan variabel sesi:

- **Admin**: Memeriksa `$_SESSION['username']` dan `$_SESSION['status']`.
- **User/Mahasiswa**: Memeriksa `$_SESSION['nim']` dan `$_SESSION['status']`.
- **Status Sesi**: Variabel `$_SESSION['status']` harus bernilai **"1"** agar akses diberikan. Jika tidak, pengguna akan diarahkan kembali ke halaman login.

---

## 2. Struktur Role Berdasarkan Level

Aplikasi menggunakan kolom `level` untuk membagi hak akses admin ke sub-modul yang lebih spesifik. Berikut adalah pemetaan level yang ditemukan di `psychoApps/logAllAdm.php`:

| Level | Deskripsi Role                                 | Dashboard Utama                  |
| ----- | ---------------------------------------------- | -------------------------------- |
| **1** | Admin Berita Acara                             | `dashboardBeritaAcaraSempro.php` |
| **2** | User S1 (Mahasiswa)                            | `dashboardUserS1.php`            |
| **4** | Admin Kepegawaian                              | `dashboardAdmKepeg.php`          |
| **5** | Admin BMN (Barang Milik Negara)                | `dashboardAdmBmn.php`            |
| **6** | Tata Persuratan                                | `agendaSuratKeluarAdm.php`       |
| **7** | BAK S1 (Bagian Administrasi Keuangan/Akademik) | `dashboardAdmBakS1.php`          |
| **8** | BAK S2                                         | `dashboardAdmBakS2.php`          |

---

## 3. Status Pengguna

Kolom `status` digunakan untuk menentukan apakah akun tersebut aktif atau tidak:

- **Status "1"**: Akun Aktif (Memberikan akses penuh sesuai role).
- **Status "2"**: Akun Alumni / Non-Aktif (Di beberapa bagian aplikasi, status ini memicu pengalihan ke portal alumni eksternal).

---

## 4. Aliran Login (Authentication Flow)

1. **Input**: Pengguna memasukkan Username/NIM dan Password.
2. **Filter Injection**: Sistem menggunakan fungsi `antiinjection` untuk membersihkan input dari karakter berbahaya.
3. **Password Hashing**: Password diproses menggunakan MD5 (contoh: `md5($password)`).
4. **Query**: Sistem mencari data di tabel yang sesuai (misalnya `dt_all_adm`, `mag_dt_mhssw_pasca`, atau `dt_admin_bak`).
5. **Session Assignment**: Jika data ditemukan, variabel `$_SESSION` diisi dengan data pengguna.
6. **Redirect**: Pengguna diarahkan ke Dashboard yang sesuai dengan `level` atau `status` mereka.

---

## 5. Perbedaan PsychoApps vs Simagis

- **PsychoApps**: Fokus pada manajemen institusi mulai dari Kepegawaian, Keuangan (BAK), hingga Inventaris (BMN).
- **Simagis**: Tampaknya merupakan modul khusus (Sistem Informasi Magang/Skripsi) yang memiliki manajemen admin dan user tersendiri di dalam sub-direktori `simagis/`.

> [!NOTE]
> Sistem ini menggunakan MD5 untuk hashing password. Untuk pengembangan di masa depan, disarankan beralih ke `password_hash()` dan `password_verify()` demi keamanan yang lebih baik.
