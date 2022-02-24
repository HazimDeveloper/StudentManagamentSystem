
<?php

require '../functions.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM mahasiswa
WHERE 
nama LIKE '%$keyword%' OR
IC LIKE '%$keyword%' OR
email LIKE '%$keyword%' OR
kursus LIKE '%$keyword%'  
";

$mahasiswa = query($query);

?>

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
