<?php 
    require_once "template/header.php";
    require_once "template/navbar.php";

    switch ($_GET['page']) {
        case 'login':
            require_once "account-control/login.php";
            break;
        case 'register':
            require_once "account-control/register.php";
            break;
        
        default:
            echo "error page";
            break;
    }


    require_once "template/footer.php";

?>