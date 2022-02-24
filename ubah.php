<?php

session_start();

if( !isset($_SESSION["login"])){
    header ("Location: login.php");
    exit;
}


require './functions.php';

//ambil data di URL

$id = $_GET["id"];


//query data mahasisiswa
$mhs = query("SELECT * FROM mahasiswa WHERE id= $id")[0];


//cek button submit ditekan
if(isset($_POST["submit"])){

    //cek data berjaya diubah
   if(ubah($_POST) > 0){
    echo "
    <script>
    alert('Data Berjaya Diubah');
    document.location.href = 'baru.php';
    </script>   
    ";
   }else{
    echo "
    <script>
    alert('Data Gagal Diubah');
    document.location.href = 'baru.php';
    </script>   
    "; 
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Mahasiswa</title>
</head>
<body>
    
<h1>Update Data Mahasiswa</h1>

<form action="" method="post" enctype="multipart/form-data">

<ul>
    <li>
        <input type="hidden" name="id" id="id" required value="<?= $mhs["id"]?>">
        <input type="hidden" name="gambarLama" id="gambarLama" required value="<?= $mhs["gambar"]?>">
    </li>
    <li> 
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]?>">
    </li>
    <li>
        <label for="IC">IC:</label>
        <input type="text" name="IC" id="IC" required value="<?= $mhs["IC"]?>">
    </li>
    <li>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required value="<?= $mhs["email"]?>">
    </li>
    <li>
        <label for="kursus">Kursus:</label>
        <input type="text" name="kursus" id="kursus" required value="<?= $mhs["kursus"]?>">
    </li>
    <li>
        <label for="gambar">Gambar:</label>
        <br>
        <img src="Images/<?= $mhs["gambar"]?>" alt="" > 
        <br>
        <input type="file" name="gambar" id="gambar" >
    </li>
    <li>
        <button type="submit" name="submit">Update Data</button>
    </li>
</ul>
</form>
</body>
</html>