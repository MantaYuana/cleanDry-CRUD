<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanDry</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo/favicon-light.svg">

    <style>
        @import url('../css/style.css');
        /* @import url('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'); */
        /* @import url('https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css'); */
        /* @import url('https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css'); */
        @import url('https://cdn.datatables.net/v/bs5/dt-2.0.0/b-3.0.0/b-html5-3.0.0/datatables.min.css');
    </style>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script src="../node_modules/autonumeric/dist/autoNumeric.min.js" type="text/javascript"></script>
    <script src="../node_modules/flatpickr/dist/flatpickr.min.js" type="text/javascript"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script> -->
</head>

<body>
    <?php
    if (empty($_SESSION) && $_GET['page'] != 'login') {
        echo "<script>alert('Please login first !'); window.location.href = '../page/page.php?page=login';</script>";
        exit();
    }
    ?>