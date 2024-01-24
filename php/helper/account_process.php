<?php
require_once "../connect.php";
session_start();

$process = $_POST["process"];
@$id = $_POST['id'];
@$name = $_POST['register-name'];
@$username = $_POST['register-username'];
@$password = $_POST['register-password'];
@$role = $_POST['register-role'];

if ($process == "register") {
    $id_outlet = $_SESSION['outlet']['id'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query_username = mysqli_query($conn, "SELECT username FROM user WHERE username='$username';");
    $cek = mysqli_num_rows($query_username);

    if ($cek != 0) {
        echo "<script>alert('Username already exists, please enter another username !'); window.location.href = '../../page/page.php?page=registerUser'</script>";
    } else {
        $hasil = mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$name', '$username', '$password_hash', $id_outlet, '$role');");

        // TODO: implement cross page message transfer (like in task-manager)
        if (!$hasil) {
            echo "<script>alert('Register Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=registerUser';</script>";
        } else {
            echo "<script>alert('Register success !'); window.location.href = '../../page/page.php?page=users';</script>";
            exit;
        }
    }
} elseif ($process == "edit") {
    $res = mysqli_query($conn, "UPDATE user SET nama='$name', username='$username', role='$role' WHERE id=$id;");
    if (!isset($password)) {
        $res = mysqli_query($conn, "UPDATE user SET nama='$name', username='$username', password=$password,role='$role' WHERE id=$id;");
    }

    if (!$res) {
        echo "<script>alert('Edit Failed: " . mysqli_error($conn) . "'); window.location.href = '../../page/page.php?page=edit-user&idUser=$id';</script>";
    } else {
        echo "<script>alert('Edit success !'); window.location.href = '../../page/page.php?page=users';</script>";
        exit;
    }
} elseif ($process == "destroy") {
    $res = mysqli_query($conn, "DELETE FROM user WHERE id=$id;");

    if (!$res) {
        echo "<script>alert('Delete Failed: " . mysqli_error($conn) . "');</script>";
    } else {
        echo "<script>alert('Delete success !'); window.location.href = '../../page/page.php?page=users';</script>";
        exit;
    }
} elseif ($process == "login") {
    $user = $_POST['login-user'];
    $pass = $_POST['login-password'];

    $query_login = mysqli_query($conn, "SELECT * FROM user WHERE username='$user';");
    $data_user = mysqli_fetch_assoc($query_login);
    $cek = password_verify($pass, $data_user['password']);

    if ($cek > 0) {
        $_SESSION['username'] = $user;
        $_SESSION['role'] = $data_user['role'];
        $outlet = $data_user['id_outlet'];
        $_SESSION['outlet'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM outlet WHERE id='$outlet';"));
        // TODO: implement cross page message transfer (like in task-manager)
        echo "<script>alert('Login Succesfull'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    } else {
        echo "<script>alert('Login Failed'); window.location.href = '../../page/page.php?page=login';</script>";
    }
} elseif ($process == "logout") {
    session_destroy();
    echo "<script>alert('Logout Succesfull'); window.location.href = '../../page/page.php?page=login';</script>";
} else {
    echo "<script>alert('Unknown Process, contact admin'); window.location.href = '../../page/page.php?page=dashboard';</script>";
    exit;
}
