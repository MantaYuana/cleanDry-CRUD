<?php
require_once "../../php/connect.php";
session_start();

$option = json_decode($_POST["option"], false);
$outlet = $_SESSION['outlet']['id'];
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_outlet = $outlet AND (tgl > '$option[0]' AND tgl < '$option[1]');");
$transaction = mysqli_fetch_all($query);

$query = mysqli_query($conn, "SELECT id, nama FROM member WHERE id IN (SELECT id_member FROM transaksi WHERE id_outlet = $outlet);");
$memberData = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data = array($row['id'] => $row['nama']);
    array_push($memberData, $row);
}
$memberDataIndex = array_keys($memberData);

$query = mysqli_query($conn, "SELECT id, nama FROM user WHERE id_outlet = $outlet AND id IN (SELECT id_user FROM transaksi WHERE id_outlet = $outlet);");
$cashierData = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data = array($row['id'] => $row['nama']);
    array_push($cashierData, $row);
}
$cashierDataIndex = array_keys($cashierData);

$numb = 0;
$report = [];
foreach ($transaction as $key => $value) {
    $customer = $memberData[array_search($value[3], $memberDataIndex)]["nama"];
    $cashier = $cashierData[array_search($value[13], $cashierDataIndex)]["nama"];
    $numb++;

    switch ($value[11]) {
        case 'baru':
            $value[11] = "New";
            $statusColor = "info";
            break;
        case 'proses':
            $value[11] = "On process";
            $statusColor = "warning";
            break;
        case 'selesai':
            $value[11] = "On shelf";
            $statusColor = "primary";
            break;
        case 'diambil':
            $value[11] = "Done";
            $statusColor = "success";
            break;
        default:
            $value[11] = "error status";
            break;
    }
    $value[12] = ($value[12] == 'dibayar') ? "Paid" : "Unpaid";
    $payColor = ($value[12] == 'Paid') ? "success" : "warning";

    $value[7] = "Rp" .  number_format($value[7], 2, ",", ".");
    $value[8] = "Rp" . number_format($value[8], 2, ",", ".");
    $value[9] = "Rp" . number_format($value[9], 2, ",", ".");

    if ($value[10] < 0) {
        $value[10] = "-Rp" . number_format(abs($value[10]), 2, ",", ".");
    } else {
        $value[10] = "Rp" . number_format($value[10], 2, ",", ".");
    }

    array_push(
        $report,
        array("#" => $numb, "Date of Transaction" => $value[4], "Invoice Code" => $value[2], "Customer" => $customer, "Payment Date" => $value[6], "Additional Cost" => $value[7], "Discount" => $value[8], "Tax" => $value[9], "Change" => $value[10], "Status" => $value[11], "Payment" => $value[12], "Cashier" => $cashier)
    );
}
echo json_encode($report);
