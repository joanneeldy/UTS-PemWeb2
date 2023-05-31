# SCRIPT SQL di phpmyadmin

## Database "Siakad":

sql
CREATE DATABASE siakad;
USE siakad;

## Tabel "Matakuliah":

sql
CREATE TABLE Matakuliah (
ID INT AUTO_INCREMENT PRIMARY KEY,
Nama VARCHAR(255),
KodeMatakuliah CHAR(5),
Deskripsi TEXT
);

## Tabel "Dosen":

sql
CREATE TABLE Dosen (
ID INT AUTO_INCREMENT PRIMARY KEY,
Nama VARCHAR(255),
NIDN CHAR(8),
JenjangPendidikan ENUM('S2', 'S3')
);

## Tabel "Mahasiswa":

sql
CREATE TABLE Mahasiswa (
ID INT AUTO_INCREMENT PRIMARY KEY,
Nama VARCHAR(255),
NIM CHAR(10),
ProgramStudi VARCHAR(255)
);

index.php yang terdapat anchor link menuju tiap CRUD yang berfungsi sesuai tugasnya (create, read, update, delete) dan tujuannya (CRUD dosen, CRUD mahasiswa dan CRUD matakuliah)
