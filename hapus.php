<?php 

session_start();

if( !isset($_SESSION["login"])){
    header ("Location: login.php");
    exit;
}


require 'functions.php';
$id = $_GET["id"];

if(hapus($id)>0){
    echo "
    <script>
    alert('Data Berjaya Dihapuskan');
    document.location.href = 'baru.php';
    </script>   
    ";
   
}else{
    echo "
    <script>
    alert('Data Gagal Dihapuskan');
    document.location.href = 'baru.php';
    </script>   
    "; 
   
}
?>