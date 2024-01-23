<?php
require_once "../php/connect.php";
require_once "template/header.php";

switch ($_GET['page']) {
    case 'login':
        require_once "account-control/login.php";
        break;
    case 'register':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "account-control/registerUser.php";
        break;
    case 'dashboard':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "../php/helper/get_statistics.php";
        require_once "view/dashboard.php";
        require_once "../php/helper/graph.php";
        break;
    case 'outlets':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "outlet-control/outlet.php";
        break;
    case 'register-outlet':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "outlet-control/registerOutlet.php";
        break;
    case 'edit-outlet':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "outlet-control/editOutlet.php";
        break;
    case 'packages':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "package-control/package.php";
        break;
    case 'register-package':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "package-control/registerPackage.php";
        break;
    case 'edit-package':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "package-control/editPackage.php";
        break;


    default:
        echo "error page";
        break;
}

require_once "template/footer.php";
