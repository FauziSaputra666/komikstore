<?php
include('config.php'); 
$sql = "SELECT id, id_komik, id_pembeli, id_penjual, tanggal, jumlah, total_harga FROM transaksi";
$result = $conn->query($sql);

function format_currency($value) {
    return 'Rp ' . number_format($value, 2, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .back-button, .add-button, .action-buttons a {
            display: inline-block;
            padding: 8px 16px;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 16px;
            margin: 5px 0;
        }

        .back-button {
            background-color: #4CAF50;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        .add-button {
            background-color: #007BFF;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .edit-button {
            background-color: #FFC107;
        }

        .edit-button:hover {
            background-color: #e0a800;
        }

        .delete-button {
            background-color: #DC3545;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index_karyawan.php" class="back-button">Kembali</a>
    <h2>Daftar Transaksi</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Komik</th>
                <th>ID Pembeli</th>
                <th>ID Penjual</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_komik']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_pembeli']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_penjual']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                    echo "<td>" . format_currency($row['total_harga']) . "</td>";
                    echo "<td class='action-buttons'>
                            <a href='edit_transaksi.php?id=" . htmlspecialchars($row['id']) . "' class='edit-button'>Edit</a>
                            <a href='delete_transaksi.php?id=" . htmlspecialchars($row['id']) . "' class='delete-button' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' style='text-align: center;'>Tidak ada data transaksi.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="tambah_transaksi.php" class="add-button">Tambah Transaksi</a>
</div>

</body>
</html>
