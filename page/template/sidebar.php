<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="logo" viewBox="0 0 50 50">
        <rect x="0" y="0" fill="none" stroke="none" />
        <path fill="white" d="M6 11v33.74C6 46.21 7.237 48 8.76 48h33.218C43.497 48 45 46.21 45 44.74V11zm19.46 26.776c-5.86 0-10.611-4.594-10.611-10.263S19.6 17.25 25.46 17.25s10.611 4.594 10.611 10.263c0 5.67-4.751 10.263-10.611 10.263M41.978 1H8.76C7.237 1 6 2.033 6 3.505V9h39V3.505C45 2.033 43.497 1 41.978 1M19 7H8V3h11zm19.146-.28c-1.249 0-2.258-.979-2.258-2.188c0-1.207 1.009-2.186 2.258-2.186s2.261.979 2.261 2.186c-.001 1.208-1.012 2.188-2.261 2.188" />
    </symbol>

    <symbol id="outlets" viewBox="0 0 32 32">
        <path fill="white" d="m30 10.68l-2-6A1 1 0 0 0 27 4H5a1 1 0 0 0-1 .68l-2 6A1.19 1.19 0 0 0 2 11v6a1 1 0 0 0 1 1h1v10h2V18h6v10h16V18h1a1 1 0 0 0 1-1v-6a1.19 1.19 0 0 0 0-.32M26 26H14v-8h12Zm2-10h-4v-4h-2v4h-5v-4h-2v4h-5v-4H8v4H4v-4.84L5.72 6h20.56L28 11.16Z" />
    </symbol>

    <symbol id="packages" viewBox="0 0 32 32">
        <g fill="white">
            <path d="M14.5 24.823v1.96c0 .22-.24.35-.43.24l-2.8-1.69a.663.663 0 0 1-.31-.56v-1.96c0-.22.24-.35.43-.24l2.8 1.69c.19.12.31.33.31.56" />
            <path d="M16.89 1.289h.003l10.921 6.642c.557.343.896.956.896 1.602v12.44c0 .936-.482 1.838-1.314 2.336l-10.543 6.406a1.903 1.903 0 0 1-1.996 0L4.311 24.307A2.733 2.733 0 0 1 3 21.973V9.533c0-.636.332-1.261.908-1.6l10.931-6.65a1.984 1.984 0 0 1 2.052.006m-1.03 1.714L6.083 8.95l3.51 2.145l9.79-5.951zm6.815 4.143l-9.805 5.952l3 1.832l9.905-5.898zM5 21.973c0 .259.137.496.35.625l9.513 5.78V16.659l-3.103-1.895v1.788c0 .24-.26.38-.46.27l-2.68-1.63a.314.314 0 0 1-.14-.26V12.76L5 10.634zm21.36.625l.008-.004a.724.724 0 0 0 .342-.622v-11.17l-9.847 5.865v11.702z" />
        </g>
    </symbol>

    <symbol id="users" viewBox="0 0 24 24">
        <path fill="none" stroke="white" stroke-width="2" d="M8 11A5 5 0 1 0 8 1a5 5 0 0 0 0 10Zm5.023 2.023C11.772 11.76 10.013 11 8 11c-4 0-7 3-7 7v5h7m2-3.5a2.5 2.5 0 1 0 5.002-.002A2.5 2.5 0 0 0 10 19.5zM23 15l-3-3l-6 6m3.5-3.5l3 3z" />
    </symbol>

    <symbol id="members" viewBox="0 0 24 24">
        <path fill="white" d="M7.5 9a3 3 0 1 0 0-6a3 3 0 0 0 0 6m0-1.5a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3M3 11.75c0-.966.784-1.75 1.75-1.75h5.5c.966 0 1.75.784 1.75 1.75v4.75a4.5 4.5 0 1 1-9 0zm1.75-.25a.25.25 0 0 0-.25.25v4.75a3 3 0 1 0 6 0v-4.75a.25.25 0 0 0-.25-.25zm5.777-2.886a3 3 0 1 0 0-5.229c.327.378.584.818.752 1.3a1.5 1.5 0 1 1 0 2.631a3.995 3.995 0 0 1-.752 1.298m.333 12.24A4.5 4.5 0 0 0 16.5 16.5v-4.75A1.75 1.75 0 0 0 14.75 10h-2.38c.343.415.566.933.618 1.5h1.76a.25.25 0 0 1 .25.25v4.75a3 3 0 0 1-2.887 2.998c-.339.52-.762.978-1.252 1.356m4.167-12.24a3 3 0 1 0 0-5.229c.327.378.584.818.752 1.3a1.5 1.5 0 1 1 0 2.631a3.995 3.995 0 0 1-.752 1.298m.333 12.24A4.5 4.5 0 0 0 21 16.5v-4.75A1.75 1.75 0 0 0 19.25 10h-2.38c.343.415.567.933.618 1.5h1.76a.25.25 0 0 1 .25.25v4.75a3 3 0 0 1-2.887 2.998c-.339.52-.762.978-1.252 1.356" />
    </symbol>
</svg>

<div id="sidebar" style="background-color: var(--mc-green-dark-mono);" class="vh-100 position-fixed <?= ($_SESSION['role'] != "admin") ? "d-none" : "d-md-flex" ?> d-none flex-column flex-shrink-0" style="width: 3.5rem;">
    <!-- TODO: add offcanvas sidebar -->
    <!-- TODO: add active page -->
    <a href="#" class="d-block p-3 link-body-emphasis text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right">
        <svg class="bi pe-none" width="28" height="28">
            <use xlink:href="#logo" />
        </svg>
    </a>

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item">
            <a href="../page/page.php?page=outlets" class="nav-link py-3 border-bottom rounded-0" title="Outlets" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#outlets" />
                </svg>
            </a>
        </li>
        <li>
            <a href="../page/page.php?page=packages" class="nav-link py-3 border-bottom rounded-0" title="Packages" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#packages" />
                </svg>
            </a>
        </li>
        <li>
            <a href="../page/page.php?page=users" class="nav-link py-3 border-bottom rounded-0" title="Users" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#users" />
                </svg>
            </a>
        </li>
        <li>
            <a href="../page/page.php?page=members" class="nav-link py-3 border-bottom rounded-0" title="Members" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24">
                    <use xlink:href="#members" />
                </svg>
            </a>
        </li>
    </ul>
</div>