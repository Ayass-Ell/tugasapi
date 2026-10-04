<?php
include "../config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"] ?? 0;
$nim = $data["nim"] ?? "";
$nama = $data["nama"] ?? "";
$jurusan = $data["jurusan"] ?? "";
$angkatan = $data["angkatan"] ?? 0;
$email = $data["email"] ?? "";
$telepon = $data["telepon"] ?? "";

$sql = "UPDATE mahasiswa SET
        nim = ?,
        nama = ?,
        jurusan = ?,
        angkatan = ?,
        email = ?,
        telepon = ?
        WHERE id = ?";
$stmt = sqlsrv_query($conn, $sql, [
    $nim, $nama, $jurusan, $angkatan, $email, $telepon, $id
]);

if ($stmt) {
    echo json_encode(["status" => true, "message" => "Mahasiswa berhasil diupdate"]);
} else {
    echo json_encode(["status" => false, "message" => "Mahasiswa gagal diupdate"]);
}
?>