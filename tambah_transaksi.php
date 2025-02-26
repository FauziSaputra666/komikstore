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

    $sql_komik = "SELECT harga, stok FROM komik WHERE id = '$id_komik'";
    $result_komik = $conn->query($sql_komik);

    if ($result_komik->num_rows > 0) {
        $komik = $result_komik->fetch_assoc();

        if ($komik['stok'] < $jumlah) {
            echo "<script>alert('Stok buku tidak mencukupi!'); window.history.back();</script>";
            exit;
        }     

        $total_harga = $komik['harga'] * $jumlah;

        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare("INSERT INTO transaksi (id_komik, id_pembeli, id_penjual, tanggal, jumlah, total_harga) VALUES (?, ?, ?, NOW(), ?, ?)");
            $stmt->bind_param("iiiii", $id_komik, $id_pembeli, $id_penjual, $jumlah, $total_harga);
            $stmt->execute();
            $id_transaksi = $stmt->insert_id;
            $stmt->close();

            $stmt_update = $conn->prepare("UPDATE komik SET stok = stok - ? WHERE id = ?");
            $stmt_update->bind_param("ii", $jumlah, $id_komik);
            $stmt_update->execute();
            $stmt_update->close();

            $conn->commit();

            $sql_struk = "SELECT t.id, k.judul AS komik, p.nama AS pembeli, pen.nama AS penjual, t.jumlah, t.total_harga, t.tanggal
                        FROM transaksi t
                        JOIN komik k ON t.id_komik = k.id
                        JOIN pembeli p ON t.id_pembeli = p.id
                        JOIN penjual pen ON t.id_penjual = pen.id
                        WHERE t.id = '$id_transaksi'";
            $result_struk = $conn->query($sql_struk);
            $data_struk = $result_struk->fetch_assoc();

            $struk_html = "
            <style>
                body { font-family: Arial, sans-serif; text-align: center; }
                .struk-container { width: 300px; margin: auto; padding: 20px; border: 2px solid black; }
                h2 { margin-bottom: 10px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                table, th, td { border: 1px solid black; padding: 8px; }
                .total { font-weight: bold; font-size: 16px; }
                .btn { margin-top: 10px; padding: 8px; border: none; cursor: pointer; font-size: 14px; }
                .print-btn { background: green; color: white; }
                .close-btn { background: red; color: white; }
            </style>

            <div class='struk-container'>
                <h2>Struk Pembelian</h2>
                <table>
                    <tr><td><b>ID Transaksi</b></td><td>{$data_struk['id']}</td></tr>
                    <tr><td><b>Komik</b></td><td>{$data_struk['komik']}</td></tr>
                    <tr><td><b>Pembeli</b></td><td>{$data_struk['pembeli']}</td></tr>
                    <tr><td><b>Penjual</b></td><td>{$data_struk['penjual']}</td></tr>
                    <tr><td><b>Jumlah</b></td><td>{$data_struk['jumlah']}</td></tr>
                    <tr><td class='total'><b>Total Harga</b></td><td class='total'>Rp " . number_format($data_struk['total_harga'], 0, ',', '.') . "</td></tr>
                    <tr><td><b>Tanggal</b></td><td>{$data_struk['tanggal']}</td></tr>
                </table>
                <button class='btn print-btn' onclick='window.print()'>Cetak Struk</button>
                <button class='btn close-btn' onclick='window.location.href=\"transaksi_karyawan.php\"'>Kembali</button>
            </div>
            ";

            echo $struk_html;

            echo "<script>
                let strukWindow = window.open('', '_blank');
                strukWindow.document.write(`$struk_html`);
                strukWindow.document.write('<script>setTimeout(() => { window.location.href=\"transaksi_karyawan.php\"; }, 5000)<\/script>');
            </script>";

            exit;
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
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
    <a href="transaksi.php" class="back-button">Kembali</a>
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
