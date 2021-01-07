<?php include('includes/templates/head.php')?> 
<div class="wrapper wrapper-login bg-metro">
	<form method="POST" action=''>
		<div class="container container-login animated fadeIn pt-2 pb-2 pr-3 pl-3">
			<img src='../images/lablogo.png' class='img-fluid'>
				
			<div class="login-form">
				<div class="form-group form-floating-label">
					<input id="username" name="username" type="text" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Username</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="icon-eye"></i>
					</div>
				</div>
				<div class="form-action mb-3">
                    <input  name="submit" type="submit" value="Login" class="btn btn-primary btn-rounded btn-login">
				</div>
				 
			</div>
<?php 
include('config.php');
if(isset($_POST['submit'])) {
	session_start();
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$sql = mysqli_query($con, "SELECT * FROM `tb_staff` WHERE staff_un='$username' AND staff_pword='$password' AND staff_posvalue='1'") or die(mysqli_error());
	if(mysqli_num_rows($sql)<>0) {
		while($row=mysqli_fetch_assoc($sql)) {
			$staff_id = $row['staff_id'];
			$staff_un = $row['staff_un'];
			$status = $row['staff_status'];
			$type = $row['staff_type'];
			$staff_password = $row['staff_pword'];
			$staff_department = $row['staff_department'];

		}
			if($staff_password==$password) {
				//login/set sessions/redirect
				$_SESSION['staff_id'] = $staff_id;
				$_SESSION['staff_un'] = $staff_un;
				$_SESSION['staff_status'] = $status;
				$_SESSION['staff_type'] = $type;
				$_SESSION['staff_department'] = $staff_department;
					echo "<script>window.location='dashboard.php';</script>";
			} else {
				echo "<div class='alert alert-danger' align='center'><strong>Warning! </strong> Invalid login credentials</div>";
			}

	} else {
		echo "<div class='alert alert-danger' align='center'><strong>Warning! </strong> User not found</div>"; 
	}
}
	
?>
 		</div>
	</form>
</div>
<?php include('includes/templates/footer.php')?>