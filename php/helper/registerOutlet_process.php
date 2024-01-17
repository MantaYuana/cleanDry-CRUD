<?php
require "../connect.php";

$name = $_POST['register-name'];
$telp = $_POST['register-telp'];
$alamat = $_POST['register-alamat'];

$query_name = mysqli_query($conn, "SELECT nama FROM outlet WHERE nama='$name';");
$cek = mysqli_num_rows($query_name);

if ($cek != 0) {
    echo "<script>alert('Outlet name already exists, please chose another name !'); window.location.href = '../../page/page.php?page=register-outlet'; </script>";
} else {
    $hasil = mysqli_query($conn, "INSERT INTO outlet VALUES (NULL, '$name', '$alamat', '$alamat');");

    // TODO: implement cross page message transfer (like in task-manager)
    if (!$hasil) {
        echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-outlet';</script>";
    } else {
        echo "<script>alert('Register success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
        exit;
    }
}
