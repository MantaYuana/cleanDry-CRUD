<?php
require "../connect.php";

$id = $_POST['id'];
$name = $_POST['register-name'];
$telp = $_POST['register-telp'];
$alamat = $_POST['register-alamat'];
$process = $_POST['process'];

$query_name = mysqli_query($conn, "SELECT nama FROM outlet WHERE nama='$name';");
$cek = mysqli_num_rows($query_name);

if ($process == "register") {
    if ($cek != 0) {
        echo "<script>alert('Outlet name already exists, please chose another name !'); window.location.href = '../../page/page.php?page=register-outlet'; </script>";
    } else {
        $hasil = mysqli_query($conn, "INSERT INTO outlet VALUES (NULL, '$name', '$alamat', '$telp');");

        // TODO: implement cross page message transfer (like in task-manager)
        if (!$hasil) {
            echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-outlet';</script>";
        } else {
            echo "<script>alert('Register success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
            exit;
        }
    }
} elseif ($process == "edit") {
    $hasil = mysqli_query($conn, "UPDATE outlet SET nama='$name', alamat='$alamat', telp='$telp' WHERE id=$id;");

    if (!$hasil) {
        echo "<script>alert('Edit Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=edit-outlet&idOutlet=$id';</script>";
    } else {
        echo "<script>alert('Edit success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
        exit;
    }
}
