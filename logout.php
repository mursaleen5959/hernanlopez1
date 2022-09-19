<?php
include('conn.php');
session_destroy();
header('location:index.php');
?>