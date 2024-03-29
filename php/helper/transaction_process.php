<?php
require "../connect.php";
session_start();
date_default_timezone_set("Asia/Makassar");

$id_outlet = $_SESSION["outlet"]["id"];
@$id_member = $_POST['transaction-name'];
$tgl = date("Y-m-d H:i:s");
@$deadline = $_POST['input-deadline'];
@$tgl_bayar = ($_POST['input-cost'][3] >= 0) ? $tgl : NULL;
@$biaya_tambahan = $_POST["input-additionalCost"];
@$diskon = $_POST['input-cost'][1];
@$pajak = $_POST['input-cost'][2];
@$status = "baru";
@$dibayar = ($tgl_bayar != NULL) ? "dibayar" : "belum_bayar";
@$id_user = $_SESSION['id_user'];
$process = $_POST['process'];

$invoice = sprintf("%06d", $id_outlet) . sprintf("%03d", $id_member) . sprintf("%03d", $id_user) . date("ymdHis"); //id_outlet+id_user+deadline+tgl
@$cart = json_decode($_POST['input-cart']);


if ($process == "register") {
    $res = mysqli_query($conn, "INSERT INTO transaksi VALUES (NULL, $id_outlet, $invoice, $id_member, '$tgl', '$deadline', '$tgl_bayar', $biaya_tambahan, $diskon, $pajak, '$status', '$dibayar', '$id_user');");

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
    $res = mysqli_query($conn, "UPDATE outlet SET nama='$name', alamat='$alamat', telp='$telp' WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Edit Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=edit-outlet&idOutlet=$id';</script>";
    } else {
        echo "<script>alert('Edit success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
        exit;
    }
} elseif ($process == "destroy") {
    $res = mysqli_query($conn, "DELETE FROM outlet WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Delete Failed: " . mysqli_error($conn) . "');</script>";
    } else {
        echo "<script>alert('Delete success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
        exit;
    }
} else {
    echo "<script>alert('Unknown Process, contact admin'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit;
}
