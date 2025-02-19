<?php
session_start();
include('config.php');

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($email && $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                if ($_SESSION['role'] == 'admin') {
                    header("Location: index.php");
                } elseif ($_SESSION['role'] == 'karyawan') {
                    header("Location: index_karyawan.php");
                } else {
                    header("Location: index_user.php");
                }
                exit();
            } else {
                $message = "Email atau password salah!";
            }
        } else {
            $message = "Email atau password salah!";
        }
    } elseif (isset($_POST['guest'])) {

        $_SESSION['user_id'] = 'guest';
        $_SESSION['username'] = 'Guest';
        $_SESSION['role'] = 'guest';
        header("Location: index_user.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #4CAF50;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
        }

        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #45a049;
        }

        .message {
            margin: 10px 0;
            color: red;
            font-size: 0.9rem;
        }

        .register-link {
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            button {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<div class="container">     
    <h2>Login</h2>
    <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>
    <form method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>

    <form method="POST" style="margin-top: 10px;">
        <button type="submit" name="guest">Guest</button>
    </form>

    <div class="register-link">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</div>

</body>
</html>
