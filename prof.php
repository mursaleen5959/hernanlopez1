<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('conn.php');
if (isset($_SESSION['user_status'])) {
    $uid = $_SESSION['user_id'];
} else {
    echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <title>Profile</title>
</head>
<body>
    <?php
    require_once('navbar.php');
    $sql      = "SELECT DISTINCT `report_filter` FROM `report` WHERE `client_id`={$uid}";
    $result   = mysqli_query($conn, $sql);
    ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="view_report.php" method="post">
                    <h4 class="mb-2">Report Filter:</h4>
                    <input type="number" name="uid" id="uid" value="<?= $uid ?>" hidden>
                    <select class="form-select" id="report_filter">
                        <option value="" disabled selected>Select ... </option>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['report_filter']}'>{$row['report_filter']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <h4 class="mb-2 mt-3">Report Name:</h4>
                    <select class="form-select" id="report_name" name="report_id">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['report_filter']}'>{$row['report_filter']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <div class="d-grid mt-4" id="btn-submit"></div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).on("change", "#report_filter", function() {
        var uid = $("#uid").val();
        var report_filter = $("#report_filter").val();
        $.ajax({
            url: "api.php",
            type: "POST",
            data: {
                report_name: true,
                report_filter: report_filter,
                client_id: uid
            },
            success: function(result) {
                console.log(result);
                $("#report_name").html(result);
                $("#btn-submit").html("<button class='btn btn-primary' type='submit' name='view_report'>View Report</button>");
            }
        });
    });
</script>