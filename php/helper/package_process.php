<?php
require "../connect.php";
session_start();

$process = $_POST['process']; 
@$id = $_POST['id'];
@$name = $_POST['register-name'];
@$jenis = $_POST['register-jenis'];
@$harga = $_POST['register-harga'];

if ($process == "register") {
    $query_name = mysqli_query($conn, "SELECT nama_paket FROM paket WHERE nama_paket='$name';");
    $cek = mysqli_num_rows($query_name);

    if ($cek != 0) {
        echo "<script>alert('Package name already exists, please chose another name !'); window.location.href = '../../page/page.php?page=register-package'; </script>";
    } else {
        $id_outlet = $_SESSION["outlet"]["id"];
        $res = mysqli_query($conn, "INSERT INTO paket VALUES (NULL, $id_outlet, '$jenis', '$name', '$harga');");

        // TODO: implement cross page message transfer (like in task-manager)
        if (!$res) {
            echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-package';</script>";
        } else {
            echo "<script>alert('Register success !'); window.location.href = '../../page/page.php?page=packages';</script>";
            exit;
        }
    }
} elseif ($process == "edit") {
    $res = mysqli_query($conn, "UPDATE paket SET jenis='$jenis', nama_paket='$name', harga='$harga' WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Edit Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=edit-package&idPackage=$id';</script>";
    } else {
        echo "<script>alert('Edit success !'); window.location.href = '../../page/page.php?page=packages';</script>";
        exit;
    }
} elseif ($process == "destroy") {
    $res = mysqli_query($conn, "DELETE FROM paket WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Delete Failed: " . mysqli_error($conn) . "');</script>";
    } else {
        echo "<script>alert('Delete success !'); window.location.href = '../../page/page.php?page=packages';</script>";
        exit;
    }
} else {
    echo "<script>alert('Unknown Process, contact admin'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit;
}
