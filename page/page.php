<?php
require_once "template/header.php";

switch ($_GET['page']) {
    case 'login':
        require_once "account-control/login.php";
        break;
    case 'register':
        require_once "account-control/register.php";
        break;
    case 'dashboard':
        require_once "template/navbar.php";
        require_once "../php/helper/get_statistics.php";
        require_once "view/dashboard.php";
        require_once "../php/helper/graph.php";
        break;

    default:
        echo "error page";
        break;
}

require_once "template/footer.php";