<?php

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "UnivPayNusantara";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari request
$data = json_decode(file_get_contents("php://input"), true);

$nama        = $conn->real_escape_string($data['nama']);
$tempatLahir = $conn->real_escape_string($data['tempatLahir']);
$tanggalLahir= $conn->real_escape_string($data['tanggalLahir']);
$jenisKelamin= $conn->real_escape_string($data['jenisKelamin']);
$alamat      = $conn->real_escape_string($data['alamat']);
$hp          = $conn->real_escape_string($data['hp']);
$email       = $conn->real_escape_string($data['email']);
$alasan      = $conn->real_escape_string($data['alasan']);

$sql = "INSERT INTO calon_mahasiswa (nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, no_hp, email, alasan_berkuliah)
        VALUES ('$nama', '$tempatLahir', '$tanggalLahir', '$jenisKelamin', '$alamat', '$hp', '$email', '$alasan')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Data calon mahasiswa berhasil disimpan"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal: " . $conn->error]);
}

$conn->close();
?>
