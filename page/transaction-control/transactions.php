<?php
$outlet = $_SESSION['outlet']['id'];
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_outlet = $outlet;");
$res = mysqli_fetch_all($query);
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
                <?php
                if ($_SESSION['role'] != "kasir") {
                    echo "<a class='btn btn-outline-success p-2 ps-3 pe-3 me-3' href='../page/page.php?page=print-transaction'>Print Report</a>";
                }
                if ($_SESSION['role'] != "owner") {
                    echo "<button type='button' class='btn btn-primary p-2 ps-5 pe-5'><a class='link-underline link-light link-underline-opacity-0' href='../page/page.php?page=register-transaction'>Add Transaction</a></button>";
                } ?>
            </div>
        </div>
        <br>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Transaction Order</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice Code</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider text-center">
                            <?php
                            $numb = 0;
                            foreach ($res as $key => $value) {
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

                                echo "<tr>
                        <th scope='row'>$numb</th>
                        <th class='text-start'><a href='../page/page.php?page=detail-transaction&idTransaction=$value[0]'>$value[2]</a></th>
                        <td>$value[5]</td>
                        <td><span class='badge rounded-pill bg-$statusColor'>$value[11]</span></td>
                        <td><span class='badge rounded-pill bg-$payColor'>$value[12]</span></td>
                        <td>
                            <a type='button' class='btn btn-sm btn-warning me-3' href='../page/page.php?page=edit-transaction&idTransaction=$value[0]'>
                                <svg class='bi pe-none' width='24' height='24'>
                                    <use xlink:href='#edit' />
                                </svg>
                            </a>
                        </td>
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
<script src="../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="../js/dataTable.js"></script>