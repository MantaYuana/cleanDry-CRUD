<?php
$id = $_GET["idTransaction"];
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id=$id;");
$transaction = mysqli_fetch_assoc($query);

$id_member = $transaction["id_member"];
$query = mysqli_query($conn, "SELECT nama FROM member WHERE id=$id_member;");
$member = mysqli_fetch_assoc($query);

$cart = [];
$query = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE id_transaksi=$id;");
while ($order = mysqli_fetch_assoc($query)) {
    $tempData["id"] = $order["id"];
    $tempData["id_transaksi"] = $order["id_transaksi"];
    $tempData["id_paket"] = $order["id_paket"];
    $tempData["qty"] = $order["qty"];
    $tempData["keterangan"] = $order["keterangan"];
    $tempData["harga_paket"] = $order["harga_paket"];
    $tempData["total_harga"] = $order["total_harga"];
    array_push($cart, $tempData);
}

$packageName = [];

$totalTransaction = 0;
foreach ($cart as $key => $value) {
    $id_package = $value["id_paket"];
    $query = mysqli_query($conn, "SELECT nama_paket FROM paket WHERE id=$id_package;");
    $res = mysqli_fetch_assoc($query);
    $totalTransaction += $value["total_harga"];
    array_push($packageName, $res);
}
?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="edit" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621" />
            <path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3" />
        </g>
    </symbol>
    <symbol id="delete" viewBox="0 0 24 24">
        <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
    </symbol>
</svg>

