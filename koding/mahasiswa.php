<?php
require '../functions.php';
sleep(1);


$keyword = $_GET["keyword"];


$query = "SELECT * FROM mahasiswa  WHERE 
nrp LIKE '%$keyword%' OR
nama LIKE '%$keyword%' OR
email LIKE '%$keyword%' OR
jurusan LIKE '%$keyword%' 
";

$input = query($query);

// var_dump($input);
?>

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
        <?php foreach ($input    as $row) : ?>


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