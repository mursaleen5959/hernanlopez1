<?php
require_once('conn.php');
if(isset($_SESSION['admin_status']))
{

}
else
{
    header('location:index.php');
}
$message="";
if(isset($_POST["update_information"]))
{
	$id		=	$_POST['user_id'];
	$psw	=	md5($_POST['u_psw']);
	$name	=	$_POST['u_name'];
	$email	=	$_POST['u_email'];
	$sql    = "SELECT * FROM `users` WHERE email='$email'";
	$result   = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
	    
	    $sql = "UPDATE users SET `name`='$name', password='$psw' WHERE `uid`='$id'";
	    if ($conn->query($sql) === TRUE) {
	        
	    }
	    
		echo "<script>alert('User already exists !')</script>";
		echo "<script>window.location.href='edit_users.php';</script>";
		exit();
	}

	$sql = "UPDATE users SET `name`='$name',email='$email', password='$psw' WHERE `uid`='$id'";

	if ($conn->query($sql) === TRUE) {
		$message="Record updated Successfully !";
	}
	else{
		echo"<script>alert('Some error has been occurred !');</script>";
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Edit Users</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<?php
		require('navbar.php');
		?>

	<div class="container">

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style="color: grey">Update Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
		<form method="POST" action="">
			<div class="modal-body">
				
				<input type="text" name="user_id" id="user_id" hidden>
				<label style="color: grey">Name</label>
				<input type="text" name="u_name" style="color: grey" id="u_name" class="form-control">
				<br>
				<label style="color: grey">Email</label>
				<input type="email" name="u_email" style="color: grey" id="u_email" class="form-control">
				<br>
				<label style="color: grey">Password</label>
				<input type="text" name="u_psw" style="color: grey" id="u_psw" class="form-control">
				<br>
			</div>
			
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="submit" name="update_information" class="btn btn-success">Update</button>
			</div>
		</form>
        
      </div>
    </div>
  </div>
  
</div>

	<!-- ///////////////.........Modal End......./////////////////////////////// -->
	
	<section class="" style="margin-top: 30px">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section" style="color: grey">Users</h2>
				</div>
			</div>
			<div class="text-center" style="color: grey">
				<?php echo $message;?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table" style="margin-top:0px">
					    <thead class="thead-primary" style="background-color:#ffc107">
					      <tr>
					        <th>ID</th>
					        <th>Name</th>
					        <th>Email</th>
							<th>Action</th>
					      </tr>
					    </thead>
					    <tbody>
							<?php
							$sql      = "SELECT * FROM `users`";
							$result   = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
							while($row 		= mysqli_fetch_assoc($result)) {
								$name 		= $row['name'];
								$id 		= $row['uid'];
								$email 		= $row['email'];
								?>
								<tr>
									<td style="color: grey"><?php echo $id;?></td>
									<td style="color: grey"><?php echo $name;?></td>
									<td style="color: grey"><?php echo $email;?></td>
									<td>
										<a href="edit_user.php" class="edit_btn" id="<?php echo $id;?>" data-toggle="modal" data-target="#myModal">
											<i class="fa fa-pencil-square-o fa-lg" style="color:#32CD32;margin-right:35px" 
											aria-hidden="true"></i>
										</a>
										<a href="del_user.php" class="del_btn" id="<?php echo $id;?>">
											<i class="fa fa-trash fa-lg" aria-hidden="true" style="color: red"></i>
										</a>
									</td>
								</tr>
								<?php
							}
						}
							?>
					      
					    </tbody>
					  </table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function(){
			$(document).on("click",".edit_btn",function(){
				var id = $(this).attr('id');
				$.ajax({
					url: "update_user.php",
					type: "POST",
					data: {id : id},
					dataType:'JSON',
					success:function(response)
					{
						$.each(response,function(key,value){
							var id		=	value.uid;
							var name	=	value.name;
							var email	=	value.email;
							$("#user_id").val(id);
							$("#u_name").val(name);
							$("#u_email").val(email);
						});
					}
				});
			});
			$(document).on("click",".del_btn",function(){
				var id	=	$(this).attr("id");
				let text = "Are you sure you want to delete?";
				if (confirm(text) == true) {
					$.ajax({
					url: "del_user.php",
					type: "POST",
					data: {id : id},		
					success:function(response)
					{
						alert(response);
						window.location.href='edit_users.php';
					}
				});
			} 
			else
			{}
			});
		});
	</script>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>

