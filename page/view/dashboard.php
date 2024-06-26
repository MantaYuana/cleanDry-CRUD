<section id="dashboard">

    <div id="dashboard-chart" class="container">
        <br>
        <div class="page-heading d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mt-3">Outlet <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h5>
                <h6>Welcome <span class="fw-bolder"><?= ucwords($_SESSION['role']) ?> <?= $_SESSION['username'] ?></span></h6>
            </div>
        </div>
        <br>

        <div class="d-flex flex-row justify-content-between mb-3 flex-fill">
            <div id="order-stats" class="col-4 border rounded-3 p-3 me-3">
                <h6>Annual Order Status Details</h6>
                <div class="container d-flex flex-column align-items-center">
                    <!-- TODO: make canvas responsive or maybe use google chart-->
                    <div style="width: 15vw"><canvas id="order"></canvas></div>
                </div>
            </div>

            <div id="loyal-stats" class="col-4 border rounded-3 p-3 me-3">
                <h6>This Month Most Sold Package</h6>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 1; $i < min((count($dataPackage)), 5); $i++) {
                            $index = (array_keys($dataPackage)[$i]);
                            $type = $dataPackage['packageType'][$i - 1];
                            $numb = $i;
                            echo "<tr>
                                    <th scope='row'>$numb</th>
                                    <td>$index</td>
                                    <td>$type</td>
                                    <td>$dataPackage[$index]</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="latest-stats" class="col-4 border rounded-3 p-3">
                <h6>Latest Transaction</h6>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Package</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataLatestTransaction as $latestTransacton => $ordervalue) {
                            echo "<tr>
                            <td>$ordervalue[0]</td>
                            <td>$ordervalue[1]</td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- FIXME: parent container on second row not aligned properly with parent container on first row -->
        <div class="d-flex flex-row justify-content-between flex-fill flex-grow-1">
            <div class="col-8 p-3 border rounded-3 me-3">
                <h6>Sales by Month</h6>
                <div style="width: 100%;"><canvas id="sales"></canvas></div>
            </div>

            <div class="col-4 d-flex flex-column align-content-stretch">
                <div id="paid-unpaid-stats" class="p-3 border rounded-3 mb-3 flex-grow-1">
                    <h6>Paid/Unpaid Order (monthly)</h6>
                    <p class="display-6 text-center"><span class="text-success fw-semibold"><?= $dataCount["paid"] ?></span>/<span class="text-danger fw-semibold"><?= $dataCount["unpaid"] ?></span></p>
                </div>
                <div id="tax-stats" class="p-3 border rounded-3 mb-3 flex-grow-1">
                    <h6>Total Tax (monthly)</h6>
                    <p class="display-6 fw-semibold text-secondary text-center currencyFormatRupiah"><?= $dataCount["tax"] ?></p>
                </div>
                <div id="revenue-stats" class="p-3 border rounded-3 mb-3 flex-grow-1">
                    <h6>Current Monthly Revenue</h6>
                    <p class="display-6 fw-semibold text-secondary text-center currencyFormatRupiah"><?= $dataRevenue ?></p>
                </div>
            </div>

        </div>
    </div>

</section>

<script src="../js/autoNumericFormat.js"></script>