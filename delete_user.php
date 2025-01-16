<?php
include('config.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {
        echo "<script>
                alert('Data user berhasil dihapus!');
                window.location.href = 'user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data user: " . $stmt->error . "');
                window.location.href = 'user.php';
              </script>";
    }

    $stmt->close(); 
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'user.php';
          </script>";
}

$conn->close(); 
?>
