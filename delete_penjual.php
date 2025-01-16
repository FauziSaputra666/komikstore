<?php
include('config.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM penjual WHERE id = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {
        echo "<script>
                alert('Data penjual berhasil dihapus!');
                window.location.href = 'penjual.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data penjual: " . $stmt->error . "');
                window.location.href = 'penjual.php';
              </script>";
    }

    $stmt->close(); 
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'penjual.php';
          </script>";
}

$conn->close(); 
?>
