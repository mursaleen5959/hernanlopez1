<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conn.php');
if (isset($_SESSION['admin_status'])) {
} else {
    header('location:index.php');
}

if (isset($_POST['submit']))
{
    $extensions     = array("html");

    $month          = $_POST['month'];
    $year           = $_POST['year'];
    $report_filter  = $month."-".$year;
    $r_name         = $_POST['report_name'];
    $user           = $_POST['user'];    

    $total          = count($_FILES['file']['name']);
    $conclusion     = $_POST['conclusion'];

    $sql = "INSERT INTO `report`(`report_name`, `report_filter`, `client_id`) VALUES ('{$r_name}','{$report_filter}','{$user}')";
    if (mysqli_query($conn, $sql)) {
        $report_id = mysqli_insert_id($conn);
        for ($i = 0; $i < $total; $i++) {
            $file_tmp_name = $_FILES['file']['tmp_name'][$i];
            $file_name = $_FILES['file']['name'][$i];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
            if (in_array($file_ext, $extensions) === true) {
                $conclusion_final = $conclusion[$i];
                $file_final = rand() . "-" . $_FILES['file']['name'][$i];
        
                $newFilePath = "../uploadFiles/" . $file_final;
        
                if (move_uploaded_file($file_tmp_name, $newFilePath)) {
        
                    $sql = "INSERT INTO `data`(`report_id`,`graph`, `conclusion`) VALUES ('{$report_id}','{$file_final}','{$conclusion_final}')";
                    if (mysqli_query($conn, $sql)) {
                        //echo "<script>alert('Data inserted Successfully')</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        exit();
                    }
                }
            }
        }
        echo "<script>alert('Data inserted Successfully')</script>";
    }else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <title>Add User</title>
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
</head>

<body>
    <?php
    require('navbar.php');
    ?>
    <div class="container">
        <h2 class="mt-4">Add New Report</h2>
        <hr>
        <div class="row mt-4">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <form method="post" action="" enctype="multipart/form-data">
                    <label for="" class="form-label" style="font-weight: bold;">Report Month:</label>
                    <select class="form-select" id="" name="month">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="Octobar">Octobar</option>
                        <option value="Novembar">Novembar</option>
                        <option value="Decembar">Decembar</option>
                    </select>
                    <label for="" class="form-label" style="font-weight: bold;">Report Year:</label>
                    <select class="form-select" id="" name="year">
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                    </select>
                    <label for="" class="form-label" style="font-weight: bold;">Select Client Here:</label>
                    <select class="form-select" id="" name="user">
                        <?php
                        $users_q      = "SELECT * FROM `users`";
                        $result   = mysqli_query($conn, $users_q);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row["uid"]}'>{$row["name"]}</option>";
                        }
                        ?>
                    </select>
                    <hr>
                    <label for="" class="form-label" style="font-weight: bold;">Report Name:</label>
                    <input type="text" class="form-control" placeholder="Report Name here ..." name="report_name">
                    <hr>
                    <div id="inputs-list">
                        <h5 for="" style="font-weight: bold;">Entry:</h5>
                        <label for="" class="form-label" style="font-weight: bold;">Graph file: (only html files)</label>
                        <input type="file" class="form-control file-input" placeholder="" name="file[]">
                        <label for="" class="form-label" style="font-weight: bold;">Conclusion here:</label>
                        <textarea name="conclusion[]" placeholder="Write conclusions here" class="mt-1 form-control" id="" cols="79" rows="2"></textarea>
                    </div>
                    <button class="btn btn-success mt-4" id="addentry" type="button"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></button>
                    <div class="d-grid">
                        <button class="mt-4 btn btn-primary btn-block text-white" type="submit" name="submit" value="AddEntry">Submit Entry</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#addentry').click(function() {
            var newElements = ` <div class="g-entry mt-2">
                            <hr>
                            <h5 for="" style="font-weight: bold;">
                            <button class="btn btn-danger btn-sm remove-entry" type="button"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                            Entry:</h5>
                            <label for="" class="form-label" style="font-weight: bold;">Graph file: (only html files)</label>
                            <input type="file" class="form-control file-input"  placeholder="" name="file[]">
                            <label for="" class="form-label" style="font-weight: bold;">Conclusion here:</label>
                            <textarea name="conclusion[]" placeholder="Write conclusions here" class="mt-1 form-control" id="" cols="79" rows="2"></textarea>
                            </div>`;
            $("#inputs-list").append(newElements);
        });
        $(document).on("click", ".remove-entry", function() {
            $(this).parent().parent().remove();
        });


    });
</script>

</html>