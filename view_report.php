<?php
require_once('conn.php');
if (isset($_POST['view_report'])) {
    $report_id = $_POST['report_id'];
}
else{
    header('location:index.php');
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
    <title>View Report</title>
</head>
<body>
    <?php
    require_once('navbar.php');
    $sql      = "SELECT * FROM `data` WHERE `report_id`='{$report_id}'";
    $result   = mysqli_query($conn, $sql);
    ?>
    <div class="container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            $c = 1;
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <h5>Graph<?= $c ?> :</h5>
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="uploadFiles/<?= $row['graph'] ?>" title="Iframe Example" allowfullscreen></iframe>
                </div>
                <div>
                    <h5>Conclusion<?= $c ?> :</h5>
                    <?php $c += 1 ?>
                    <?php echo $row['conclusion'] ?>
                </div>
                <hr>
        <?php
            }
        }
        ?>
    </div>

</body>

</html>