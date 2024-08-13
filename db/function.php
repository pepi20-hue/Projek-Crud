<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'projek';

$conn = mysqli_connect($host, $user, $pass, $db);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['tambahbarang'])) {
    $namabarang = $_POST['nama_barang'];
    $status = $_POST['status'];
    $stok = $_POST['stok'];

    $add = mysqli_query($conn, "INSERT INTO stok_barang (nama_barang, status, stok) VALUES ('$namabarang', '$status', '$stok')");
    if($add){
        header('location:status.php'); // Ganti dengan halaman tujuan setelah insert
    } else {
        echo 'Gagal menambahkan data: ' . mysqli_error($conn);
    }
}

//update info barang
if(isset($_POST['editbarang'])){
    $idb = $_POST['idb']; // Ambil ID barang yang diedit
    $namabarang = $_POST['nama_barang'];
    $status = $_POST['status'];

    $update = mysqli_query($conn, "UPDATE stok_barang SET nama_barang='$namabarang', status='$status' WHERE id='$idb'");

    if($update){
        echo "<script>alert('Barang berhasil diupdate');window.location.href='Stok.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate barang');window.location.href='Stok.php';</script>";
    }
}

//delete info barang
if(isset($_POST['deletebarang'])){
    $idb = $_POST['idb']; // Ambil ID barang yang dihapus
    $delete = mysqli_query($conn, "DELETE FROM stok_barang WHERE id='$idb'");

    if($delete){
        echo "<script>alert('Barang berhasil dihapus');window.location.href='Stok.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus barang');window.location.href='Stok.php';</script>";
    }
}
?>
