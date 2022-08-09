- **Topik 		    : Manajemen Badan Usaha Milik Desa Marsingati Lumban Gaol Berbasis Web**
- **Nama Aplikasi   : BUM Desa Marsingati Lumban Gaol**
- **Jenis Sistem	: Website**

**Persiapan Instalasi**

1.	Spesifikasi **minimal** device yang digunakan
    - Processor	Intel ® Core (TM) i5
    - RAM	4 GB
    - HDD	500 GB
    - SSD	Optional

2.	Tools yang diperlukan:
    - XAMPP
    - Visual Studio Code
    - Web rowser (Google Chrome is Recommended)
    
3.	Daftar User Type dan Default Account
    - Penasihat
        - Username	: edward
        - Password	: admin
    - Direktur
        - Username	: lisbeth
        - Password	: admin
    - Bendahara
        - Username	: mey
        - Password	: admin
    - Sekretaris
        - Username	: tere
        - Password	: admin
    - Manajer Unit
        - Username	: milo
        - Password	: admin

**Panduan Menajalankan atau me run Aplikasi**

1.	Akses link https://github.com/repoTAD4TRPL/FYP-16-2022 dan salin URL git dari project tersebut
2.	Buka CMD/Git bash pada folder htdocs pada XAMPP dimana project tersebut akan disimpan
    ![image](https://user-images.githubusercontent.com/68834482/183574049-3da704fa-404e-40a1-b5d4-c9a158a95900.png)
 
3.	Lakukan clone project dengan mengetik git clone https://github.com/repoTAD4TRPL/FYP-16-2022.git
4.  Setelah selesai silahkan membuka aplikasi XAMPP dengan menekan button start pada appache dan mysql
    ![image](https://user-images.githubusercontent.com/68834482/183574083-d5d83625-ee31-4e6a-a33f-f1bde71bf4a6.png)

5.	Kemudian silahkan membuka php my admin pada browser dengan mengetik http://localhost:8080/phpmyadmin/ atau http://localhost/phpmyadmin/
    ![image](https://user-images.githubusercontent.com/68834482/183574114-f8377b42-c3b9-4a49-af08-b3b79bfed685.png)

6.  Silahkan klik new dan isi database name dengan bumdesta3 kemudian klik create
    ![image](https://user-images.githubusercontent.com/68834482/183600810-2f76a815-ffd6-4c14-a330-6b659c8ff65a.png)
 
7.	Kemudian silahkan import database yang berada dalam folder project FYP-16-2022 ke php my admin dan pastikan nama database tersebut adalah bumdesta3
    ![image](https://user-images.githubusercontent.com/68834482/183573841-167d997c-a085-44b5-b34a-9ec8b52ab444.png)
    ![image](https://user-images.githubusercontent.com/68834482/183573857-390ef0b0-8315-4554-a409-8dac84749972.png)
    ![image](https://user-images.githubusercontent.com/68834482/183573866-bd710aad-5425-4ffe-834f-31cf6708055a.png)
    ![image](https://user-images.githubusercontent.com/68834482/183573879-f664916e-e794-4dea-a6fa-252f2ea57a20.png)

8.	Setelah selesai melakukan import database kedalam php my admin silahkan buka CMD pada folder project FYP-16-2022 yang telah di clone sebelumnya pada folder htdocs di XAMPP
    ![image](https://user-images.githubusercontent.com/68834482/183574561-94141034-3344-44d4-afb7-8ab6fd52c57f.png)

9.  Sebelum menjalankan aplikasi silahkan sesuaikan composer device anda dengan aplikasi dengan mengetik **composer update atau composer install. Jika terdapat error anda dapat mencoba composer install --ignore-platform-reqs.**
    ![image](https://user-images.githubusercontent.com/68834482/183573895-71afd964-4556-4b4e-a580-08a70b8a1639.png)
 
10.	Setelah terinstall pastikan terdapat **folder vendor** didalam Project tersebut
    ![image](https://user-images.githubusercontent.com/68834482/183573911-cfe48085-884a-433a-ac21-2919c809b3fa.png)
 
11.	Setelah selesai silahkan jalankan aplikasi dengan mengetik **php artisan serve**
    ![image](https://user-images.githubusercontent.com/68834482/183573926-f852a0ad-d9e9-4cdb-8991-d1a1d3dfc67b.png)
 
12.	Setelah itu silahkan buka web browser anda dengan mengetik localhost:8000 dan akan tampil tampilan sebagai berikut
    ![image](https://user-images.githubusercontent.com/68834482/183573950-36cb975b-f505-420f-afc8-e5d05f1b5ebb.png)
 
13.	Silahkan login menggunakan default account yang telah dijelaskan sebelumnya pada Persiapan Instalasi
    ![image](https://user-images.githubusercontent.com/68834482/183573483-360cefbe-9e3f-407f-a6a5-fe3f1c99b6aa.png)



 
