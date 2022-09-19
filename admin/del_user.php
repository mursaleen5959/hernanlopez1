<?php
require_once('conn.php');
if(isset($_POST['id']))
{
    $id =   $_POST['id'];

    $sql = "DELETE FROM users WHERE `uid`='$id'";
    if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>