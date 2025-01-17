<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    
    $sql = "SELECT id, id_komik, id_pembeli, id_penjual, tanggal, jumlah, total_harga FROM transaksi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $transaksi = $result->fetch_assoc();
    } else {
        echo "Transaksi tidak ditemukan.";
        exit;
    }

    $stmt->close();
} else {
    echo "ID tidak diberikan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_komik = intval($_POST['id_komik']);
    $id_pembeli = intval($_POST['id_pembeli']);
    $id_penjual = intval($_POST['id_penjual']);
    $jumlah = intval($_POST['jumlah']);
    $tanggal = $conn->real_escape_string($_POST['tanggal']);

    if ($jumlah <= 0) {
        echo "Jumlah harus lebih besar dari 0.";
        exit;
    }
 
    $sql_komik = "SELECT harga FROM komik WHERE id = ?";
    $stmt_komik = $conn->prepare($sql_komik);
    $stmt_komik->bind_param("i", $id_komik);
    $stmt_komik->execute();
    $result_komik = $stmt_komik->get_result();

    if ($result_komik->num_rows > 0) {
        $komik = $result_komik->fetch_assoc();
        $total_harga = $komik['harga'] * $jumlah;

      
        $sql_update = "UPDATE transaksi SET id_komik = ?, id_pembeli = ?, id_penjual = ?, tanggal = ?, jumlah = ?, total_harga = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iiisiid", $id_komik, $id_pembeli, $id_penjual, $tanggal, $jumlah, $total_harga, $id);

        if ($stmt_update->execute()) {
            echo "Transaksi berhasil diperbarui.";
            header("Location: transaksi.php");
            exit;
        } else {
            echo "Error: " . $stmt_update->error;
        }
        $stmt_update->close();
    } else {
        echo "Komik tidak ditemukan.";
        exit;
    }

    $stmt_komik->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"], input[type="date"], select {
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
    <a href="transaksi_karyawan.php" class="back-button">Kembali</a>
    <h2>Edit Transaksi</h2>
    <form method="POST">
        <label for="id_komik">Komik:</label>
        <select name="id_komik" required>
            <?php
 
            $sql_komik = "SELECT id, judul, harga FROM komik";
            $result_komik = $conn->query($sql_komik);
            while ($row = $result_komik->fetch_assoc()) {
                $selected = $row['id'] == $transaksi['id_komik'] ? 'selected' : '';
                echo "<option value='" . $row['id'] . "' $selected>" . $row['judul'] . " - Rp " . number_format($row['harga'], 0, ',', '.') . "</option>";
            }
            ?>
        </select>

        <label for="id_pembeli">Pembeli:</label>
        <select name="id_pembeli" required>
            <?php

            $sql_pembeli = "SELECT id, nama FROM pembeli";
            $result_pembeli = $conn->query($sql_pembeli);
            while ($row = $result_pembeli->fetch_assoc()) {
                $selected = $row['id'] == $transaksi['id_pembeli'] ? 'selected' : '';
                echo "<option value='" . $row['id'] . "' $selected>" . $row['nama'] . "</option>";
            }
            ?>
        </select>

        <label for="id_penjual">Penjual:</label>
        <select name="id_penjual" required>
            <?php
  
            $sql_penjual = "SELECT id, nama FROM penjual";
            $result_penjual = $conn->query($sql_penjual);
            while ($row = $result_penjual->fetch_assoc()) {
                $selected = $row['id'] == $transaksi['id_penjual'] ? 'selected' : '';
                echo "<option value='" . $row['id'] . "' $selected>" . $row['nama'] . "</option>";
            }
            ?>
        </select>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" value="<?php echo htmlspecialchars($transaksi['tanggal']); ?>" required>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" value="<?php echo htmlspecialchars($transaksi['jumlah']); ?>" required>

        <button type="submit">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
