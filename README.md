<p align="center"> 
  <img width="1000" alt="logo Osingguide" src="https://github.com/user-attachments/assets/b6e6d528-3be8-4d41-8880-65cecc0c5005">
</p>

# By   : Rio Adjie Wiguna
<br>

#  💻 Tentang Web
Osing Guide merupakan platform untuk memesan guide di kota Banyuwangi

## 📸 Gambaran Umum 

<p align="center"><img alt="gambaran umum" src="#"></p><br>

Terdapat 3 role dalam web ini dengan hak akses masing-masing sebagai berikut:
1. Admin
2. Guide
3. Customer

<br>

# 📃 Cara Install Aplikasi dengan Framework Laravel

## ▶️ Spesifikasi Laravel

- PHP ^10.x.x
- PHP Composer
- Database MySQL
- Sweet Allert

## ▶️ Instalasi Aplikasi

1. Clone atau download source code di Github
   - Melalui Terminal, clone repository `git clone https://github.com/MKI-PUDAM-BANYUWANGI/cekmeter-PUDAM.git`
   - Jika tidak menggunakan terminal dapat **Download Zip** dan _extract_ ke direktori web server (example: xampp/htdocs)
2. `cd cekmeter-PUDAM`
3. `composer install`
4. `cp .env.example .env`
   - Jika tidak menggunakan GIT,  rename file `.env.example` ke `.env`
5. Dari terminal `php artisan key:generate`
6. Create **database from mysql** untuk aplikasi web ini
7. **Setting database** dari file `.env`
8. `php artisan migrate`
9. `php artisan db:seed`
10. Install Sweet Allert agar dapat digunakan dengan ketik di terminal `composer require realrashid/sweet-alert`
10. Jalankan `php artisan serve` untuk memulai web
11. Instalasi Selesai
<br>

# 📲 Fitur
1. **Landing Page**
2. **Login dan Register**
3. **Dashboard Masing-masing Pengguna**
4. **Fitur untuk Admin**
5. **Fitur untuk Guide**
6. **Fitur untuk Customer**

   
