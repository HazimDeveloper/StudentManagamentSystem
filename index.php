<?php
session_start();

if( !isset($_SESSION["login"])){
    header ("Location: login.php");
    exit;
}

require './functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

if(isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <style>
        .loader{
            width: 100px;
            position: absolute;
            top: 100px;
            z-index: -1;
            left: 240px;
            display: none;
        }
    </style>
</head>
<body>
    

<a href="logout.php">Logout</a>
<h1>Daftar Mahasiswa</h1>

<a href="tambah.php">Tambah Data Mahasiswa</a>
<br><br>

<form action="" method="post">

      <input type="text" name="keyword" id="keyword" size="30" autofocus placeholder="masukkan keyword pencarian..." autocomplete="off"> 
      <button type="submit" name="cari" id="tombol-cari">Cari</button>

      <img src="./Images/loader.gif" class="loader" alt="">
</form>


<br><br>
<div id="container">
<table border="1" cellpadding= "10" cellspacing="0" >

<tr>
    <th>No.</th>
    <th>Aksi</th>
    <th>Gambar</th>
    <th>IC</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Kursus</th>
</tr>


<?php $i=1?>
<?php foreach($mahasiswa as $mhs) :?>
<tr>
    <td><?= $i;?></td>
    <td>
        <a href="ubah.php?id=<?= $mhs["id"];?>">Ubah</a> | 
        <a href="hapus.php?id=<?= $mhs["id"];?>" onclick="return confirm('yakin?')">Hapus</a>
    </td>
    <td> <img src="./Images/<?= $mhs["gambar"]?> " width="50px"alt=""></td>
    <td><?= $mhs["IC"]?></td>
    <td><?= $mhs["nama"]?></td>
    <td><?= $mhs["email"]?></td>
    <td><?= $mhs["kursus"]?></td>
</tr>

<?php $i++?>
<?php endforeach;?>

</table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./js/script.js"></script>
</body>
</html>