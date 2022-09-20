<?php
require_once('conn.php');
if(isset($_POST['report_name']))
{
    $report_filter = $_POST['report_filter'];
    $client_id = $_POST['client_id'];
    $sql      = "SELECT *  FROM `report` WHERE `report_filter`='{$report_filter}' and `client_id`='{$client_id}'";
    $result   = mysqli_query($conn, $sql);
    echo $report_filter;
    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<option value='{$row['id']}'>{$row['report_name']}</option>";
        }
    }
}

?>