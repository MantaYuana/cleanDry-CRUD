<?php
require "../connect.php";
session_start();

@$id = $_POST['id'];
@$name = $_POST['register-name'];
@$telp = $_POST['register-telp'];
@$alamat = $_POST['register-alamat'];
$process = $_POST['process'];

$query_name = mysqli_query($conn, "SELECT nama FROM outlet WHERE nama='$name';");
$cek = mysqli_num_rows($query_name);

if ($process == "register") {
    if ($cek != 0) {
        echo "<script>alert('Outlet name already exists, please chose another name !'); window.location.href = '../../page/page.php?page=register-outlet'; </script>";
    } else {
        $res = mysqli_query($conn, "INSERT INTO outlet VALUES (NULL, '$name', '$alamat', '$telp');");

        // TODO: implement cross page message transfer (like in task-manager)
        if (!$res) {
            echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-outlet';</script>";
        } else {
            echo "<script>alert('Register success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
            exit;
        }
    }
} elseif ($process == "edit") {
    $res = mysqli_query($conn, "UPDATE outlet SET nama='$name', alamat='$alamat', telp='$telp' WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Edit Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=edit-outlet&idOutlet=$id';</script>";
    } else {
        echo "<script>alert('Edit success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
        exit;
    }
} elseif ($process == "destroy") {
    $res = mysqli_query($conn, "DELETE FROM outlet WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Delete Failed: " . mysqli_error($conn) . "');</script>";
    } else {
        if ($_SESSION["outlet"]["id"] == $id) {
            echo "<script>alert('Delete success !');alert('You have been logged out due to your outlet being removed !'); window.location.href = '../../page/page.php?page=login';</script>";
            session_destroy();
        }else{
            echo "<script>alert('Delete success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
        }
        exit;
    }
} elseif ($process == "outletSelect") {
    $res = mysqli_query($conn, "SELECT * FROM outlet WHERE id='$id';");

    if (!$res) {
        echo "<script>alert('Select Outlet Failed: " . mysqli_error($conn) . "window.location.href = '../../page/page.php?page=outlets');</script>";
    } else {
        $_SESSION["outlet"] = mysqli_fetch_assoc($res);
        echo "<script>alert('Select Outlet success !'); window.location.href = '../../page/page.php?page=outlets';</script>";
        exit;
    }
} else {
    echo "<script>alert('Unknown Process, contact admin'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit;
}
