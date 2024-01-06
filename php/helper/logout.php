<?php 
session_start();
session_destroy();

echo "<script>alert('Logout Succesfull'); window.location.href = '../../page/page.php?page=login';</script>";