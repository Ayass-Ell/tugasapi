<?php
include "../config/database.php";

$sql = "SELECT
            p.id_peminjaman,
            m.nim,
            m.nama AS nama_mahasiswa,
            a.nama_asset,
            p.jumlah,
            p.tanggal_pinjam,
            p.tanggal_kembali,
            p.keterangan,
            p.status_peminjaman
        FROM peminjaman p
        JOIN mahasiswa m ON p.id_mahasiswa = m.id
        JOIN asset a ON p.id_asset = a.id
        ORDER BY p.id_peminjaman DESC";

$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    echo json_encode(["status" => false, "message" => "Gagal mengambil data"]);
    exit;
}

$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    if ($row["tanggal_pinjam"] instanceof DateTime) {
        $row["tanggal_pinjam"] = $row["tanggal_pinjam"]->format("Y-m-d");
    }
    if ($row["tanggal_kembali"] instanceof DateTime) {
        $row["tanggal_kembali"] = $row["tanggal_kembali"]->format("Y-m-d");
    }
    $data[] = $row;
}

echo json_encode(["status" => true, "data" => $data]);
?>