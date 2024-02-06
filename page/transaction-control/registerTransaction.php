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
            <div class="border-top p-2">
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
                <div id="transaction-item" class="border p-3 d-flex flex-row justify-content-between">
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
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <p>Price: <span id="transaction-harga">-</span></p>
                        </div>
                        <div class="mb-3 input-group align-items-center">
                            <label for="transaction-quantity" class="form-label me-2">Quantity: </label>
                            <input type="text" list="outletOptions" name="transaction-quantity" class="form-control" id="transaction-quantity" oninput="updateTotal()" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <p>Total: <span id="transaction-total">-</span></p>
                        </div>
                        <div class="mb-3">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center" id="transaction-table-body">

                    </tbody>
                </table>


                <form action="../php/helper/transaction_process.php" method="post" id="transaction">
                    <button type="submit" class="btn btn-primary text-light p-2">Submit</button>
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

<script>
    const messageModal = new bootstrap.Modal(document.getElementById('modal-message'), {
        show: true
    })
    const toggleMessageModal = document.getElementById('toggleMyModal');
    const xhttp = new XMLHttpRequest();
    let cart = [];

    function updateTotal() {
        document.getElementById("transaction-total").innerHTML = document.getElementById("transaction-harga").innerHTML * document.getElementById("transaction-quantity").value;
    }

    function updateInfo() {
        const customer = document.getElementById("transaction-name").value;
        const package = document.getElementById("transaction-package").value;

        xhttp.onload = function() {
            let response = JSON.parse(this.response);

            if ((response.telp != null) && (response.alamat != null)) {
                document.getElementById("transaction-telp").value = response.telp;
                document.getElementById("transaction-alamat").value = response.alamat;
            }

            if (response.nama_paket != null && response.harga != null) {
                document.getElementById("transaction-paket").innerHTML = response.nama_paket;
                document.getElementById("transaction-harga").innerHTML = response.harga;
            }
        };

        xhttp.open("POST", "transaction-control/stage-transaction.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("customer=" + customer + "&package=" + package);
    }

    function updateCart() {
        const packageID = document.getElementById("transaction-package").value;
        const quantity = document.getElementById("transaction-quantity").value;

        if (packageID != 0 && quantity != 0) {
            let checkOrder = false;
            cart.forEach(element => {
                if (element["packageID"] == packageID) {
                    checkOrder = true;
                }
            });

            if (checkOrder == false) {
                let order = {
                    "packageID": `${packageID}`,
                    "quantity": `${quantity}`
                };
                cart.push(order);
                showCart();
            } else {
                // TODO: change modal into Toasts
                document.getElementById("modal-message-title").innerHTML = "Error !";
                document.getElementById("modal-message-body").innerHTML = "Cannot add the same type of package twice !"
                messageModal.show(toggleMessageModal);
            }
        } else {
            // TODO: change modal into Toasts
            document.getElementById("modal-message-title").innerHTML = "Warning !";
            document.getElementById("modal-message-body").innerHTML = "Please enter package ID and quantity !"
            messageModal.show(toggleMessageModal);

        }
    }

    function showCart() {
        const transactionTable = document.getElementById("transaction-table-body");

        xhttp.onload = function() {
            transactionTable.innerHTML = this.response;
        };
        xhttp.open("POST", "transaction-control/render-transaction.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("cart=" + JSON.stringify(cart));
    }

    function deleteCartOrder(order) {
        let orderIndex = 0;
        let temp = cart;
        temp.forEach(element => {
            if (element["packageID"] == order) {
                return;
            }
            orderIndex++;
        });
        cart.splice(orderIndex, 1);
        showCart();
    }
</script>