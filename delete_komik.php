<?php
include('config.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM komik WHERE id = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {
        echo "<script>
                alert('Data komik berhasil dihapus!');
                window.location.href = 'komik.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data komik: " . $stmt->error . "');
                window.location.href = 'komik.php';
              </script>";
    }

    $stmt->close(); 
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'komik.php';
          </script>";
}

$conn->close(); 
?>
