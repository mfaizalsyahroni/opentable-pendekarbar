<?php
require_once("service/database.php");
//require_once (membutuhkan satu kali koneksi to database) {function}
session_start();


$login_notification = "";

if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
    header("location: index.php");
} //validasi user yang telah login tidak perlu login kembali


    
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //echo memunculkan inputan valuenya dari method (post)


    $select_admin_query = "SELECT * FROM admin WHERE username ='$username' AND password ='$password'";
    //query dari tabel admin
    $select_admin = $db->query($select_admin_query);
    //query ke database
    //variabel penampungan dari query yang sudah kita tentukan di dalam variabel select admin query

    
    if ($select_admin->num_rows > 0) {
        $admin = $select_admin->fetch_assoc();
        //fetch_assoc memanggil data single baris (permasing" field)
        
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $admin['username'];

        header("location: index.php");
    } else {
        $login_notification = "Akun admin tidak ditemukan";
    }
    $db->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale= 1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Welcome Pendekar People</title>
</head>


<body id="login">
    <br>
    <h2>
        🙌🏻🥂Welcome PENDEKAR People🍻🙌🏻
    </h2>
    <div class="super-center">

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>LOGIN USER</h1>
            <i><?= $login_notification ?></i>

            <!-- setelah button form page login di klik akan mencari data di file tersebut (mengeksekusi file yang ada di dalamnya atau file itu sendiri) -->
            <!-- method: post (rahasia) -->

            <label for="">Username</label>
            <input name="username">
            <label for="">Password</label>
            <input type="password" name="password">
            <br>
            <button type="submit" name="login">LOGIN</button>
        </form>
    </div>
    <div class="signature">
        <p>
            <center>PIC</center>
        </p>
        <p>
            (Muhammad Faizal)
        </p>
        <br>
    </div>
</body>

</html>