<?php
//connect to database (namahost,username,password,nama database)
$conn = mysqli_connect("localhost","root","","basicphp");

function query($query){

    global $conn;
//ambil data table - query data = (connect database,Query Database)
$result = mysqli_query($conn,$query);
$rows = [];

while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
}
return $rows;

}


function tambah($data){

    global $conn;
    //ambil data setiap form
    $nama = htmlspecialchars($data["nama"]);
    $IC = htmlspecialchars($data["IC"]);
    $email = htmlspecialchars($data["email"]);
    $kursus = htmlspecialchars($data["kursus"]);

    //upload gambar 
    $gambar = upload();

    if(!$gambar){
        return false;
    }
    //query insert data
    $query = "INSERT INTO mahasiswa 
    VALUES  
    ('','$nama','$IC','$email','$kursus','$gambar')";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM mahasiswa WHERE id = $id");
return mysqli_affected_rows($conn);
}

function upload(){
  
   $namaFile =  $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   //cek ada tak gambar yang di upload

   if($error === 4){

    echo "<script> 
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
   }

   //cek file yang diupload adalah gambar
   $extensionGambarValid = ['jpg','jpeg','png'];
   $extensionGambar = explode('.',$namaFile); 
   $extensionGambar = strtolower(end($extensionGambar));

   if(!in_array($extensionGambar,$extensionGambarValid)){
    echo "<script> 
    alert('File Yang Anda Upload Bukan Gambar');
    </script>";
    return false;

   }

   //cek size gambar terlalu besar
   if($ukuranFile > 1000000){
    echo "<script> 
    alert('Size Gambar Terlalu Besar');
    </script>";
    return false;
   
   }

   //lulus cek,gambar siap diupload
   //generate nama gambar baru

   $namaFileBaru = uniqId();
   $namaFileBaru .= '.';
   $namaFileBaru .= $extensionGambar;

   move_uploaded_file($tmpName,'images/'.$namaFileBaru);
   return $namaFile;
}


function ubah($data){

    global $conn;
    //ambil data setiap form
    $id = ($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $IC = htmlspecialchars($data["IC"]);
    $email = htmlspecialchars($data["email"]);
    $kursus = htmlspecialchars($data["kursus"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek user pilih gambar atau tidak
    if($_FILES['gambar']['error' === 4]){
        $gambar = $gambarLama;
    }else{

        $gambar = upload();
    }
  
    //query insert data
    $query = "UPDATE mahasiswa SET 
              nama = '$nama',
              IC = '$IC',
              email = '$email',
              kursus = '$kursus',
              gambar = '$gambar'

              WHERE id = '$id';
              ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function cari($keyword){

    $query = "SELECT * FROM mahasiswa
              WHERE 
            nama LIKE '%$keyword%' OR
            IC LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            kursus LIKE '%$keyword%'  
            ";
   
    return query($query);

}

function registrasi($data){

    global $conn;

    $username = strtolower(stripslashes($data['username']));

    $password =  mysqli_real_escape_string($conn,$data["password"]);

    $password2 = mysqli_real_escape_string($conn,$data["password2"]);

    //cek username sudah ada atau belum

    $result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('username sudah terdaftar!')
        </script>";

        return false;
    }
    //cek confirm password
    if($password !== $password2){
        echo "<script>
        alert ('Confirm Password Tidak Sah')
        </script>";
        return false;
    }
    
    //enkripsi password

     $password = password_hash($password,PASSWORD_DEFAULT);

    //tambahkan user baru ke dalam database

    $query = "INSERT INTO user 
              VALUES 
              ('','$username','$password')";
    mysqli_query($conn,$query);
    
    return mysqli_affected_rows($conn);


}


?>