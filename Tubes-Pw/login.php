<?php
session_start();
require 'functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $resault = mysqli_query($conn, "SELECT username FROM user WHERE id=$id");
    $row = mysqli_fetch_assoc($resault);

    // cekcookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}



if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $resault = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($resault) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($resault);
        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["login"] = true;

            // cek remember me

            if (isset($_POST['remember'])) {
                // buat cookie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("location: index.html");
            exit;
        }
    }
    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>


    <div class="login-popup">
        <div class="background">
        </div>
        <div class="box">
            <div class="img-area">
                <div class="img">
                </div>
                <div class="img-logo">
                </div>
            </div>
            <div class="form">
                <h1>Login Page</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" placeholder="Username" name=username id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember </label>
                    </div>

                    <div class="peringatan">
                        <?php if (isset($error)) : ?>
                            <p>username / password salah!</p>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn" name="login">Login</button>
                    <div class="regis">
                        <a href="../pertemuan20copy/registrasi.php">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>