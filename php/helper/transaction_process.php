<?php
require "../connect.php";
session_start();
date_default_timezone_set("Asia/Makassar");

@$id = $_POST['id'];

@$cost = json_decode($_POST['input-cost']);
$id_outlet = $_SESSION["outlet"]["id"];
@$id_member = $_POST['transaction-name'];
$tgl = date("Y-m-d H:i:s");
@$deadline = $_POST['input-deadline'];
@$biaya_tambahan = $cost[4];
@$diskon = $cost[1];
@$pajak = $cost[2];
@$kembalian = $cost[5];
@$tgl_bayar = ($kembalian >= 0) ? $tgl : NULL;
@$status = $_POST["input-status"];
@$dibayar = ($kembalian >= 0) ? "dibayar" : "belum_bayar";
@$id_user = $_SESSION['id_user'];
$process = $_POST['process'];

$invoice = sprintf("%06d", $id_outlet) . sprintf("%03d", $id_member) . sprintf("%03d", $id_user) . date("ymdHis"); //id_outlet+id_user+deadline+tgl
@$cart = json_decode($_POST['input-cart']);

if ($process == "register") {
    $res = mysqli_query($conn, "INSERT INTO transaksi VALUES (NULL, $id_outlet, $invoice, $id_member, '$tgl', '$deadline', '$tgl_bayar', $biaya_tambahan, $diskon, $pajak, $kembalian, '$status', '$dibayar', '$id_user');");
    // TODO: implement cross page message transfer (like in task-manager)
    if (!$res) {
        echo "<script>alert('Transaction Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-transaction;</script>";
    } else {
        $res = mysqli_query($conn, "SELECT id FROM transaksi WHERE kode_invoice = $invoice;");
        $transaksi = mysqli_fetch_assoc($res);
        $id_transaksi = $transaksi['id'];

        foreach ($cart as $key => $value) {
            $total_harga = $value->quantity * $value->price;
            $res = mysqli_query($conn, "INSERT INTO detail_transaksi VALUES (NULL, $id_transaksi, $value->packageID, $value->quantity, '$value->note', $value->price, $total_harga);");
        }
        echo "<script>alert('Transaction success !'); window.location.href = '../../page/page.php?page=transactions';</script>";
        exit;
    }
} elseif ($process == "edit") {
    $res = mysqli_query($conn, "UPDATE transaksi SET deadline='$deadline', tgl_bayar='$tgl_bayar', status='$status', dibayar='$dibayar', pajak=$pajak, biaya_tambahan=$biaya_tambahan, kembalian=$kembalian WHERE id=$id;");
    if (!$res) {
        echo "<script>alert('Edit Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=edit-transaction&idTransaction=$id';</script>";
    } else {
        echo "<script>alert('Edit success !'); window.location.href = '../../page/page.php?page=edit-transaction&idTransaction=$id';</script>";
        exit;
    }
} elseif ($process == "destroy") {
    echo "<script>alert('Denied !'); window.location.href = '../../page/page.php?page=transactions';</script>";
    // $res = mysqli_query($conn, "DELETE FROM transaksi WHERE id=$id;");

    // if (!$res) {
    //     echo "<script>alert('Delete Failed: " . mysqli_error($conn) . "');</script>";
    // } else {
    // echo "<script>alert('Delete success !'); window.location.href = '../../page/page.php?page=transactions';</script>";
    //     exit;
    // }
} elseif ($process == "destroyOrder") {
    // echo "<script>alert('Denied !'); window.location.href = '../../page/page.php?page=transactions';</script>";
    // $id_transaksi = $_POST['transactionID'];
    $id_package = $_POST['orderID'];

    $res = mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id=$id_package;");
    // $res = mysqli_query($conn, "UPDATE transaksi SET pajak=$pajak, biaya_tambahan=$biaya_tambahan, kembalian=$kembalian WHERE id=$id_transaksi;");

    // echo "Delete success !";
    if (!$res) {
        echo "Delete Failed: " . mysqli_error($conn);
    } else {
        echo "Delete success !";
        exit;
    }
} else {
    echo "<script>alert('Unknown Process, contact admin'); window.location.href = '../../page/page.php?page=dashboard';</alert>";
    exit;
}
