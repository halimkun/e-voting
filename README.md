# e voting ci4

## cara install
untuk menginstall aplikasi ini, pastikan sudah terinstall composer dan php versi 8.0. setelah itu jalankan perintah `composer install` untuk menginstall semua dependency yang dibutuhkan.

> pastikan php yang terintegrasi dengan *command line* adalah php versi 8.0
> anda bisa mengeceknya dengan melihat versi php dari *command line* dengan perintah `php -v`

## 2 cara inisiai awal
### Cara 1
- buat database `e-voting-ci4`
- import file **SQL** yang tertera kedalam database yang sudah dibuat
- sesuaikan username dan password database di file `.env`
- jalankan perintah `php spark serve` untuk menjalankan aplikasi

### Cara 2
- buat database `e-voting-ci4`
- sesuaikan username dan password database di file `.env`
- jalankan perintah `php spark migrate -all` untuk membuat tabel
- jalankan perintah `php spark db:seed RunningSeeder` untuk menyiapkan data awal
- jalankan perintah `php spark serve` untuk menjalankan aplikasi