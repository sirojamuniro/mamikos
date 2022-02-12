Cara Penggunaan:
1. download source code
2. buat 4 database baru dahulu:1. test_db_mamikos 2.test_db_kos 3. test_db_auth 4. test_db_account
3. buat file .env
4. copy semua yang ada dalam file .env.prod ke file .env 
5.kembali ke folder mamikos
6. jalankan di terminal ketik "composer install" tunggu sampai selesai
7. jalankan webserver(apache/nginx) dan mysql
8. selanjutnya migrate database dari migration dengan cara sebagai berikut
9. untuk pertama ketik "php artisan migrate --path=database/migrations/auth" tunggu sampai selesai
10. yang kedua ketik di terminal "php artisan migrate --path=database/migrations/account" tunggu sampai selesai
11. yang ketiga ketik di terminal "php artisan migrate --path=database/migrations/kos" tunggu sampai selesai
12. setelah selesai maka kita masukkan seeder, berikut cara memakai seeder
13. ketik yang pertama "php artisan db:seed tunggu sampai selesai,
15. selanjutnya setelah selesai semua maka sekarang import collection postman file yang berada di dalam folder collection_postman
16. nama filenya MAMIKOS.postman_collection ada berada di dalam folder mamikos
17. buka postman, pilih titik 3 dikiri atas pilih import, pilih file MAMIKOS.postman_collection
18. jika sudah maka kembali ke terminal folder mamikos dan ketik"php artisan serve"
19. selanjutnya tinggal memakai api di POSTMAN

