<?php
include('conn.php');
unset($_SESSION['admin_status']);
unset($_SESSION['admin_name']);
header('location:index.php');
?>