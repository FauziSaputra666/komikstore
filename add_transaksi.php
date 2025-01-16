<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_komik = $conn->real_escape_string($_POST['id_komik']);
    $id_pembeli = $conn->real_escape_string($_POST['id_pembeli']);
    $id_penjual = $conn->real_escape_string($_POST['id_penjual']);
    $jumlah = intval($_POST['jumlah']); 

    if ($jumlah <= 0) {
        echo "Jumlah harus lebih besar dari 0.";
        exit;
    }

    $sql_komik = "SELECT harga FROM komik WHERE id = '$id_komik'";
    $result_komik = $conn->query($sql_komik);

    if ($result_komik->num_rows > 0) {
        $komik = $result_komik->fetch_assoc();
        $total_harga = $komik['harga'] * $jumlah;

        $stmt = $conn->prepare("INSERT INTO transaksi (id_komik, id_pembeli, id_penjual, tanggal, jumlah, total_harga) VALUES (?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("iiiii", $id_komik, $id_pembeli, $id_penjual, $jumlah, $total_harga);

        if ($stmt->execute()) {
            echo "Transaksi berhasil ditambahkan!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Komik tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        @media (max-width: 600px) {
            .container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index.php" class="back-button">Kembali</a>
<h2>Beli Komik</h2>
<form method="POST">
    
        <label for="id_komik">Komik:</label>
        <select name="id_komik" required>
            <?php
            $sql_komik = "SELECT id, judul AS nama, harga FROM komik";
            $result_komik = $conn->query($sql_komik);
            while ($row = $result_komik->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . " - Rp " . number_format($row['harga'], 0, ',', '.') . "</option>";
            }
            ?>
        </select>

        <label for="id_pembeli">Pembeli:</label>
        <select name="id_pembeli" required>
            <?php
            $sql_pembeli = "SELECT id, nama FROM pembeli";
            $result_pembeli = $conn->query($sql_pembeli);
            while ($row = $result_pembeli->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
            }
            ?>
        </select>

        <label for="id_penjual">Penjual:</label>
        <select name="id_penjual" required>
            <?php
            $sql_penjual = "SELECT id, nama FROM penjual";
            $result_penjual = $conn->query($sql_penjual);
            while ($row = $result_penjual->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
            }
            ?>
        </select>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" required>

        <button type="submit">Tambah Transaksi</button>
 
</form>
</div>

</body>
</html>
