<?php
if ($_SESSION['role'] != "admin") {
    echo "<script>alert('You are not premitted into the Page !'); window.location.href = '../page/page.php?page=dashboard';</script>";
    exit();
}

$outlet = $_SESSION['outlet']['id'];
$query = mysqli_query($conn, "SELECT * FROM paket WHERE id_outlet=$outlet;");
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

<section id="packages">
    <div class="container">
        <br>
        <div class="page-heading d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mt-3">Admin Menu - <span class="fw-bolder text-decoration-underline"><?= $_SESSION['outlet']['nama'] ?>,</span></h6>
                <h2 class="fw-medium" style="color: var(--mc-green-dark);">Configure <span class="fw-bolder" style="color: var(--mc-green-dark-mono);">Packages</span></h2>
            </div>
            <div>
                <button type="button" class="btn btn-primary p-2 ps-5 pe-5"><a class="link-underline link-light link-underline-opacity-0" href="../page/page.php?page=register-package">Add Package</a></button>
            </div>
        </div>
        <br>

        <div class="card shadow mb-4">
            <div class="card-header p-3">
                <h6 class="m-0 font-weight-bold">List of Packages</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle nowrap" id="dataTable">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $numb = 0;
                            foreach ($res as $key => $value) {
                                $numb++;
                                switch ($value[2]) {
                                    case 'kiloan':
                                        $value[2] = "by weight";
                                        break;
                                    case 'selimut':
                                        $value[2] = "Blanket";
                                        break;
                                    case 'bed_cover':
                                        $value[2] = "Bed Cover";
                                        break;
                                    case 'kaos':
                                        $value[2] = "Shirt";
                                        break;
                                    case 'lain':
                                        $value[2] = "Other";
                                        break;

                                    default:
                                        $value[2] = "error type";
                                        break;
                                }

                                echo "<tr>
                            <th class='text-center' scope='row'>$numb</th>
                            <td>$value[3]</td>
                            <td>$value[2]</td>
                            <td class='currencyFormatRupiah'>$value[4]</td>
                            <td class='text-center'>
                                <a type='button' class='btn btn-warning me-3' href='../page/page.php?page=edit-package&idPackage=$value[0]'>
                                    <svg class='bi pe-none' width='24' height='24'>
                                        <use xlink:href='#edit' />
                                    </svg>
                                </a><a type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalDelete$value[0]'>
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
                                        <h6>Are you sure you want to delete <span class='fw-bolder'>$value[3]</span> ?</h6>
                                        <h6>This change is irreversible</h6>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Cancel</button>
                                        <form action='../php/helper/package_process.php' method='POST'>
                                            <input type='hidden' name='process' value='destroy'>
                                            <input type='hidden' name='id' value='$value[0]'>
                                            <button type='submit' class='btn btn-danger'>Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../node_modules/jquery/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../js/autoNumericFormat.js"></script>
<script src="../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable({
            columnDefs: [{
                orderable: false,
                targets: 4
            }],
        });
    });
</script>