<?php 
session_start();
if(!isset($_SESSION['staff_un'])) {
	header('Location: index.php');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Patient List</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="https://via.placeholder.com/50" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});

	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/atlantis.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../../assets/css/demo.css">
	<style>
	#streetBrgyResult, #muniCityResult, #provinceResult, #regionResult, #countryResult {
    	cursor: pointer;
	}
</style>
</head>
<body data-background-color="dark">
	<div class="wrapper">
	<div class="main-header">
			<div class="logo-header bg-primary-gradient" data-background-color="" style="line-height:20px;color:#fff;"><?php echo $_SESSION['staff_department']; ?></div>
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../../assets/images/logo.png" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="u-text">
												<h4><?php echo $_SESSION['staff_un']; ?></h4>
												<p class="text-muted"><?php echo $_SESSION['staff_department']; ?></p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="logout.php">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar sidebar-style-2" data-background-color="dark2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href="dashboard.php" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="patient-registration.php">
								<i class="fas fa-user-plus"></i>
								<p>Patient Registration</p>
							</a>
						</li>
						<li class="nav-item active">
							<a href="patient-list.php">
								<i class="fas fa-users"></i>
								<p>Patient List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="logout.php">
								<i class="fas fa-sign-out-alt"></i>
								<p>Logout</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="container">
				<div class="page-inner">
					<div class="mt-2 mb-4">
						<h2 class="text-white pb-2">Patient List</h2>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark bg-primary-gradient">
								<div class="card-body" id="source">
                                <table class="table table-bordered table-dark" id="basic-datatables">
                                    <thead>
                                        <tr>
                                            <td>Pid</td>
                                            <td>Patient Name</td>
                                            <td>Options</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include('config.php');
                                        
										$select = mysqli_query($con, "SELECT * FROM `tb_id_patients` WHERE id_pid<>'100000'") or die(mysqli_query($con));
										if(mysqli_num_rows($select)<>0) {
											while($row=mysqli_fetch_assoc($select)){
												$pid = $row['id_pid'];
												$firstname = $row['id_firstname'];
												$middlename = $row['id_middlename'];
												$lastname = $row['id_lastname'];
												$fullname = ucfirst($firstname). ' '. ucfirst($lastname) .' ' .ucfirst($middlename);
												$check = mysqli_query($con, "SELECT * FROM tb_id_medical_info WHERE id_pid='$pid'")or(die(mysqli_error($con)));
												
												if(mysqli_num_rows($check)<>0) {
												
													$diary='';
													$medinfo='disabled';
												}else{
													$diary='disabled';
													$medinfo='';
												}
												echo '<tr>';
												echo '<td>'.$pid.'</td>';
												echo '<td>'.$fullname.'</td>';
												echo '<td><a href="patient-profile.php?pid='.$pid.'" class="btn btn-primary"><i class="fas fa-user"></i> Profile</a> <a href="patient-diary.php?pid='.$pid.'" class="btn btn-secondary '.$diary.'"><i class="fas fa-calendar-alt"></i> Diary</a> <a href="patient-merger.php?pid='.$pid.'" class="btn btn-success patientMerger"><i class="fas fa-user-friends"></i> Merge</a> <a href="medical-information.php?pid='.$pid.'" class="btn btn-warning '.$medinfo.'"><i class="fas fa-user-friends"></i> Add Med Info</a> <a href="" class="btn btn-danger disabled"><i class="fas fa-trash"></i> Delete</a></td>';
												echo '</tr>';
											}
										}else {
											
											echo '<tr>';
											echo '<td colspan="3">No available result</td>';
											echo '</tr>';
										}
                                        

                                        ?>
                                    </tbody>
                                </table>
								<div class="reso"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto nav-link">
					© 2020 | HIS Department
					</div>				
				</div>
			</footer>
		</div>
		<!-- End Custom template -->
	</div>

	<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap.min.js"></script>
	<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
	<script>
	$(document).ready(function() {
		
		$('#basic-datatables').DataTable();
		$(document).on('click', '.patientMerger', function(e) {
			var piid = e.currentTarget.dataset.piid;
			$('#patientMerger').modal('show');
			$('#patientMerger').on('shown.bs.modal', function () {
				var query = $(this).val();
				var type = 'merger';
				var modal  = $(this);
				var title = 'Patient ID: ' + piid;
				modal.find('.modal-body').html(title);
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query,
						piid:piid
					},
					success:function(result) {
						modal.find('.modal-body').append(result);
					}
				});
			});
		});
		//canvas
		
	});
	</script>
	<div class="modal fade" id="patientMerger" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary-gradient">
				<h3 class="modal-title text-light" id="title">Patient Merger</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
	
	
</body>
</html>