<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conn.php');
if(isset($_SESSION['user_status'])) 
{
    header('location:prof.php');
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
    <title>Login</title>
    <style>
        
    </style>
</head>
<body>
  <?php
  require('navbar.php');
  ?>
    <div class="form_wrapper">
        <div class="form_container">
          <div class="title_container">
            <h2>Log in</h2>
          </div>
          <!-- <div class="row clearfix"> -->
            <div class="">
              <form method="post">
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                  <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                  <input type="password" name="password" placeholder="Password" required />
                </div>
                <input class="button" type="submit" name="login" value="Log in" style="margin-top: 10px;height:45px">
            </form>
        </div>
    </div>
</div>
<?php
      if(isset($_POST['login']))
      {
          $email    = $_POST['email'];
          $psw      = $_POST['password'];
          $cnf_psw  = md5($psw);
          $sql      = "SELECT * FROM `users` WHERE email='$email' AND `password`='$cnf_psw'";
          $result   = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                  $name = $row['name'];
                  $uid = $row['uid'];
                }
                $_SESSION['user_id']=$uid;
                $_SESSION['user_status']='login';
                $_SESSION['user_name']=$name;        
                echo '<script>window.location.href="prof.php";</script>';
            }
        else
        {
          echo"<script>alert('Invalid information !');</script>";
        }
      }
      ?>
</body>
</html>
