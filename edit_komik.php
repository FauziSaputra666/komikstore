<?php
include('config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM komik WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak disertakan atau tidak valid.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $genre = $_POST['genre'];
    $harga = str_replace(['.', ','], ['', '.'], $_POST['harga']);  
    $stok = $_POST['stok'];

    if (!is_numeric($harga)) {
        echo "Harga harus berupa angka.";
        exit;
    }

    if (!is_numeric($stok)) {
        echo "Stok harus berupa angka.";
        exit;
    }

    $sql = "UPDATE komik SET judul = ?, pengarang = ?, genre = ?, harga = ?, stok = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $judul, $pengarang, $genre, $harga, $stok, $id);

    if ($stmt->execute()) {
        echo "Data komik berhasil diperbarui!";
        header("Location: komik.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-top: 20px;
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
            form {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="komik.php" class="back-button">Kembali</a>
        <h2>Edit Komik</h2>
        <form method="POST">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" value="<?php echo htmlspecialchars($row['judul']); ?>" required>

            <label for="pengarang">Pengarang:</label>
            <input type="text" name="pengarang" value="<?php echo htmlspecialchars($row['pengarang']); ?>" required>

            <label for="genre">Genre:</label>
            <select name="genre" required>
                <option value="Action" <?php if ($row['genre'] == "Action") echo "selected"; ?>>Action</option>
                <option value="Adventure" <?php if ($row['genre'] == "Adventure") echo "selected"; ?>>Adventure</option>
                <option value="Comedy" <?php if ($row['genre'] == "Comedy") echo "selected"; ?>>Comedy</option>
                <option value="Drama" <?php if ($row['genre'] == "Drama") echo "selected"; ?>>Drama</option>
                <option value="Fantasy" <?php if ($row['genre'] == "Fantasy") echo "selected"; ?>>Fantasy</option>
                <option value="Horror" <?php if ($row['genre'] == "Horror") echo "selected"; ?>>Horror</option>
                <option value="Mystery" <?php if ($row['genre'] == "Mystery") echo "selected"; ?>>Mystery</option>
                <option value="Romance" <?php if ($row['genre'] == "Romance") echo "selected"; ?>>Romance</option>
                <option value="Slice of Life" <?php if ($row['genre'] == "Slice of Life") echo "selected"; ?>>Slice of Life</option>
                <option value="Sci-Fi" <?php if ($row['genre'] == "Sci-Fi") echo "selected"; ?>>Sci-Fi</option>
                <option value="Thriller" <?php if ($row['genre'] == "Thriller") echo "selected"; ?>>Thriller</option>
            </select>

            <label for="harga">Harga:</label>
            <input type="text" name="harga" value="<?php echo number_format($row['harga'], 0, ',', '.'); ?>" required>
            
            <label for="stok">Stok:</label>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($row['stok']); ?>" required>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
