<?php
include('config.php'); 
$sql = "SELECT id, nama, email, alamat FROM pembeli";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembeli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
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

        .add-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 16px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 5px 10px;
            color: white;
            border-radius: 3px;
            margin-right: 5px;
        }

        .edit-button {
            background-color: #FFC107;
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 16px;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .delete-button {
            background-color: #DC3545;
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 16px;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="index_karyawan.php" class="back-button">Kembali</a>
    <h2>Daftar Pembeli</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align: center;'>Tidak ada data pembeli.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="add_pembeli.php" class="add-button">Tambah Pembeli</a>
</div>

</body>
</html>
