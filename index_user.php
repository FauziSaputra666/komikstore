<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pengguna dari session
$username = $_SESSION['username'];
$role = $_SESSION['role']; // Role user yang login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #4CAF50, #81C784);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        h3 {
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: #555;
        }

        .nav-buttons {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .nav-buttons a {
            display: inline-block;
            padding: 12px 20px;
            font-size: 1rem;
            color: #fff;
            text-decoration: none;
            background-color: #4CAF50;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .nav-buttons a:hover {
            transform: scale(1.05);
            background-color: #45a049;
        }

        .logout {
            background-color: #f44336;
        }

        .logout:hover {
            background-color: #e53935;
        }

        @media (max-width: 768px) {
            .nav-buttons a {
                flex: 1 1 calc(50% - 20px);
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5rem;
            }

            h3 {
                font-size: 1rem;
            }

            .nav-buttons a {
                flex: 1 1 100%;
                font-size: 0.9rem;
            }
        }

        .logo img {
            max-width: 150px;
            display: block;
            margin: 0 auto 20px;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="images/logo.png" alt="Logo" style="max-width: 150px; margin-bottom: 20px;">
    </div>
    <h2>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h2>
        <h3>Silahkan pilih menu untuk melihat komik dan membeli komik:</h3>

        <div class="nav-buttons">
            <a href="list_komik.php">Data Komik</a>
            </div>

    <div class="nav-buttons">
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>

</body>
</html>
