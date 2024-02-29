<?php

$outlet = $_SESSION['outlet']['id'];
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_outlet = $outlet;");
$transaction = mysqli_fetch_all($query);

$query = mysqli_query($conn, "SELECT id, nama FROM member WHERE id IN (SELECT id_member FROM transaksi WHERE id_outlet = $outlet);");
$memberData = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data = array($row['id'] => $row['nama']);
    array_push($memberData, $row);
}
$memberDataIndex = array_keys($memberData);

?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="edit" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621" />
            <path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3" />
        </g>
    </symbol>
</svg>

<section id="transaction">
    <div class="container">
        <br>
        <div class="page-heading d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mt-3">Outlet <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h5>
                <h6>Welcome <span class="fw-bolder"><?= ucwords($_SESSION['role']) ?> <?= $_SESSION['username'] ?></span></h6>
            </div>
            <div>
                <a class="btn btn-outline-primary p-2 ps-3 pe-3" href="../page/page.php?page=transactions">Back</a>
            </div>
        </div>
        <br>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaction Order</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date of Transaction</th>
                                <th scope="col">Invoice Code</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Payment Date</th>
                                <th scope="col">Additional Cost</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Change</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Cashier</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider text-center">
                            <?php
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../node_modules/jquery/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- NOTE: if error try deploying jquery-easing -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha512-ahmSZKApTDNd3gVuqL5TQ3MBTj8tL5p2tYV05Xxzcfu6/ecvt1A0j6tfudSGBVuteSoTRMqMljbfdU0g2eDNUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script src="../node_modules/datatables.net/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="../node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script> -->
<script src="../js/autoNumericFormat.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.0/b-3.0.0/b-html5-3.0.0/datatables.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script> -->

<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script> <!-- for print -->
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>

<script>
    function getToday() {
        let date = new Date();
        let today = `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}`;
        return today;
    }
    $(document).ready(function() {
        $("#dataTable").DataTable({
            scrollX: true,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                            extend: 'pdfHtml5',
                            download: 'open',
                            orientation: 'landscape',
                            title: 'Transaction Report',
                            messageTop: "Outlet Sudirman Tengah, Transaction report printed in " + getToday() + ".",
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        'colvis'
                    ]
                }
            },
            columnDefs: [{
                targets: -1,
                visible: false
            }]
        });
    });
</script>