<?php
include('config.php'); 
$sql = "SELECT id, judul, pengarang, genre, harga, stok FROM komik";
$result = $conn->query($sql);

function format_currency($value) {
    return number_format($value, 2, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Komik</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .back-button, .add-button, .edit-button, .delete-button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
            margin-right: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .back-button {
            background-color: #4CAF50;
            color: white;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        .add-button {
            background-color: #007BFF;
            color: white;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .edit-button {
            background-color: #FFC107;
            color: white;
        }

        .edit-button:hover {
            background-color: #e0a800;
        }

        .delete-button {
            background-color: #DC3545;
            color: white;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 5px 12px;
            color: white;
            border-radius: 5px;
            margin-right: 5px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
        }

        .container a {
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index_user.php" class="back-button">Kembali</a>
    <h2>Daftar Komik</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Genre</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['pengarang'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . format_currency($row['harga']) . "</td>";
                    echo "<td>" . $row['stok'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align: center;'>Tidak ada data komik.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
