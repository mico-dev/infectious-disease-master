<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Patient Medical Information</title>
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
	body[data-background-color="dark"] .form-control {
			border-color:#ebedf2;
		}
	body[data-background-color="dark"] .form-control:focus {
		border-color:#31CE36;
	}
	#physicianResult, #addP, #addN, #nurseResult {
    	cursor: pointer;
	}
	.form-control:disabled, .form-control[readonly] {
		opacity:1 !important;
		background-color: #1a2035 !important;
    	color: #fff !important;
    	border-color: #fff !important;
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
						<li class="nav-item active">
							<a href="patient-registration.php">
								<i class="fas fa-user-plus"></i>
								<p>Patient Registration</p>
							</a>
						</li>
						<li class="nav-item">
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
						<h2 class="text-white pb-2">Patient Registration</h2>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark bg-primary-gradient">
								<div class="card-body">
								<form method="post" id='form'>
									<div class="row">
										<div class="col-md-12">
											<h3>1.2 Medical Information</h3>
											<hr>
										</div>
										<div class="col-4">
											<div class="form-group row no-gutters align-items-end d-none">
											<label class="col-4 mb-0">Patient ID:</label>
											<?php
												$pid = $_GET['pid'];	
											?>
											  	<div class="col-8">
													<input type="text" class="form-control-plaintext p-0" name= "patientId" value="<?php echo $pid;?>" readonly>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
											<label>Date of Initial Checkup</label>
												<input type="date" class="form-control" name="date" autocomplete="off"  placeholder='yyyy/mm/dd'>
											</div>
											<div class="form-group">
											<label>Infectious Disease</label>
												<input type="text" class="form-control" name="infectiousDisease" autocomplete="off"  value='COVID-19'>
											</div>
											<div class="form-group">
											<label>Room</label>
												<input type="text" class="form-control" name="room" placeholder='525'>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
											<label>Chief Complaint</label>
											<textarea rows="10" name="chiefComplaint" class="form-control"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
											<label>Physician</label>
												<div class="input-group">
												<input type="text" class="form-control" placeholder="Physician Name" name="physician" id="physician" data-type="physician">
												
													<div class="input-group-append border border-white">
														<span class="input-group-text btn btn-success" id='addP' data-toggle="tooltip" data-placement="top" title="Add Physician"><i class="fas fa-plus"></i></span>
													</div>
												</div>
												<div id='physicianResult'></div>
											</div>
											<div class="form-group" id='appendPhysician'></div>
										</div>
										<div class="col row no-gutters">
											<div class="col-4">
												<div class="form-group">
												<label>Nurse</label>
													<input type="text" class="form-control" name="nurse" id="nurse" data-type="nurse" placeholder='Nurse Name'>
													<div id='nurseResult'></div>
												</div>
											</div>
											<div class="col-4">
												<div class="form-group">
												<label>Start</label>
													<input type="date" class="form-control" name="start" id="start" data-type="start">
												</div>
											</div>
											<div class="col-4">
												<div class="form-group">
												<label>End</label>
													<div class="input-group">
													<input type="date" class="form-control" name="end" id="end" data-type="end">
														<div class="input-group-append border border-white">
															<span class="input-group-text btn btn-success" id='addN' data-toggle="tooltip" data-placement="top" title="Add Nurse"><i class="fas fa-plus"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12"><div class="form-group" id='appendNurse'></div></div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<button type="button" class="btn btn-md btn-success" id="formSubmit">Save</button>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="formResult"></div>
										</div>
									</div>
                            	</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
					© 2020 | HIS Department
					</div>				
				</div>
			</footer><footer class="footer">
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
	<script>
	$(document).ready(function() {
		$("#physician").keyup(function(){
		var query = $(this).val();
		var type = 'physician';
			if(query != '') {
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query
					},
					success:function(result) {
						$('#physicianResult').fadeIn();
						$('#physicianResult').html(result);
					}
				});
			}
		});
	  
		$(document).on('click', 'li.physician', function () {
			$("#physician").val($(this).text());
			var id = $(this).data("id");
			$('#physicianResult').fadeOut();
			$("#addP").attr("data-id", id);
		});
		$("#physician").focusout(function(){
		$('#physicianResult').fadeOut();
	 	});
		$(document).on('click', 'span#addP', function (e) {
		var dr = $.trim($("#physician").val());
		var id = $(this).attr('data-id');
		
		if(dr!="") {
		var group = '<div class="input-group mb-1 '+dr.replace(/ |\./g,"-")+'" data-name="'+dr.replace(/\./g,"")+'" data-type="physician" data-id="'+id+'"><input type="text" class="form-control" name="aphysician" id="aphysician" data-type="aphysician" value="'+dr+'" readonly><div class="input-group-append border border-white"><span class="input-group-text btn btn-danger" id="removeP" data-val="'+dr.replace(/ |\./g,"-")+'"><i class="fas fa-minus"></i></span></div></div>';
		$('#appendPhysician').fadeIn();
		$("#appendPhysician").append(group);
		$("#physician").val("");
		}
			$(document).on('click', 'span#removeP', function (e) { 
				var x = e.target.dataset.val;
				var xid = "."+x;
				$(xid).remove();
				$(xid).fadeOut();
			
			});
		});
		//nurse
		$("#nurse").keyup(function(){
		var query = $(this).val();
		var type = 'nurse';
			if(query != '') {
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query
					},
					success:function(result) {
						$('#nurseResult').fadeIn();
						$('#nurseResult').html(result);
					}
				});
			}
		});
		$(document).on('click', 'li.nurse', function () {
			$("#nurse").val($(this).text());
			var id = $(this).data("id");
			$('#nurseResult').fadeOut();
			$("#addN").attr("data-id", id);
		});
		$("#nurse").focusout(function(){
			$('#nurseResult').fadeOut();
	 	});
		$(document).on('click', 'span#addN', function () {
			var name = $.trim($("#nurse").val());
			var start = $.trim($("#start").val());
			var end = $.trim($("#end").val());
			var id = $(this).attr('data-id');
			if(name!="") {
				if(start!="") {
					if(end!="") {
						var group = '<div class="input-group mb-1 '+name.replace(/ |\./g,"-")+'" data-name="'+name+'" data-start="'+start+'" data-end="'+end+'" data-id="'+id+'"><input type="text" class="form-control" name="anurse" id="anurse" data-type="anurse" value="'+name+'" disabled><input type="text" class="form-control" name="astart" id="astart" data-type="astart" value="'+start+'" readonly><input type="text" class="form-control" name="aend" id="aend" data-type="aend" value="'+end+'" readonly><div class="input-group-append border border-white"><span class="input-group-text btn btn-danger" id="removeN" data-val="'+name.replace(/ |\./g,"-")+'"><i class="fas fa-minus"></i></span></div></div>';
						$('#appendNurse').fadeIn();
						$("#appendNurse").append(group);
						$("#nurse").val("");
						$("#start").val("");
						$("#end").val("");
					} else {
						$('#formResult').fadeIn();
						$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Assigned Nurse end date required</div>');
					}
				} else {
					$('#formResult').fadeIn();
					$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Assigned Nurse start date required</div>');
				}
			} else {
					$('#formResult').fadeIn();
					$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Assigned Nurse is required</div>');
			}
			$(document).on('click', 'span#removeN', function (e) { 
				var x = e.target.dataset.val;
				var xid = "."+x;
				$(xid).remove();
				$(xid).fadeOut();
			});
		});
		$("#formSubmit").click(function(e) {
			
			var arrPhysician = [];
			$.each($("#appendPhysician").children(), function() {
				arrPhysician.push($(this).data("id"));
         	 });
			var arrNurse = [];
			$.each($("#appendNurse").children(), function(key, value) {
				var name = 'Name: '+$(this).data("name") +  ' Start: ' + $(this).data("start") + ' End: ' + $(this).data("end");
				
				arrNurse.push(name);
         	 });
			
				e.preventDefault();
				var type = 'mi_insert';
				var query = 'mi_insert';
				var alpha = new RegExp('^[a-zA-Z_]+$');
				var num = new RegExp('^[\d{7,11}]+$');
				//validate form
				if($('[name="date"]').val().length!=0) {
					if($('[name="infectiousDisease"]').val().length!=0) {
						if($('[name="room"]').val().length!=0) {
							if($('[name="chiefComplaint"]').val().length!=0) {
								if(arrPhysician.length!=0) {
									if(arrNurse.length!=0) {
									//declare and sanitize inputs
										var patientId = $('[name="patientId"]').val();
										var init_date = $('[name="date"]').val();
										var infectiousDisease = $('[name="infectiousDisease"]').val();
										var room = $('[name="room"]').val();
										var chiefComplaint = $('[name="chiefComplaint"]').val();
										var physcian = arrPhysician;
										var nurse = arrNurse;
									//ajax insert and input filters
										$.ajax ({
											url: 'data.php',
											method: 'post',
											data: {
												type:type,
												query:query,
												id_pid:patientId,
												mi_init_date:init_date,
												mi_disease:infectiousDisease,
												mi_room:room,
												mi_chief_complaint:chiefComplaint,
												mi_physician:physcian,
												mi_nurse:nurse,
												mi_init:'yes'
											},
											success:function(result) {
												//check result for errors
												$('.card-body').addClass('is-loading is-loading-lg')
												setTimeout(function() { 
													//location.reload();
													$('#formResult').fadeIn();
													$('#formResult').html(result);
													$('.card-body').removeClass('is-loading is-loading-lg');
													setTimeout(function() {
														window.location.href = 'patient-list.php';
													},600);
												}, 700);
											}
										});
									} else {
										$('#formResult').fadeIn();
										$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Assigned Nurse is required</div>');
									}
								} else {
									$('#formResult').fadeIn();
									$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Assigned Physician is required</div>');
								}					
							} else{
								$('#formResult').fadeIn();
								$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Chief Complaint is required</div>');
							}
						} else {
							$('#formResult').fadeIn();
							$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Room is required</div>');
						}
					} else {
						$('#formResult').fadeIn();
						$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Infectious Disease required</div>');
					}
				} else {
					$('#formResult').fadeIn();
					$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Date of Initial Checkup required</div>');
				}
		});
	});
	</script>
	
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap.min.js"></script>
	
</body>
</html>