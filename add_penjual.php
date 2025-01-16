<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $no_telepon = $_POST['number']; 
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO penjual (nama, no_telepon, alamat) VALUES ('$nama', '$no_telepon', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        echo "Penjual berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjual</title>
    <link rel="stylesheet" href="style.css">
</head>
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

    input[type="text"], input[type="number"], textarea {
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
<body>

<div class="container">
    <a href="penjual.php" class="back-button">Kembali</a>
    <h2>Tambah Penjual</h2>
    <form method="POST">
        <label for="nama">Nama Penjual:</label>
        <input type="text" name="nama" required>
        <br>
        <label for="number">No Telepon:</label>
        <input type="number" name="number" required>
        <br>
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea>
        <br>
        <button type="submit">Tambah Penjual</button>
    </form>
</div>

</body>
</html>
