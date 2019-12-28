<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

//jika nnti tombol cari diclick (cari)name button
if (isset($_POST["cari"])) {
    //membuat function cari
    $mahasiswa = cari($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman admin</title>


</head>

<body>

    <h1>Daftar Mahasiswa</h1>

    <a href="logout.php">Logout</a>

    <a href="cetak.php">cetak</a>
    <br>
    <br>
    <br>

    <a href="tambah.php">Tambah Data Mahasiswa</a>

    <style>
        .loader {
            width: 50px;
            position: absolute;
            top: 150px;
            left: 230px;
            z-index: -1;
        }
    </style>
    <br>
    <br>

    <form action="" method="post">
        <input type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pencarian" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>

        <img src="img/25.gif" class="loader">
    </form>
    <br>
    <br>
    <br>

    <div class="container" id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>aksi</th>
                <th>gambar</th>
                <th>nrp</th>
                <th>nama</th>
                <th>email</th>
                <th>jurusan</th>
            </tr>

            <?php $i = 1; ?>
            <tr>
                <?php foreach ($mahasiswa as $row) : ?>


                    <td><?php echo $i; ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
                        <a href="hapus.php?id=<?= $row["id"];  ?>" onclick="return confirm('yakin?');">hapus</a>
                    </td>
                    <td><img src="img/<?= $row["gambar"];  ?>" width="50"></td>
                    <td><?php echo $row["nrp"]; ?></td>
                    <td><?php echo $row["nama"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?= $row["jurusan"]; ?></td>
            </tr>
            <?php $i++; ?>

        <?php endforeach; ?>

        </table>
    </div>

    <script src="js/jqueri.js"></script>
    <script src="js/script.js"></script>

</body>

</html>