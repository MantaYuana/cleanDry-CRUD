<?php
require_once "../php/connect.php"; // for depolyment
// require_once "../connect.php"; // for testing

$id_outlet = $_SESSION['outlet']['id'];
// $id_outlet = 1;

// STATISTIC of monthly paid/unpaid count
$query = mysqli_query($conn, "SELECT dibayar, pajak FROM transaksi WHERE YEAR(tgl_bayar)=date('Y') AND MONTH(tgl)=date('n') AND id_outlet = $id_outlet;");
$result = mysqli_fetch_all($query);

$dataCount = ["paid" => 0, "unpaid" => 0, "tax" => 0]; // paid count, unpaid count, tax count
foreach ($result as $key => $value) {
    if ($value[0] == "dibayar") {
        $dataCount["paid"]++;
    } else {
        $dataCount["unpaid"]++;
    }
    $dataCount["tax"] += $value[1];
}

// STATISTIC of monthly most sold package
$query = mysqli_query($conn, "SELECT id_paket, qty FROM detail_transaksi WHERE id_transaksi IN (SELECT id FROM transaksi WHERE id_outlet = $id_outlet AND YEAR(tgl_bayar)=date('Y') AND MONTH(tgl)=date('n'));");
$result = mysqli_fetch_all($query);
$tempQty = [];
foreach ($result as $key => $value) {
    if (array_key_exists($value[0], $tempQty)) {
        $tempQty["$value[0]"] += $value[1];
    } else {
        $tempQty["$value[0]"] = $value[1];
    }
}

$query = mysqli_query($conn, "SELECT id, nama_paket, jenis FROM paket WHERE id_outlet = $id_outlet;");
$result = mysqli_fetch_all($query);
$dataPackage = ['packageType' => []];
foreach ($result as $key => $value) {
    if (array_key_exists($value[0], $tempQty)) {
        $dataPackage["$value[1]"] = $tempQty["$value[0]"];
    }
    switch ($value[2]) {
        case 'kiloan':
            $value[2] = "by weight";
            break;
        case 'selimut':
            $value[2] = "Blanket";
            break;
        case 'bed_cover':
            $value[2] = "Bed Cover";
            break;
        case 'kaos':
            $value[2] = "Shirt";
            break;
        case 'lain':
            $value[2] = "Other";
            break;

        default:
            $value[2] = "error type";
            break;
    }
    array_push($dataPackage["packageType"], $value[2]);
}

// STATISTIC of annual latest transaction
$query = mysqli_query($conn, "SELECT id_paket, qty FROM detail_transaksi WHERE id_transaksi IN (SELECT id FROM transaksi WHERE id_outlet = $id_outlet AND YEAR(tgl_bayar)=date('Y')) LIMIT 5");
$result = mysqli_fetch_all($query);
$dataLatestTransaction = $result;

$query = mysqli_query($conn, "SELECT id, nama_paket FROM paket WHERE id_outlet = $id_outlet;");
$result = mysqli_fetch_all($query);
foreach ($result as $key => $value) {
    foreach ($dataLatestTransaction as $transaction => $valuetransaction) {
        if ($valuetransaction[0] == $value[0]) {
            $dataLatestTransaction[$transaction][0] = $value[1];
        }
    }
}

// STATISTIC of current monthly revenue
$query = mysqli_query($conn, "SELECT total_harga FROM detail_transaksi WHERE id_transaksi IN (SELECT id FROM transaksi WHERE id_outlet = $id_outlet AND YEAR(tgl_bayar)=date('Y') AND MONTH(tgl)=date('n'));");
$result = mysqli_fetch_all($query);
$dataRevenue = 0;
foreach ($result as $key => $value) {
    $orderCost = $value[0];
    $dataRevenue += $orderCost;
}
