<?php
include('config.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM pembeli WHERE id = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {
        echo "<script>
                alert('Data pembeli berhasil dihapus!');
                window.location.href = 'pembeli.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data pembeli: " . $stmt->error . "');
                window.location.href = 'pembeli.php';
              </script>";
    }

    $stmt->close(); 
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'pembeli.php';
          </script>";
}

$conn->close(); 
?>
