CREATE DATABASE db_peminjaman;
GO

USE db_peminjaman;
GO

CREATE TABLE mahasiswa (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(100) NOT NULL,
    angkatan INT NOT NULL,
    email VARCHAR(100),
    telepon VARCHAR(20)
);
GO

CREATE TABLE asset (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nama_asset VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    jumlah INT NOT NULL,
    kondisi VARCHAR(50) NOT NULL,
    lokasi VARCHAR(100) NOT NULL,
    status VARCHAR(30) NOT NULL
);
GO

CREATE TABLE peminjaman (
    id_peminjaman INT IDENTITY(1,1) PRIMARY KEY,
    id_mahasiswa INT NOT NULL,
    id_asset INT NOT NULL,
    jumlah INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NULL,
    keterangan VARCHAR(255),
    status_peminjaman VARCHAR(30) NOT NULL,

    CONSTRAINT FK_Peminjaman_Mahasiswa
        FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id),

    CONSTRAINT FK_Peminjaman_Asset
        FOREIGN KEY (id_asset) REFERENCES asset(id)
);
GO

INSERT INTO mahasiswa
(nim, nama, jurusan, angkatan, email, telepon)
VALUES
('210101001', 'Ahmad Rizki Pratama', 'Teknik Informatika', 2021,
 'ahmad.rizki@example.com', '081234567890'),
('210101003', 'Budi Santoso', 'Teknik Komputer', 2022,
 'budi.santoso@example.com', '083456789012');
GO

INSERT INTO asset
(nama_asset, kategori, jumlah, kondisi, lokasi, status)
VALUES
('Laptop Asus ROG', 'Elektronik', 3, 'Baik', 'Lab Komputer 2', 'Tersedia'),
('Proyektor Epson EB-X400', 'Elektronik', 5, 'Baik', 'Lab Komputer 1', 'Tersedia');
GO
