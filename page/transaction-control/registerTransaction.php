<?php
$query = mysqli_query($conn, "SELECT id, nama FROM member;");
$member = mysqli_fetch_all($query);

$outlet = $_SESSION["outlet"]["id"];
$query = mysqli_query($conn, "SELECT id, nama_paket FROM paket WHERE id_outlet=$outlet;");
$paket = mysqli_fetch_all($query);
?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="delete" viewBox="0 0 24 24">
        <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
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
        </div>
        <br>

        <div class="border rounded-4 bg-white">
            <div class="rounded-top-4 pt-3 pb-1 d-flex justify-content-center bg-body-secondary">
                <h5>Transaction</h5>
            </div>

            <form action="../php/helper/transaction_process.php" method="post" id="transaction" onkeydown="if(event.keyCode === 13) {return false;}">
                <div class=" border-top p-2">
                    <div id="transaction-customer" class="border p-3 mb-3 d-flex flex-row justify-content-between">
                        <div class="col-5">
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-name" class="form-label me-2">Name </label>
                                <input type="text" list="optionTransactionName" name="transaction-name" class="form-control" id="transaction-name" onfocusout="updateInfo()" required>
                                <datalist id="optionTransactionName" required>
                                    <?php foreach ($member as $key => $value) {
                                        $val = $value[0];
                                        $name = $value[1];
                                        echo "<option value='$val'>$val - $name</option>";
                                    } ?>
                                </datalist>
                            </div>
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-telp" class="form-label me-2">Phone Number </label>
                                <input type="text" name="transaction-telp" class="form-control" id="transaction-telp" readonly>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-alamat" class="form-label me-2">Address </label>
                                <input type="text" name="transaction-alamat" class="form-control" id="transaction-alamat" readonly>
                            </div>
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-benefit" class="form-label me-2">Benefit </label>
                                <input type="text" name="transaction-benefit" class="form-control" id="transaction-benefit" readonly>
                            </div>
                        </div>
                    </div>
                    <div id="transaction-item" class="border p-3 pb-0 d-flex flex-row justify-content-between">
                        <div class="col-3">
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-package" class="form-label me-2">Package: </label>
                                <input type="text" list="optionTransactionPackage" name="transaction-package" class="form-control" id="transaction-package" required autocomplete="off" onfocusout="updateInfo()">
                                <!-- TODO: maybe use regex to only take the first 4 numbers -->
                                <datalist id="optionTransactionPackage" required>
                                    <?php foreach ($paket as $key => $value) {
                                        $val = $value[0];
                                        $name = $value[1];
                                        echo "<option value='$val'>$val - $name</option>";
                                    } ?>
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <p>Package Name: <span id="transaction-paket">-</span></p>
                            </div>
                            <div class="mb-3">
                                <p>Package Type: <span id="transaction-jenis">-</span></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-harga" class="form-label me-2">Price: </label>
                                <input type="text" name="transaction-harga" class="form-control" id="transaction-harga" readonly>
                            </div>
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-quantity" class="form-label me-2">Quantity: </label>
                                <input type="text" list="outletOptions" name="transaction-quantity" class="form-control" id="transaction-quantity" oninput="updateTotal()" required autocomplete="off" value="0">
                            </div>
                            <div class="mb-3">
                                <p>Total: <span id="transaction-total"></span></p>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mb-3 input-group align-items-center">
                                <label for="transaction-notes" class="form-label me-2">Notes: </label>
                                <textarea class="form-control" name="transaction-notes" id="transaction-notes"></textarea>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary text-light" onclick="updateCart()">Tambah +</button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <table class="table table-hover table-bordered align-middle">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Package Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider text-center" id="transaction-table-body">

                        </tbody>
                    </table>

                    <div class="border mb-3 d-flex flex-row">
                        <div class="col-6 p-3 border-end">
                            <div class="input-group mb-3">
                                <div class="col-md-2 d-flex align-items-center">
                                    <label for="transaction-deadline" class="form-label me-2">Deadline </label>
                                </div>
                                <div class="col-md-10">
                                    <input class="flatpickr flatpickr-input datePicker" name="input-deadline" type="text" placeholder="Select Date.." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-3">
                            <div class="row mb-2 d-flex align-items-center justify-content-between">
                                <div class="col-md-3">Sub Total </div>
                                <div class="col-md-9 d-flex justify-content-between"><span>:</span> <span id="sub-total">0</span></div>
                            </div>
                            <div id="additional-cost" class="row mb-2 d-flex align-items-center justify-content-between">
                                <div class="col-md-3"><label for="transaction-pay">Additional Cost</label> </div>
                                <div class="col-md-9 d-flex justify-content-between pe-0">
                                    <input type="text" class="form-control text-end" id="input-additionalCost" name="input-additionalCost" oninput="calculateCart()" value="0">
                                </div>
                            </div>
                            <div class="row mb-2 align-items-center justify-content-between">
                                <div class="col-md-3">Discount </div>
                                <div class="col-md-9 d-flex justify-content-between"><span>:</span> <span id="discount">0</span></div>
                            </div>
                            <div class="row mb-2 align-items-center justify-content-between">
                                <div class="col-md-3">Tax </div>
                                <div class="col-md-9 d-flex justify-content-between"><span>:</span> <span id="tax">0</span></div>
                            </div>
                            <hr>
                            <div class="row mb-2 align-items-center justify-content-between mb-3">
                                <div class="col-md-3 fw-bolder">Total </div>
                                <div class="col-md-9 d-flex justify-content-between fw-bolder"><span>:</span> <span id="total">0</span></div>
                            </div>
                            <div id="payment" class="row mb-2 align-items-center justify-content-between">
                                <div class="col-md-3"><label for="transaction-pay">Payment</label> </div>
                                <div class="col-md-9 d-flex justify-content-between pe-0">
                                    <input type="text" class="form-control text-end" id="input-payment" oninput="calculateCart()" value="0">
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

                    <input type="hidden" name="input-cart" id="input-cart" value="">
                    <input type="hidden" name="input-cost" id="input-cost" value="">
                    <input type="hidden" name="process" value="register">
                    <button type="submit" class="btn btn-primary text-light p-2" id="btn-submit" onclick="checkOrder()" disabled>Submit</button>
                    <a class="btn btn-outline-secondary p-2 ps-3 pe-3" href="../page/page.php?page=transactions">Back</a>
            </form>
        </div>
    </div>
    </div>
</section>

<div class="modal" tabindex="-1" id="modal-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-message-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-message-body">Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/transaction.js"></script>