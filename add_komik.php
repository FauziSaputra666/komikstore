<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $genre = $_POST['genre'];

    $harga = str_replace('.', '', $_POST['harga']);
    $stok = $_POST['stok'];

    $stmt = $conn->prepare("INSERT INTO komik (judul, pengarang, genre, harga, stok) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $judul, $pengarang, $genre, $harga, $stok); 
    if ($stmt->execute()) {
        echo "Komik berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Komik</title>
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
        form {
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
        @media (max-width: 600px) {
            form {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="komik.php" class="back-button">Kembali</a>
    <h2>Tambah Komik</h2>
    <form method="POST">
        <label for="judul">Judul:</label>
        <input type="text" name="judul" required>
        
        <label for="pengarang">Pengarang:</label>
        <input type="text" name="pengarang">
        
        <label for="genre">Genre:</label>
        <select name="genre" required>
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Comedy">Comedy</option>
            <option value="Drama">Drama</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Horror">Horror</option>
            <option value="Mystery">Mystery</option>
            <option value="Romance">Romance</option>
            <option value="Slice of Life">Slice of Life</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Thriller">Thriller</option>
        </select>
        
        <label for="harga">Harga:</label>
        <input type="text" name="harga" id="harga" required>
        
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required>
        
        <button type="submit">Tambah Komik</button>
    </form>
</div>

<script>
    document.getElementById('harga').addEventListener('input', function (event) {
        var value = event.target.value.replace(/\./g, ''); 
        var formattedValue = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); 
        event.target.value = formattedValue;
    });
</script>

</body>
</html>
