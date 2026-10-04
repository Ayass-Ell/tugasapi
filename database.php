<?php
header("Content-Type: application/json");

$serverName = "ElisaLarasati";
$connectionOptions = [
    "Database" => "db_peminjaman",
    "TrustServerCertificate" => true,
    "CharacterSet" => "UTF-8"
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Koneksi database gagal",
        "error" => sqlsrv_errors()
    ]);
    exit;
}
?>
