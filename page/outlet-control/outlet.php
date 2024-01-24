<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM outlet;");
$res = mysqli_fetch_all($query);
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

<section id="outlets" class="bg-body-secondary vh-100">
    <div class="container">

        <br>
        <div class="page-heading d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mt-3">Admin <span class="fw-bolder text-decoration-underline">Menu</span></h6>
                <h2 class="fw-medium" style="color: var(--mc-green-dark);">Configure <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">Outlets</span></h2>
            </div>
            <div>
                <button type="button" class="btn btn-primary p-2 ps-5 pe-5"><a class="link-underline link-light link-underline-opacity-0" href="../page/page.php?page=register-outlet">Add Outlet</a></button>
            </div>
        </div>
        <br>

        <div class="table-responsive bg-white p-5 border rounded-4">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    foreach ($res as $key => $value) {
                        echo "<tr>
                        <th class='text-center' scope='row'>$value[0]</th>
                        <td>$value[1]";
                        if ($_SESSION["role"] == "admin") {
                            echo "<form action='../php/helper/outlet_process.php' method='POST'>
                                    <input type='hidden' name='process' value='outletSelect'>
                                    <input type='hidden' name='id' value='$value[0]'>
                                    <button type='submit' class='btn btn-primary text-light'>Select Outlet</button>
                                </form>";
                        }
                        echo "</td>
                        <td>$value[2]</td>
                        <td>$value[3]</td>
                        <td class='text-center'>
                            <a type='button' class='btn btn-warning me-3' href='../page/page.php?page=edit-outlet&idOutlet=$value[0]'>
                                <svg class='bi pe-none' width='24' height='24'>
                                    <use xlink:href='#edit' />
                                </svg>
                            </a>";
                        $available = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(id)
                        FROM outlet WHERE EXISTS
                        (SELECT id FROM paket WHERE id_outlet=$value[0]) OR 
                        EXISTS (SELECT id FROM user WHERE id_outlet=$value[0]);
                        "));
                        if ($available[0] == 0) {
                            echo "<a type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalDelete$value[0]'>
                            <svg class='bi pe-none' width='24' height='24'>
                                <use xlink:href='#delete' />
                            </svg>
                        </a>
                        </td>
                    </tr>
                    <div class='modal fade' id='modalDelete$value[0]' tabindex='-1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title fs-5'>Delete Confirmation</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <h6>Are you sure you want to delete <span class='fw-bolder'>$value[1]</span> ?</h6>
                                <h6>This change is irreversible</h6>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Cancel</button>
                                <form action='../php/helper/outlet_process.php' method='POST'>
                                    <input type='hidden' name='process' value='destroy'>
                                    <input type='hidden' name='id' value='$value[0]'>
                                    <button type='submit' class='btn btn-danger'>Delete</button>
                                </form>                                                                              
                            </div>
                        </div>
                    </div>
                </div>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>