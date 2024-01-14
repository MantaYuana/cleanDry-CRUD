<?php
require_once "../php/connect.php"; // for depolyment
// require_once "../connect.php"; // for testing

$query = mysqli_query($conn, "SELECT dibayar, pajak FROM transaksi WHERE YEAR(tgl_bayar)=date('Y');");
$result = mysqli_fetch_all($query);

$data = ["paid" => 0, "unpaid" => 0, "tax" => 0]; // paid count, unpaid count, tax count
foreach ($result as $key => $value) {
    if ($value[0] == "dibayar") {
        $data["paid"]++;
    } else {
        $data["unpiad"]++;
    }
    $data["tax"] += $value[1];
}

// TODO: make statistics for latetst transaction, most sold package, and current monthly revenue using tb_detail_transaksi