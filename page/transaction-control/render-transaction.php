<?php
require_once "../../php/connect.php";

$cart = json_decode($_POST["cart"], false);
foreach ($cart as $order => $value) {

    $query = mysqli_query($conn, "SELECT jenis, nama_paket, harga FROM paket WHERE id=$value->packageID;");
    $package = mysqli_fetch_assoc($query);

    echo "<tr id='order-$value->packageID'>
    <th scope='row'>$value->packageID</th>
    <td class='text-start'>" . $package["nama_paket"] . "</td>
    <td>" . $package["jenis"] . "</td>
    <td>" . $package["harga"] . "</td>
    <td>" . $value->quantity . "</td>
    <td>" . $package["harga"] * $value->quantity . "</td>
    <td><a type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalDelete$value->packageID'>
            <svg class='bi pe-none' width='24' height='24'>
                <use xlink:href='#delete' />
            </svg>
        </a></td>
    </tr>
    <div class='modal fade' id='modalDelete$value->packageID' tabindex='-1'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h1 class='modal-title fs-5'>Delete Confirmation</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                <h6>Are you sure you want to delete <span class='fw-bolder'>" . $package["nama_paket"] . "</span> ?</h6>
                <h6>This change is irreversible</h6>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='submit' class='btn btn-danger' data-bs-dismiss='modal' onclick='deleteCartOrder($value->packageID)'>Delete</button>
            </div>
        </div>
    </div>
</div>
    ";
}
