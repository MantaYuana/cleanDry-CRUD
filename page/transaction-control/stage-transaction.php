<?php
require_once "../../php/connect.php";

// initialize array for data customer and package
$resCustomer = [];
$resPackage = [];

// get customer ID and package ID
$idCustomer = $_POST['customer'];
$idPackage = $_POST['package'];

// check if customer ID is a negative number, if true then it wont make a query to DB
if ($idCustomer > 0) {
    $query = mysqli_query($conn, "SELECT nama, telp FROM member WHERE id=$idCustomer;");
    $resCustomer = mysqli_fetch_assoc($query);

    // check if query returns a row
    if (mysqli_num_rows($query) > 0) {
        // check if customer have 3 transaction or more, if true then give a discount
        $query = mysqli_query($conn, "SELECT id FROM transaksi WHERE id_member=$idCustomer LIMIT 3;");
        if (mysqli_num_rows($query) >= 3) {
            $resCustomer = array_merge($resCustomer, array('benefit' => "Discount"));
        } else {
            $resCustomer = array_merge($resCustomer, array('benefit' => "None"));
        }
    }
}

// check if package ID is a negative number, if true then it wont make a query to DB
if ($idPackage > 0) {
    $query = mysqli_query($conn, "SELECT nama_paket, harga, jenis FROM paket WHERE id=$idPackage;");
    $resPackage = mysqli_fetch_assoc($query);
}

// prevent array from returning with null a throwing a fatal error
if (empty($resPackage)) {
    $resPackage = [];
}
if (empty($resCustomer)) {
    $resCustomer = [];
}

// return array result in JSON
echo json_encode(array_merge($resCustomer, $resPackage));