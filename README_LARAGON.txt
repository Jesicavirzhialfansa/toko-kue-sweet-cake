SWEET CAKE - CRUD PHP NATIVE + MYSQL + LOGIN ADMIN
====================================================

Project ini dikembangkan dari project praktikum dosen.
Konsep CRUD, database, upload gambar, search/filter, pagination,
login/logout, dan struktur folder utama tetap dipertahankan.
Pengembangan utama: UI/UX premium, dashboard, responsive design,
password show/hide, alert yang lebih rapi, dan navigasi.

A. CARA MEMASANG DI LARAGON
----------------------------
1. Extract folder "toko_kue".
2. Copy folder "toko_kue" ke:
   C:\laragon\www\
3. Pastikan struktur akhirnya:
   C:\laragon\www\toko_kue\index.php
4. Buka Laragon lalu Start All.
5. Buka phpMyAdmin dari Laragon.
6. Buat database dengan nama:
   toko_kue
7. Klik database toko_kue -> Import.
8. Pilih file:
   toko_kue.sql
9. Klik Import/Go.

B. MENJALANKAN WEBSITE
-----------------------
Website:
http://localhost/toko_kue/

Login admin:
http://localhost/toko_kue/auth/login.php

Dashboard admin:
http://localhost/toko_kue/admin/

C. AKUN LOGIN DARI SQL
-----------------------
Username: admin
Password: admin123

Password sudah tersimpan dalam bentuk hash di database.
Tidak perlu menjalankan buat_admin.php jika data admin dari SQL sudah berhasil
masuk. Jika menjalankan buat_admin.php berulang kali, username admin bisa
terduplikasi dan ditolak karena kolom username bersifat UNIQUE.

D. JIKA DATABASE GAGAL TERHUBUNG
---------------------------------
Buka:
config/database.php

Default project:
host     = localhost
user     = root
password = kosong
database = toko_kue

Jika instalasi Laragon kamu menggunakan password MySQL, ubah variabel
$password sesuai password MySQL kamu.

E. ALUR TUGAS DOSEN
--------------------
1. index.php          -> halaman utama / landing page
2. produk.php         -> katalog produk
3. detail.php         -> detail satu produk
4. auth/login.php     -> login admin
5. admin/index.php    -> dashboard admin
6. admin/produk.php   -> READ + search + filter + pagination
7. admin/tambah.php   -> form CREATE
8. admin/proses_produk.php -> proses CREATE + UPDATE + upload gambar
9. admin/edit.php     -> form UPDATE
10. admin/hapus.php   -> DELETE + hapus file gambar
11. admin/logout.php  -> logout / destroy session
12. toko_kue.sql      -> database admin + produk

F. CATATAN PENTING
-------------------
- Jangan rename folder toko_kue kalau ingin menggunakan URL di atas.
- Folder uploads/produk wajib ada agar upload gambar berjalan.
- File gambar contoh sudah disertakan.
- PHP sudah dicek syntax-nya tanpa error pada paket ini.
- Password admin dari SQL sudah diverifikasi cocok dengan admin123.
