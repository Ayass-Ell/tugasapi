<?php
include "../config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$id_mahasiswa = $data["id_mahasiswa"] ?? 0;
$id_asset = $data["id_asset"] ?? 0;
$jumlah = $data["jumlah"] ?? 0;
$tanggal_pinjam = $data["tanggal_pinjam"] ?? "";
$tanggal_kembali = $data["tanggal_kembali"] ?? null;
$keterangan = $data["keterangan"] ?? "";
$status_peminjaman = $data["status_peminjaman"] ?? "Pending";

$cekMahasiswa = sqlsrv_query(
    $conn,
    "SELECT id FROM mahasiswa WHERE id = ?",
    [$id_mahasiswa]
);

if (!$cekMahasiswa || !sqlsrv_fetch_array($cekMahasiswa, SQLSRV_FETCH_ASSOC)) {
    echo json_encode(["status" => false, "message" => "Mahasiswa tidak ditemukan"]);
    exit;
}

$cekAsset = sqlsrv_query(
    $conn,
    "SELECT id, jumlah FROM asset WHERE id = ?",
    [$id_asset]
);

$asset = $cekAsset ? sqlsrv_fetch_array($cekAsset, SQLSRV_FETCH_ASSOC) : false;

if (!$asset) {
    echo json_encode(["status" => false, "message" => "Asset tidak ditemukan"]);
    exit;
}

if ($jumlah <= 0 || $jumlah > $asset["jumlah"]) {
    echo json_encode(["status" => false, "message" => "Jumlah peminjaman tidak valid"]);
    exit;
}

$sql = "INSERT INTO peminjaman
        (id_mahasiswa, id_asset, jumlah, tanggal_pinjam, tanggal_kembali, keterangan, status_peminjaman)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = sqlsrv_query($conn, $sql, [
    $id_mahasiswa,
    $id_asset,
    $jumlah,
    $tanggal_pinjam,
    $tanggal_kembali,
    $keterangan,
    $status_peminjaman
]);

if ($stmt) {
    echo json_encode(["status" => true, "message" => "Peminjaman berhasil dibuat"]);
} else {
    echo json_encode(["status" => false, "message" => "Peminjaman gagal dibuat"]);
}
?>