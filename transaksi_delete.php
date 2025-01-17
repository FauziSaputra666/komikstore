<?php
include('config.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM transaksi WHERE id = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {
        echo "<script>
                alert('Data transaksi berhasil dihapus!');
                window.location.href = 'transaksi_karyawan.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data transaksi: " . $stmt->error . "');
                window.location.href = 'transaksi_karyawan.php';
              </script>";
    }

    $stmt->close(); 
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'transaksi_karyawan.php';
          </script>";
}

$conn->close(); 
?>
