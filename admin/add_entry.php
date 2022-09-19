<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conn.php');
if (isset($_SESSION['admin_status'])) {
} else {
    header('location:index.php');
}

if (isset($_POST['submit'])) {

    $extensions= array("html");

    $user           = $_POST['user'];
    $total          = count($_FILES['file']['name']);
    $conclusion     = $_POST['conclusion'];
    
    for( $i=0;$i<$total;$i++)
    {
       $file_tmp_name = $_FILES['file']['tmp_name'][$i];
       $file_name = $_FILES['file']['name'][$i];
       $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if(in_array($file_ext,$extensions)=== true)
        {
            $conclusion_final = $conclusion[$i];
            $file_final = rand() . "-" . $_FILES['file']['name'][$i];

            $newFilePath = "../uploadFiles/". $file_final;

            if(move_uploaded_file($file_tmp_name, $newFilePath))
            {

                $sql = "INSERT INTO `data`(`graph`, `conclusion`, `user`) VALUES ('{$file_final}','{$conclusion_final}','{$user}')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Data inserted Successfully')</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <title>Add User</title>
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
                <label for="" class="form-label" style="font-weight: bold;">Select Client Here:</label>
                    <select class="form-select" id="" name="user">
                        <?php
                            $users_q      = "SELECT * FROM `users`";
                            $result   = mysqli_query($conn, $users_q);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<option value='{$row["uid"]}'>{$row["name"]}</option>";
                            }
                        ?>
                    </select>
                    <hr>
                <div id="inputs-list">
                    <h5 for="" style="font-weight: bold;">Entry:</h5>
                    <label for="" class="form-label" style="font-weight: bold;">Graph file: (only html files)</label>
                    <input type="file" class="form-control file-input"  placeholder="" name="file[]">
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
$(document).ready(function(){
    $('#addentry').click(function () {
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
    $(document).on("click",".remove-entry",function (){
        $(this).parent().parent().remove();
    });
});
</script>
</html>