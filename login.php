<?php

require 'functions.php';
session_start();

//cek cookie
// if (isset($_COOKIE['login'])) {
//     if ($_COOKIE['login'] == 'true') {
//         $_SESSION['login'] = true;
//     }

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {

    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id nya
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id =$id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}



if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}



if (isset($_POST["login"])) {


    $username = $_POST["names"];
    $password = $_POST["password"];


    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username ada beberapa baris di result
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie
                // setcookie('login', 'true', time() + 60);
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("location: index.php");
            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
</head>

<body>

    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic;">username / password salah</p>

    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="names">Username :</label>
                <input type="text" name="names" id="names">

            </li>
            <br>

            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>

            <br>
            <li>
                <label for="remember">Remember Me :</label>
                <input type="checkbox" name="remember" id="remember">
            </li>

            <br>
            <li>
                <button type="login" name="login">Login</button>
            </li>
        </ul>

    </form>



</body>

</html>