# App Inventaris Barang

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/Hxcus-Livers/app_inventaris_barang/blob/main/LICENSE)

## 📋 Tentang Aplikasi

App Inventaris Barang adalah aplikasi manajemen inventaris berbasis web yang dirancang untuk memudahkan pengelolaan barang di perusahaan atau organisasi. Aplikasi ini memungkinkan pengguna untuk melacak, mengelola, dan memantau pergerakan barang dengan efisien.

## ✨ Fitur Utama

- **Manajemen Barang**: Tambah, edit, hapus, dan lihat data barang
- **Kategori Barang**: Pengelompokan barang berdasarkan kategori
- **Pencatatan Transaksi**: Rekam pemasukan dan pengeluaran barang
- **Laporan Stok**: Pantau stok barang secara real-time
- **Dashboard**: Visualisasi data inventaris
- **Manajemen Pengguna**: Pengaturan akses pengguna dengan berbagai level

## 🔧 Teknologi

- **Backend**: PHP/Laravel
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Database**: MySQL
- **Authentication**: Laravel Authentication

## 📦 Persyaratan Sistem

- PHP >= 8.0
- Composer
- MySQL/MariaDB
- Web Server (Apache/Nginx)
- Node.js dan NPM untuk pengembangan frontend

## 🚀 Cara Instalasi

1. **Clone repositori**
   ```bash
   git clone https://github.com/Hxcus-Livers/app_inventaris_barang.git
   cd app_inventaris_barang
   ```

2. **Instal dependensi PHP**
   ```bash
   composer install
   ```

3. **Instal dependensi JavaScript**
   ```bash
   npm install
   npm run dev
   ```

4. **Setup konfigurasi**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Konfigurasi database**
   - Edit file `.env` dan sesuaikan pengaturan database:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventaris_barang
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Migrasi dan seeding database**
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```
   Aplikasi akan berjalan di `http://localhost:8000`

## 🔐 Cara Penggunaan

1. **Login ke aplikasi**
   - Username: admin@example.com
   - Password: password

2. **Mengelola Barang**
   - Navigasi ke menu "Barang"
   - Tambah, edit, atau hapus barang sesuai kebutuhan

3. **Membuat Transaksi**
   - Navigasi ke menu "Transaksi"
   - Pilih jenis transaksi (masuk/keluar)
   - Isi detail transaksi dan simpan

4. **Melihat Laporan**
   - Navigasi ke menu "Laporan"
   - Pilih jenis laporan yang diinginkan
   - Filter berdasarkan periode waktu jika diperlukan

## 🤝 Kontribusi

Kami sangat menghargai kontribusi Anda untuk pengembangan aplikasi ini. Silakan ikuti langkah-langkah berikut:

1. Fork repositori ini
2. Buat branch fitur baru (`git checkout -b feature/amazing-feature`)
3. Commit perubahan Anda (`git commit -m 'Add some amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buat Pull Request

## 📝 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

## 📞 Kontak

Hxcus-Livers - [GitHub Profile](https://github.com/Hxcus-Livers)

Link Proyek: [https://github.com/Hxcus-Livers/app_inventaris_barang](https://github.com/Hxcus-Livers/app_inventaris_barang)
