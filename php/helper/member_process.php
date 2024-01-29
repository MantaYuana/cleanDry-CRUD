<?php
require "../connect.php";
session_start();

@$id = $_POST['id'];
@$name = $_POST['register-name'];
@$telp = $_POST['register-telp'];
@$alamat = $_POST['register-alamat'];
@$kelamin = $_POST['register-kelamin'];
$process = $_POST['process'];

$query_name = mysqli_query($conn, "SELECT nama FROM member WHERE nama='$name';");
$cek = mysqli_num_rows($query_name);

if ($process == "register") {
    if ($cek != 0) {
        echo "<script>alert('Member name already exists, please chose another name !'); window.location.href = '../../page/page.php?page=register-member'; </script>";
    } else {
        $res = mysqli_query($conn, "INSERT INTO member VALUES (NULL, '$name', '$alamat', '$kelamin', '$telp');");

        // FIXME: if not admin go to dashboard
        // TODO: implement cross page message transfer (like in task-manager)
        if (!$res) {
            echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-member';</script>";
            // if ($_SESSION["role"] == "admin") {
            //     echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-member';</script>";
            // }else{
            //     echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=register-member';</script>";
            // }
        } else {
            if ($_SESSION["role"] == "admin") {
                echo "<script>alert('Register success !'); window.location.href = '../../page/page.php?page=members';</script>";
            } else {
                echo "<script>alert('Register success !'); window.location.href = '../../page/page.php?page=dashboard';</script>";
            }
            exit;
        }
    }
} elseif ($process == "edit") {
    $res = mysqli_query($conn, "UPDATE member SET nama='$name', alamat='$alamat', kelamin='$kelamin', telp='$telp' WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Edit Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=edit-member&idmember=$id';</script>";
    } else {
        echo "<script>alert('Edit success !'); window.location.href = '../../page/page.php?page=members';</script>";
        exit;
    }
} elseif ($process == "destroy") {
    $res = mysqli_query($conn, "DELETE FROM member WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Delete Failed: " . mysqli_error($conn) . "');</script>";
    } else {
        echo "<script>alert('Delete success !'); window.location.href = '../../page/page.php?page=members';</script>";
        exit;
    }
} elseif ($process == "memberSelect") {
    $res = mysqli_query($conn, "SELECT * FROM member WHERE id='$id';");

    if (!$res) {
        echo "<script>alert('Select member Failed: " . mysqli_error($conn) . "window.location.href = '../../page/page.php?page=members');</script>";
    } else {
        $_SESSION["member"] = mysqli_fetch_assoc($res);
        echo "<script>alert('Select member success !'); window.location.href = '../../page/page.php?page=members';</script>";
        exit;
    }
} else {
    echo "<script>alert('Unknown Process, contact admin'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit;
}
