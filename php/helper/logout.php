<?php 
session_start();
session_destroy();

echo "<script>alert('Logout Succesfull');</script>";
