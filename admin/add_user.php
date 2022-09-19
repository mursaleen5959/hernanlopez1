<?php
include('conn.php');
if(isset($_SESSION['admin_status']))
{

}
else
{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Add User</title>
</head>
<body>
  <?php
  require('navbar.php');
  ?>
    <div class="form_wrapper">
        <div class="form_container">
          <div class="title_container">
            <h2>Add User</h2>
          </div>
          <div class="row clearfix">
            <div class="">
              <form method="post">
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                  <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                  <input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                  <input type="password" name="cnfrm_password" placeholder="Re-type Password" required />
                </div>
                <div class="row clearfix">
                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                      <input type="text" name="first_name" placeholder="First Name" />
                    </div>
                  </div>
                  <div class="col_half">
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                      <input type="text" name="second_name" placeholder="Last Name" required />
                    </div>
                  </div>
                </div>
                <input class="button" type="submit" name="submit" value="Register" style="height: 45px" />
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php
      if(isset($_POST['submit']))
      {
        $first_name     = $_POST['first_name'];
        $second_name    = $_POST['second_name'];
        $name           = $first_name.' '.$second_name; 
        $email          = $_POST['email'];
        $password       = $_POST['password'];
        $md5_pass       = md5($password);
        $cnfrm_password = $_POST['cnfrm_password'];
        $sql      = "SELECT * FROM `users` WHERE email='$email'";
        $result   = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          echo "<script>alert('User already exists !')</script>";
          echo "<script>window.location.href='add_user.php';</script>";
          exit();
        }
        if($password!=$cnfrm_password)
        {
          echo"<script>alert('Password did not matched !');</script>";
        }
        else
        {
          $sql = "INSERT INTO users (`name`, email, `password`)VALUES('$name', '$email', '$md5_pass')";
          if($conn->query($sql) === TRUE) {

            echo "<div class='text-center'>New record created successfully</div>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

        }
      }
      ?>
</body>
</html>
