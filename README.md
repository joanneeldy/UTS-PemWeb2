# SCRIPT SQL

## Database "Siakad"

Tabel "Matakuliah":

```sql

CREATE TABLE Matakuliah (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  Nama VARCHAR(255),
  KodeMatakuliah CHAR(5),
  Deskripsi TEXT
);
```

Tabel "Dosen":

```sql

CREATE TABLE Dosen (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  Nama VARCHAR(255),
  NIDN CHAR(8),
  JenjangPendidikan ENUM('S2', 'S3')
);
```

Tabel "Mahasiswa":

```sql

CREATE TABLE Mahasiswa (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  Nama VARCHAR(255),
  NIM CHAR(10),
  ProgramStudi VARCHAR(255)
);
```
