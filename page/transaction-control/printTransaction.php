<?php
if (($_SESSION['role'] == "kasir")) {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../page/page.php?page=transactions';</script>";
    exit();
}
?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="search" viewBox="0 0 24 24">
        <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5q0-1.875-1.312-3.187T9.5 5Q7.625 5 6.313 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14" />
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
            <div class="card-header p-3">
                <h6 class="m-0 font-weight-bold">Transaction Order</h6>
            </div>
            <div class="card-body">
                <!-- TODO: implement filtering option -->
                <div class="card shadow">
                    <div class="card-header p-3">
                        <h6 class="m-0 font-weight-bold">Filter Option</h6>
                    </div>
                    <div class="card-body">
                        <input type="text" name="input-dateRange" class="form-control flatpickr flatpickr-input datePicker col-8" placeholder="Select Transaction Date Range" id="input-dateRange" required>
                        <button class="btn btn-primary text-light" onclick="showTransaction()">
                            <svg class='bi pe-none' width='24' height='24'>
                                <use xlink:href='#search' />
                            </svg>
                        </button>
                    </div>
                </div>
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
                        <tbody class="table-group-divider text-center" id="transaction-table-body">
                            <!-- FIXME: column and data wont align -->
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
<!-- <script src="../js/autoNumericFormat.js"></script> -->
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.0/b-3.0.0/b-html5-3.0.0/datatables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script> <!-- for print -->
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>

<script src="../js/autoNumericFormat.js"></script>
<script src="../js/generateReport.js"></script>

<script>
    function getToday() {
        let date = new Date();
        let today = `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()} ${date.getHours()}:${(date.getMinutes() < 10 ? '0' : '') + date.getMinutes()}`;
        return today;
    }
    $(document).ready(function() {
        $("#dataTable").DataTable({
            // data: myData,
            columns: [{
                    data: '#'
                },
                {
                    data: 'Date of Transaction'
                },
                {
                    data: 'Invoice Code'
                },
                {
                    data: 'Customer'
                },
                {
                    data: 'Payment Date'
                },
                {
                    data: 'Additional Cost'
                },
                {
                    data: 'Discount'
                },
                {
                    data: 'Tax'
                },
                {
                    data: 'Change'
                },
                {
                    data: 'Status'
                },
                {
                    data: 'Payment'
                },
                {
                    data: 'Cashier'
                },
            ],
            scrollX: true,
            responsive: true,
            // autoWidth: true,
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
                // targets: [0],
                visible: false
            }]
        });
    });
</script>