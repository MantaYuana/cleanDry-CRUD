<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="logo" viewBox="0 0 50 50">
        <rect x="0" y="0" fill="none" stroke="none" />
        <path fill="black" d="M6 11v33.74C6 46.21 7.237 48 8.76 48h33.218C43.497 48 45 46.21 45 44.74V11zm19.46 26.776c-5.86 0-10.611-4.594-10.611-10.263S19.6 17.25 25.46 17.25s10.611 4.594 10.611 10.263c0 5.67-4.751 10.263-10.611 10.263M41.978 1H8.76C7.237 1 6 2.033 6 3.505V9h39V3.505C45 2.033 43.497 1 41.978 1M19 7H8V3h11zm19.146-.28c-1.249 0-2.258-.979-2.258-2.188c0-1.207 1.009-2.186 2.258-2.186s2.261.979 2.261 2.186c-.001 1.208-1.012 2.188-2.261 2.188" />
    </symbol>

    <symbol id="outlets" viewBox="0 0 32 32">
        <path fill="black" d="m30 10.68l-2-6A1 1 0 0 0 27 4H5a1 1 0 0 0-1 .68l-2 6A1.19 1.19 0 0 0 2 11v6a1 1 0 0 0 1 1h1v10h2V18h6v10h16V18h1a1 1 0 0 0 1-1v-6a1.19 1.19 0 0 0 0-.32M26 26H14v-8h12Zm2-10h-4v-4h-2v4h-5v-4h-2v4h-5v-4H8v4H4v-4.84L5.72 6h20.56L28 11.16Z" />
    </symbol>

    <symbol id="packages" viewBox="0 0 32 32">
        <g fill="black">
            <path d="M14.5 24.823v1.96c0 .22-.24.35-.43.24l-2.8-1.69a.663.663 0 0 1-.31-.56v-1.96c0-.22.24-.35.43-.24l2.8 1.69c.19.12.31.33.31.56" />
            <path d="M16.89 1.289h.003l10.921 6.642c.557.343.896.956.896 1.602v12.44c0 .936-.482 1.838-1.314 2.336l-10.543 6.406a1.903 1.903 0 0 1-1.996 0L4.311 24.307A2.733 2.733 0 0 1 3 21.973V9.533c0-.636.332-1.261.908-1.6l10.931-6.65a1.984 1.984 0 0 1 2.052.006m-1.03 1.714L6.083 8.95l3.51 2.145l9.79-5.951zm6.815 4.143l-9.805 5.952l3 1.832l9.905-5.898zM5 21.973c0 .259.137.496.35.625l9.513 5.78V16.659l-3.103-1.895v1.788c0 .24-.26.38-.46.27l-2.68-1.63a.314.314 0 0 1-.14-.26V12.76L5 10.634zm21.36.625l.008-.004a.724.724 0 0 0 .342-.622v-11.17l-9.847 5.865v11.702z" />
        </g>
    </symbol>

    <symbol id="customer" viewBox="0 0 24 24">
        <path fill="black" d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5M4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25zM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5S5.5 6.57 5.5 8.5S7.07 12 9 12m0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7m7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44M15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35c.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35" />
    </symbol>

    <symbol id="registerUser" viewBox="0 0 24 24">
        <path fill="black" d="M15 4a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4m0 1.9a2.1 2.1 0 1 1 0 4.2A2.1 2.1 0 0 1 12.9 8A2.1 2.1 0 0 1 15 5.9M4 7v3H1v2h3v3h2v-3h3v-2H6V7zm11 6c-2.67 0-8 1.33-8 4v3h16v-3c0-2.67-5.33-4-8-4m0 1.9c2.97 0 6.1 1.46 6.1 2.1v1.1H8.9V17c0-.64 3.1-2.1 6.1-2.1" />
    </symbol>
</svg>

<section id="dashboard">

    <div id="dashboard-chart" class="container">
        <br>
        <h5 class="mt-3">Outlet <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h5>
        <h6>Welcome <span class="fw-bolder"><?= ucwords($_SESSION['role']) ?> <?= $_SESSION['username'] ?></span></h6>
        <br>

        <div class="d-flex flex-row justify-content-between mb-3 flex-fill">
            <div id="order-stats" class="col-4 border rounded-3 p-3 me-3">
                <h6>Order Status Details</h6>
                <div class="container d-flex flex-column align-items-center">
                    <!-- TODO: make canvas responsive or maybe use google chart-->
                    <div style="width: 15vw"><canvas id="order"></canvas></div>
                </div>
            </div>

            <div id="loyal-stats" class="col-4 border rounded-3 p-3 me-3">
                <h6>Most Sold Package</h6>
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
                        <tr>
                            <th scope="row">1</th>
                            <td>Best Selling Shower</td>
                            <td>Full Clean</td>
                            <td>410</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Upside down row</td>
                            <td>Dry Clean</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Windmill</td>
                            <td>Full Clean</td>
                            <td>300</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>EZ Clean</td>
                            <td>Bulk Clean</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Windmill Extreme</td>
                            <td>Cleam & Detail</td>
                            <td>30</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="latest-stats" class="col-4 border rounded-3 p-3">
                <h6>Latest Transaction</h6>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Best Selling Shower</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Best Selling Shower</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Best Selling Shower</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>EZ Clean</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>Windmill Extreme</td>
                            <td>1</td>
                        </tr>
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
                    <h6>Paid/Unpaid Order</h6>
                    <p class="display-6 text-center"><span class="text-success fw-semibold"><?= $data["paid"] ?></span>/<span class="text-danger fw-semibold"><?= $data["unpaid"] ?></span></p>
                </div>
                <div id="tax-stats" class="p-3 border rounded-3 mb-3 flex-grow-1">
                    <h6>Total Tax</h6>
                    <p class="display-6 fw-semibold text-secondary text-center">Rp. <?= $data["tax"] ?></p>
                </div>
                <div id="revenue-stats" class="p-3 border rounded-3 mb-3 flex-grow-1">
                    <h6>Current Monthly Revenue</h6>
                    <p class="display-6 fw-semibold text-secondary text-center">Rp. 3.093.820</p>
                </div>
            </div>

        </div>
    </div>

</section>