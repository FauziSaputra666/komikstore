<?php
include('config.php');

// Validasi ID dan pengambilan data awal
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

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $genre = trim($_POST['genre']);
    $harga = str_replace(['.', ','], ['', '.'], trim($_POST['harga']));  
    $stok = trim($_POST['stok']);
    $gambar = $row['gambar']; // Gambar sebelumnya

    // Validasi data
    if (empty($judul) || empty($pengarang) || empty($genre) || empty($harga) || empty($stok)) {
        echo "Semua field harus diisi.";
        exit;
    }

    if (!is_numeric($harga)) {
        echo "Harga harus berupa angka.";
        exit;
    }

    if (!is_numeric($stok)) {
        echo "Stok harus berupa angka.";
        exit;
    }

    // Validasi dan upload gambar baru
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['gambar']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Cek format file
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($fileType), $allowedTypes)) {
            echo "Format file tidak didukung. Hanya JPG, JPEG, PNG, dan GIF.";
            exit;
        }

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
            $gambar = $targetFilePath; // Update path gambar
        } else {
            echo "Gagal mengunggah gambar.";
            exit;
        }
    }

    // Update data ke database
    $sql = "UPDATE komik SET judul = ?, pengarang = ?, genre = ?, harga = ?, stok = ?, gambar = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisi", $judul, $pengarang, $genre, $harga, $stok, $gambar, $id);

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
            margin: 50px auto;
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
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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
            display: block;
            width: 100%;
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
    </style>
</head>
<body>
    <div class="container">
        <a href="komik.php" class="back-button">Kembali</a>
        <h2>Edit Komik</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']); ?>" required>

            <label for="gambar">Gambar (Opsional):</label>
            <input type="file" name="gambar" accept="image/*">
            <?php if (!empty($row['gambar'])): ?>
                <p>Gambar saat ini: <img src="<?= htmlspecialchars($row['gambar']); ?>" alt="Gambar Komik" style="max-width: 100px;"></p>
            <?php endif; ?>

            <label for="pengarang">Pengarang:</label>
            <input type="text" name="pengarang" value="<?= htmlspecialchars($row['pengarang']); ?>" required>

            <label for="genre">Genre:</label>
            <select name="genre" required>
                <?php
                $genres = ["Action", "Adventure", "Comedy", "Drama", "Fantasy", "Horror", "Mystery", "Romance", "Slice of Life", "Sci-Fi", "Thriller"];
                foreach ($genres as $genre) {
                    $selected = $row['genre'] === $genre ? "selected" : "";
                    echo "<option value='$genre' $selected>$genre</option>";
                }
                ?>
            </select>

            <label for="harga">Harga:</label>
            <input type="text" name="harga" value="<?= number_format($row['harga'], 0, ',', '.'); ?>" required>
            
            <label for="stok">Stok:</label>
            <input type="number" name="stok" value="<?= htmlspecialchars($row['stok']); ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
