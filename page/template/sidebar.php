<div id="sidebar" class="position-fixed d-md-flex d-none flex-column flex-shrink-0 bg-body-secondary <?php if ($_SESSION['role'] != "admin") {
                                                                                                            echo "d-none";
                                                                                                        } ?>" style="width: 3.5rem;">
    <!-- TODO: add offcanvas sidebar -->
    <a href="#" class="d-block p-3 link-body-emphasis text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right">
        <svg class="bi pe-none" width="28" height="28">
            <use xlink:href="#logo" />
        </svg>
    </a>

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item">
            <a href="#" class="nav-link py-3 border-bottom rounded-0" title="Outlets" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#outlets" />
                </svg>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0" title="Packages" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#packages" />
                </svg>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0" title="Customer" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#customer" />
                </svg>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0" title="Register User" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#registerUser" />
                </svg>
            </a>
        </li>
    </ul>
</div>