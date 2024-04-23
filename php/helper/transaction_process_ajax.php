<?php 
if ($process == "destroyOrder") {
    $id = $_POST['orderID'];
    $res = mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Delete Failed: " . mysqli_error($conn) . "');</script>";
    } else {
        print_r($_POST);
        echo "<script>alert('Delete success !'); window.location.href = '../../page/page.php?page=transactions';</script>";
        exit;
    }
}
