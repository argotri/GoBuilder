# GoBuilder-1.0
GoBuilder adalah sebuah aplikasi yang dapat membuat Sistem informasi sederhana yang dapat membuat form untuk pembukuan kecil - kecilan , seperti pencatatan keuangan , log barang dsb. User dapat membuat form sendiri tanpa harus menyewa seorang programmer untuk membuat sistem informasi tersebut. Sehingga Para UMKM yang ingin membuat Sistem tanpa harus membayar programmer untuk membuat program sesuai dengan keinginan dan kebutuhan UMKM tersebut.
GoBuilder dibangun diatas Framework GoFramework yaitu framework sederhana yang menggunakan MVC dan Factory design pattern dibelakangnya

Adapun fitur - fitur yang tersedia di dalam sistem ini diantaranya

    Form Builder
    Report Builder
    User management
    Role Management
    Menu Management

Dengan adanya Menu , Role dan User management , Pemilik bisa membuat lebih dari 1 akun untuk diberikan kepada masing - masing pegawai , dan akses pun bisa dibatasi terhadap menu menu tersebut.

Untuk Demo , Bisa Menuju link dibawah ini

http://builder.gosoft.web.id/demo

Username : admin

Password : admin

Cara instalasi

1. Upload File yang ada di Gist ini ke dalam Web folder php anda dan pastikan modrewrite di php sudah on , untuk keamanan dan kenyamanaan
Untuk aktifasi mod_rewrite bisa langsung tanya ke mbah google :D
http://stackoverflow.com/questions/3131236/how-do-you-enable-mod-rewrite

2. Setting file .htaccess karena developer belum membuat versi otomatisnya :D , mungkin bisa di bantu membuat setingan ini secara otomatis 
RewriteEngine On
RewriteBase /folder_anda_disini/ << Ubah sesuai dengan folder yg ada di http://webanda.com/folder_anda_disisni
Jika tidak memakai sub folder ubah hanya menggunakan /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

3. Upload SQL file
Masukkan SQL file dalam folder database ke sqlimporter seperti phpmyadmin atau yang lainnya
terdapat 2 tipe file sql yaitu clean dan non clean ( clean berarti tidak ada data dummy seperti contoh form dan tabel , non clean , berarti ada form yang sudah dibuat sebelumnya pada testing)

4. Ubah file config.php
Ubah file config.php sesuai dengan kebutuhan
define("NAMA_SISTEM","Administrasi Travel"); // Nama Sistem Yang Digunakan untuk judul
define("DATABASE_DRIVER","mysql");// mysql , oracle , mssql
define("DATABASE_HOST","localhost"); // Host Database
define("DATABASE_USER","argo"); // Username di database
define("DATABASE_PASSWORD","argo"); // password di database
define("DATABASE_NAME","gobuilder"); // Nama databasenya
define("PATH_FOLDER", 'folder_anda_disini'); // nama sub folder anda sama dengan di file .hhtaccess namun tanpa garis miring (/)

5. Login ke web
Masuklah ke dalam website dan akan muncul halaman login page
Gunakan username default admin dan password default admin lalu lakukan perubahan password di user profile , berada pada icon pojok kanan atas 

6. buat form dan report atau bisa juga mengikuti mini tour powered by bootstraptour yang menjelaskan secara singkat isi dan fungsi masing - masing fitur
7. Sistem anda sudah siap digunakan :D

Terima kasih sudah mendownload GoBuilder , dengan ini anda membantu developer untuk berkembang lebih jauh lagi 

Salam


Argo Triwidodo - GoSoft
