<section id="navbar" class="sticky-top">
    <nav class="navbar navbar-expand-md" style="background-color: var(--mc-green-dark);">
        <div class="container-fluid">
            <h4 class="text-light fw-bolder me-5">
                <a class="link-light link-offset-2 link-underline link-underline-opacity-0" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 50 50">
                        <rect x="0" y="0" width="50" height="50" fill="none" stroke="none" />
                        <path fill="currentColor" d="M6 11v33.74C6 46.21 7.237 48 8.76 48h33.218C43.497 48 45 46.21 45 44.74V11zm19.46 26.776c-5.86 0-10.611-4.594-10.611-10.263S19.6 17.25 25.46 17.25s10.611 4.594 10.611 10.263c0 5.67-4.751 10.263-10.611 10.263M41.978 1H8.76C7.237 1 6 2.033 6 3.505V9h39V3.505C45 2.033 43.497 1 41.978 1M19 7H8V3h11zm19.146-.28c-1.249 0-2.258-.979-2.258-2.188c0-1.207 1.009-2.186 2.258-2.186s2.261.979 2.261 2.186c-.001 1.208-1.012 2.188-2.261 2.188" />
                    </svg> CleanDry.
                </a>
            </h4>
            <!-- NOTE: maybe move navbar menu to side bar and add outlet name to navbar instead -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapsed">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-none" id="navbarCollapsed">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- TODO: add active class into active page -->
                    <li class="nav-item me-md-3">
                        <a class="<?php if ($_GET["page"] == "dashboard") {
                                        echo "active";
                                    } ?> nav-link fw-bolder p-md-2 ps-3" href="../page/page.php?page=dashboard">Overview</a>
                    </li>
                    <li class="nav-item me-md-3">
                        <a class="<?php if ($_GET["page"] == "customers") {
                                        echo "active";
                                    } ?> nav-link fw-bolder p-md-2 ps-3" href="../page/page.php?page=customers">Customer</a>
                    </li>
                    <li class="nav-item me-md-3">
                        <a class="<?php if ($_GET["page"] == "transaction") {
                                        echo "active";
                                    } ?> nav-link fw-bolder p-md-2 ps-3" href="../page/page.php?page=transaction">Transaction</a>
                    </li>
                    <li class="<?php if ($_SESSION['role'] != "admin") {
                                    echo "d-none";
                                } ?> d-md-none nav-item dropdown me-md-3">
                        <a class="nav-link dropdown-toggle fw-bolder p-md-2 ps-3" href="../page.php?page=outlet" role="button" data-bs-toggle="dropdown">
                            Admin Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../page/page.php?page=outlets">Outlets</a></li>
                            <li><a class="dropdown-item" href="../page/page.php?page=packages">Packages</a></li>
                            <li><a class="dropdown-item" href="../page/page.php?page=users">Users</a></li>
                        </ul>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto me-5">
                    <?php
                    if ($_SESSION["role"] == "admin") {
                        $outlet = $_SESSION['outlet']['nama'];
                        echo "<span class='navbar-text text-light fw-bolder p-md-2 ps-3 me-3'>Outlet: $outlet</span>";
                    }  
                    ?>
                    <li class="nav-item">
                        <div class="dropdown">
                            <!-- QUESTION: is button bg color bad ? -->
                            <!-- FIXME: remove button background in navbar collapse mode -->
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32px" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z" />
                                        <path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9zM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75zM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9zM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25zM5.166 17.856l-.719-.214l-.117.392l.267.31zm13.668 0l.57.489l.266-.31l-.117-.393zM9 15.75h6v-1.5H9zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405z" />
                                    </g>
                                </svg>
                                <?= $_SESSION['username'] ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action='../php/helper/account_process.php' method='POST'>
                                        <input type='hidden' name='process' value='logout'>
                                        <button type='submit' class='btn dropdown-item'>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>