<?php
require "../connect.php";

$name = $_POST['register-name'];
$user = $_POST['register-username'];
$pass = $_POST['register-password'];
$password_hash = password_hash($pass, PASSWORD_DEFAULT);
$role = $_POST['register-role'];

$query_username = mysqli_query($conn, "SELECT username FROM user WHERE username='$user';");
$cek = mysqli_num_rows($query_username);

if ($cek != 0) {
    echo "<script>alert('Username already exists, please enter another username !'); </script>";
} else {
    $hasil = mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$name', '$user', '$password_hash', '1', '$role');");

    // TODO: implement cross page message transfer (like in task-manager)
    if (!$hasil) {
        echo "Register Failed " .  mysqli_error($conn);
    } else {
        // header('Location: ../login.php');
        echo "<script>alert('Register success !'); </script>";
        exit;
    }
}
