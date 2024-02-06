<?php 
require_once "../../php/connect.php";
$resCustomer = [];
$resPackage = [];

$idCustomer = $_POST['customer'];
$idPackage = $_POST['package'];

if ($idCustomer > 0) {
    $query = mysqli_query($conn, "SELECT telp, alamat FROM member WHERE id=$idCustomer;");
    $resCustomer = mysqli_fetch_assoc($query);
}

if ($idPackage > 0) {
    $query = mysqli_query($conn, "SELECT nama_paket, harga FROM paket WHERE id=$idPackage;");
    $resPackage = mysqli_fetch_assoc($query);
}

// sometime array will return null and fatal error will be thrown
if(is_null($resPackage)){
    $resPackage = [];
}
if(is_null($resCustomer)){
    $resCustomer = [];
}

echo json_encode(array_merge($resCustomer, $resPackage));

