<?php
require_once "../php/connect.php";
require_once "template/header.php";

switch ($_GET['page']) {
    case 'login':
        require_once "account-control/login.php";
        break;
    case 'users':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "account-control/users.php";
        break;
    case 'register-user':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "account-control/registerUser.php";
        break;
    case 'edit-user':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "account-control/editUser.php";
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
    case 'members':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "member-control/members.php";
        break;
    case 'register-member':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "member-control/registerMember.php";
        break;
    case 'edit-member':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "member-control/editMember.php";
        break;
    case 'transactions':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "transaction-control/transactions.php";
        break;
    case 'register-transaction':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "transaction-control/registerTransaction.php";
        break;
    case 'edit-transaction':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "transaction-control/editTransaction.php";
        break;
    case 'print-transaction':
        require_once "template/navbar.php";
        require_once "template/sidebar.php";
        require_once "transaction-control/printTransaction.php";
        break;
    default:
        require_once "404.php";
        break;
}

require_once "template/footer.php";
