<?php
require_once "../connect.php";
session_start();

$user = $_POST['login-user'];
$pass = $_POST['login-password'];

$query_login = mysqli_query($conn, "SELECT * FROM user WHERE username='$user';");
$data_user = mysqli_fetch_assoc($query_login);
$cek = password_verify($pass, $data_user['password']);

if ($cek > 0) {
    $_SESSION['username'] = $user;
    $_SESSION['role'] = $data_user['role'];
    echo "<script>alert('Login Succesfull');</script>";
} else {
    echo "<script>alert('Login Failed');</script>";
}