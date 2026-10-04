<?php
include "../config/database.php";

$id = $_GET["id"] ?? 0;

$sql = "SELECT * FROM mahasiswa WHERE id = ?";
$stmt = sqlsrv_query($conn, $sql, [$id]);

if ($stmt === false) {
    echo json_encode(["status" => false, "message" => "Query gagal"]);
    exit;
}

$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($data) {
    echo json_encode(["status" => true, "data" => $data]);
} else {
    echo json_encode(["status" => false, "message" => "Mahasiswa tidak ditemukan"]);
}
?>