<section id="edit">
    <div class="container">
        <br>
        <h6 class="mt-3">Outlet <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h6>
        <h2 class="fw-medium" style="color: var(--mc-green-dark);">Edit <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">Transaction</span></h2>
        <br>

        <form action="../php/helper/transaction_process.php" method="post">
            <div class="d-lg-flex flex-row justify-content-between">
                <div class="card shadow me-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Modify Transaction</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="input-invoice" class="form-label">Invoice <span class="text-danger">*</span> </label>
                            <input type="text" name="input-invoice" class="form-control p-2" id="input-invoice" value="<?= $transaction["kode_invoice"] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="input-member" class="form-label">Member <span class="text-danger">*</span> </label>
                            <input type="text" name="input-member" class="form-control" id="input-member" value="<?= $member['nama'] ?>" disabled>
                        </div>
                        <div class="d-flex mb-3 justify-content-between">
                            <div class="me-3">
                                <label for="input-tgl" class="form-label">Date of Transaction <span class="text-danger">*</span> </label>
                                <input type="text" name="input-tgl" class="form-control p-2" id="input-tgl" value="<?= $transaction["tgl"] ?>" disabled>
                            </div>

                            <div class="">
                                <label for="input-deadline" class="form-label">Deadline <span class="text-danger">*</span> </label>
                                <input type="text" name="input-deadline" class="form-control flatpickr flatpickr-input datePicker p-2" id="input-deadline" value="<?= $transaction['deadline'] ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" name="input-status" required>
                                <option value="baru" <?= ($transaction["status"] == "baru") ? 'selected=selected' : ""; ?>>New</option>
                                <option value="proses" <?= ($transaction["status"] == "proses") ? 'selected=selected' : ""; ?>>On Process</option>
                                <option value="selesai" <?= ($transaction["status"] == "selesai") ? 'selected=selected' : ""; ?>>On Shelf</option>
                                <option value="diambil" <?= ($transaction["status"] == "diambil") ? 'selected=selected' : ""; ?>>Done</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="me-3">
                                <label for="register-additionalCost" class="form-label">Paid Date <span class="text-danger">*</span> </label>
                                <input type="text" name="register-additionalCost" class="form-control p-2" id="register-additionalCost" value="<?= $transaction["tgl_bayar"] ?>" disabled>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary text-light p-2">Submit</button>
                        <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=transactions">Back</a>

                        <input type="hidden" name="process" value="edit">
                        <input type="hidden" id="order" name="order" value='<?= json_encode($cart) ?>'>
                        <input type="hidden" id="cost" name="cost" value='<?= json_encode($transaction) ?>'>
                        <input type="hidden" id="input-cost" name="input-cost" value=''>
                        <input type="hidden" name="id" value="<?= $id ?>">

                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Transaction Order</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Package Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider text-center">
                                    <?php
                                    $numb = 0;
                                    foreach ($cart as $key => $value) {
                                        // FIXME: format total price into rupiah
                                        $numb++;
                                        $deleteEnable = ($transaction["dibayar"] == "dibayar") ? "d-none" : "";
                                        $nama_paket = $packageName[$key]["nama_paket"];
                                        $id_paket = $value["id"];
                                        $harga_paket = $value["harga_paket"];
                                        $qty = $value["qty"];
                                        $totalHarga = $value["total_harga"];
                                        $keteranganNotes = $value["keterangan"];
                                        echo "<tr>
                        <th scope='row'>$numb</th>
                        <th class='text-start'>$nama_paket</a></th>
                        <td class='currencyFormatRupiah'>$harga_paket</td>
                        <td>$qty</td>
                        <td class='currencyFormatRupiah'>$totalHarga</td>
                        <td width='250ch'>$keteranganNotes</td>
                        <td>
                            <a type='button' class='btn btn-sm btn-danger $deleteEnable' data-bs-toggle='modal' data-bs-target='#modalDelete$id_paket'>
                            <svg class='bi pe-none' width='24' height='24'>
                                <use xlink:href='#delete' />
                            </svg>
                        </a>
                        </td>
                    </tr>
                    <div class='modal fade' id='modalDelete$id_paket' tabindex='-1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title fs-5'>Delete Confirmation</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <h6>Are you sure you want to delete <span class='fw-bolder'>$nama_paket</span> ?</h6>
                                <h6>This change is irreversible</h6>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Cancel</button>
                                <button type='submit' class='btn btn-danger' onclick='updateCart($numb)'>Delete</button>
                            </div>
                        </div>
                    </div>
                </div>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- TODO: implement autoNumeric -->
                        <div class="p-3">
                            <div class="row mb-2 d-flex align-items-center justify-content-between">
                                <div class="col-md-3">Sub Total </div>
                                <div class="col-md-9 d-flex justify-content-between"><span>:</span> <span id="sub-total">0</span></div>
                            </div>
                            <div id="additional-cost" class="row mb-2 d-flex align-items-center justify-content-between">
                                <div class="col-md-3"><label for="transaction-pay">Additional Cost</label> </div>
                                <div class="col-md-9 d-flex justify-content-between pe-0">
                                    <input type="text" class="form-control text-end" id="input-additionalCost" name="input-additionalCost" oninput="calculateCart()" value="<?= $transaction["biaya_tambahan"] ?>" <?= ($transaction["dibayar"] == "dibayar") ? "disabled" : "" ?>>
                                </div>
                            </div>
                            <div class="row mb-2 align-items-center justify-content-between">
                                <div class="col-md-3">Discount </div>
                                <div class="col-md-9 d-flex justify-content-between"><span>:</span> <span id="discount"><?= $transaction["diskon"] ?></span></div>
                            </div>
                            <div class="row mb-2 align-items-center justify-content-between">
                                <div class="col-md-3">Tax </div>
                                <div class="col-md-9 d-flex justify-content-between"><span>:</span> <span id="tax"><?= $transaction["pajak"] ?></span></div>
                            </div>
                            <hr>
                            <div class="row mb-2 align-items-center justify-content-between mb-3">
                                <div class="col-md-3 fw-bolder">Total </div>
                                <div class="col-md-9 d-flex justify-content-between fw-bolder"><span>:</span> <span id="total"><?= $totalTransaction ?></span></div>
                            </div>
                            <div id="payment" class="row mb-2 align-items-center justify-content-between">
                                <div class="col-md-3"><label for="transaction-pay">Payment</label> </div>
                                <!-- FIXME: make payment to only require more money instead of total money paid -->
                                <div class="col-md-9 d-flex justify-content-between pe-0">
                                    <input type="text" class="form-control text-end" id="input-payment" oninput="calculateCart()" value="0" <?= ($transaction["dibayar"] == "dibayar") ? "disabled" : "" ?>>
                                </div>
                            </div>
                            <div class="row mb-2 align-items-center justify-content-between">
                                <div class="col-md-3 fw-bolder">Change: </div>
                            </div>
                            <hr>
                            <div class="row mb-2 align-items-center justify-content-end">
                                <div>
                                    <h3 class="fw-bolder text-end" id="change">0</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="../js/autoNumericFormat.js"></script>
<script src="../js/editTransaction.js"></script>