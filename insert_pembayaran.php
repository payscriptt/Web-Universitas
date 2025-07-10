<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "UnivPayNusantara";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$nama   = $conn->real_escape_string($data['nama']);
$jumlah = floatval($data['jumlah']);
$status = $conn->real_escape_string($data['status']);

$sql = "INSERT INTO pembayaran (nama_lengkap, jumlah_pembayaran, status_pembayaran)
        VALUES ('$nama', $jumlah, '$status')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Data pembayaran berhasil disimpan"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal: " . $conn->error]);
}

$conn->close();
?>
