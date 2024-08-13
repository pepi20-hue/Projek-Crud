<?php
require "db/config.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Peminjaman Barang</h2>
        <form action="proses_peminjaman.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
            
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>
            
            <label for="no_wa">Nomor WhatsApp:</label>
            <input type="text" id="no_wa" name="no_wa" required>
            
            <label for="umur">Umur:</label>
            <input type="number" id="umur" name="umur" required>
            
            <label for="barang">Pilih Barang:</label>
            <select id="barang" name="barang" required>
    <?php
    // Ambil data barang yang berstatus "ready" dari database
    $sql = "SELECT * FROM stok_barang WHERE status = 'ready'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['nama_barang'] . "'>" . $row['nama_barang'] . "</option>";
        }
    } else {
        echo "<option value=''>Tidak ada barang tersedia</option>";
    }
    ?>
</select>

            
            <label for="durasi">Durasi Peminjaman (hari):</label>
            <input type="number" id="durasi" name="durasi" required>
            
            <button type="submit">Pinjam Barang</button>
        </form>
    </div>
</body>
</html>
