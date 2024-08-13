<?php
require 'db/config.php';
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_wa = $_POST['no_wa'];
    $umur = $_POST['umur'];
    $barang = $_POST['barang'];
    $durasi_hari = $_POST['durasi'];
    $mulai_minjam = date('Y-m-d');
    $harus_dikembalikan = date('Y-m-d', strtotime("+$durasi_hari days"));
    
    // Cek apakah barang berstatus "ready"
    $sql = "SELECT * FROM stok_barang WHERE nama_barang = '$barang' AND status = 'ready'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Masukkan data ke tabel peminjam
        $sql = "INSERT INTO peminjam (nama, alamat, no_wa, umur, mulai_minjam, harus_dikembalikan, durasi_hari) 
                VALUES ('$nama', '$alamat', '$no_wa', $umur, '$mulai_minjam', '$harus_dikembalikan', $durasi_hari)";
        
        if ($conn->query($sql) === TRUE) {
            // Update status barang menjadi "digunakan"
            $sql_update = "UPDATE stok_barang SET status = 'digunakan' WHERE nama_barang = '$barang'";
            $conn->query($sql_update);
            
            echo "Peminjaman berhasil. Notifikasi akan dikirim ke WhatsApp.";
            
            // Kirim notifikasi WhatsApp menggunakan Twilio

            $account_sid = 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'; // Ganti dengan Twilio Account SID Anda
            $auth_token = 'your_auth_token'; // Ganti dengan Twilio Auth Token Anda
            $twilio_number = "whatsapp:+14155238886"; // Ganti dengan Twilio WhatsApp Number

            $client = new Client($account_sid, $auth_token);

            $message = "Halo $nama, Anda telah meminjam $barang selama $durasi_hari hari. Barang harus dikembalikan pada tanggal $harus_dikembalikan.";

            $client->messages->create(
                'whatsapp:'.$no_wa,
                array(
                    'from' => $twilio_number,
                    'body' => $message
                )
            );

            echo "Notifikasi berhasil dikirim ke WhatsApp!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Maaf, barang tidak tersedia untuk dipinjam.";
    }
}

$conn->close();
?>
