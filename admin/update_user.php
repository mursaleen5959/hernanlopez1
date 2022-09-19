<?php
session_start();
if(isset($_SESSION['admin_status']))
{}
else{
    header('Location:index.php');
}
$conn   =   mysqli_connect("localhost","id18614455_root_abrar","+D*D7839q>e_+?j#","id18614455_project");
$id     =   $_POST['id'];
$sql    =   "SELECT * FROM users WHERE `uid`='$id'";
$result =   mysqli_query($conn,$sql);
$output =   mysqli_fetch_all($result,MYSQLI_ASSOC);
echo json_encode($output);
?>