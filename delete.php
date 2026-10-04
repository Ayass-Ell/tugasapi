<?php
include "../config/database.php";

$id = $_GET["id_peminjaman"] ?? 0;

$sql = "DELETE FROM peminjaman WHERE id_peminjaman = ?";
$stmt = sqlsrv_query($conn, $sql, [$id]);

if ($stmt) {
    echo json_encode(["status" => true, "message" => "Peminjaman berhasil dihapus"]);
} else {
    echo json_encode(["status" => false, "message" => "Peminjaman gagal dihapus"]);
}
?>