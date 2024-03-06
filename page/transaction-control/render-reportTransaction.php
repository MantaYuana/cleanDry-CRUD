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

$numb = 0;
foreach ($transaction as $key => $value) {
    $customer = $memberData[array_search($value[3], $memberDataIndex)]["nama"];
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

    echo "<tr class='text-center'>
                        <th scope='row' class='text-center'>$numb</th>
                        <th class='text-start'>$value[4]</a></th>
                        <td class='text-start'>$value[2]</td>
                        <td>$customer</td>
                        <td>$value[6]</td>
                        <td class='currencyFormatRupiah' id='test'>$value[7]</td>
                        <td class='currencyFormatRupiah'>$value[8]</td>
                        <td class='currencyFormatRupiah'>$value[9]</td>
                        <td class='currencyFormatRupiah'>$value[10]</td>
                        <td>$value[11]</td>
                        <td>$value[12]</td>
                        <td>$value[13]</td>
                    </tr>
                </div>";
}

?>