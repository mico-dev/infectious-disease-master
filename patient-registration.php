<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Patient Registration</title>
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
		#streetBrgyResult, #muniCityResult, #provinceResult, #regionResult, #countryResult {
			cursor: pointer;
		}
		.ui-widget-content {
			background:#ebedf2;
		}
	</style>
	<!-- Auto Complete script --->
<link rel="stylesheet" href="../jquery-ui.css">
<script src="../jquery-1.10.2.js"></script>
<script src="../jquery-ui.js"></script>
<script>
	$(document).ready(function() {
		//streetBrgy
		$('#streetBrgy').keyup(function(){
			var query = $(this).val();
			$("#streetBrgy").autocomplete({
			source: function( request, response ) {
			$.ajax({
				url: "data.php",
				type: 'post',
				dataType: "json",
				data: {
					type:'streetBrgy',
					query: request.term
				},
				success: function(data) {
				response(data);
				console.log(data);
				}
			});
			},
			select: function (event, ui) {
			// Set selection
				$('#streetBrgy').val(ui.item.label); // display the selected text
				$('#streetBrgy').val(ui.item.value); // save selected id to input
				return false;
			}
			});
		});
		//muniCity
		$('#muniCity').keyup(function(){
			var query = $(this).val();
			$("#muniCity").autocomplete({
			source: function( request, response ) {
			$.ajax({
				url: "data.php",
				type: 'post',
				dataType: "json",
				data: {
					type:'muniCity',
					query: request.term
				},
				success: function(data) {
				response(data);
				console.log(data);
				}
			});
			},
			select: function (event, ui) {
			// Set selection
				$('#muniCity').val(ui.item.label); // display the selected text
				$('#muniCity').val(ui.item.value); // save selected id to input
				return false;
			}
			});
		});
		//province
		$('#province').keyup(function(){
			var query = $(this).val();
			$("#province").autocomplete({
			source: function( request, response ) {
			$.ajax({
				url: "data.php",
				type: 'post',
				dataType: "json",
				data: {
					type:'province',
					query: request.term
				},
				success: function(data) {
				response(data);
				console.log(data);
				}
			});
			},
			select: function (event, ui) {
			// Set selection
				$('#province').val(ui.item.label); // display the selected text
				$('#province').val(ui.item.value); // save selected id to input
				return false;
			}
			});
		});
		//region
		$('#region').keyup(function(){
			var query = $(this).val();
			$("#region").autocomplete({
			source: function( request, response ) {
			$.ajax({
				url: "data.php",
				type: 'post',
				dataType: "json",
				data: {
					type:'region',
					query: request.term
				},
				success: function(data) {
				response(data);
				console.log(data);
				}
			});
			},
			select: function (event, ui) {
			// Set selection
				$('#region').val(ui.item.label); // display the selected text
				$('#region').val(ui.item.value); // save selected id to input
				return false;
			}
			});
		});
		//country
		$('#country').keyup(function(){
			var query = $(this).val();
			$("#country").autocomplete({
			source: function( request, response ) {
			$.ajax({
				url: "data.php",
				type: 'post',
				dataType: "json",
				data: {
					type:'country',
					query: request.term
				},
				success: function(data) {
				response(data);
				console.log(data);
				}
			});
			},
			select: function (event, ui) {
			// Set selection
				$('#country').val(ui.item.label); // display the selected text
				$('#country').val(ui.item.value); // save selected id to input
				return false;
			}
			});
		});
		$("#formSubmit").click(function(e) {
			e.preventDefault();
			var type = 'formSubmit';
			var query = 'formSubmit';
			var alpha = new RegExp('^[a-zA-Z_]+$');
			var num = new RegExp('^[\d{7,11}]+$');
			//validate form
			if($('[name="firstname"]').val().length!=0) {
				if(alpha.test($.trim($('[name="firstname"]').val()))) {
					if($('[name="lastname"]').val().length!=0) {
						if(alpha.test($.trim($('[name="lastname"]').val()))) { 
							if($('[name="middlename"]').val().length!=0) {
								if(alpha.test($.trim($('[name="middlename"]').val()))) {
									if($('[name="gender"]').children("option:selected").val()!="") {
										if($('[name="birthDate"]').val().length!=0) {
											if($('[name="civilStatus"]').children("option:selected").val()!="") {
												if($('[name="contactNumber"]').val().length!=0) {
													//if(num.test($('[name="contactNumber"]').val())) {
														if($('[name="streetBrgy"]').val().length!=0) {
															if($('[name="muniCity"]').val().length!=0) {
																if($('[name="province"]').val().length!=0) { 
																	if($('[name="region"]').val().length!=0) { 
																		if($('[name="country"]').val().length!=0) { 
																			//$("#form").submit(function(e) {
																				//declare var
																				var regdate = $('[name="regDate"]').val();
																				var firstname = $('[name="firstname"]').val();
																				var lastname = $('[name="lastname"]').val();
																				var middlename = $('[name="middlename"]').val();
																				var suffix = $('[name="suffix"]').val();
																				var gender = $('[name="gender"]').children("option:selected").val();
																				var birthDate = $('[name="birthDate"]').val();
																				var civilStatus = $('[name="civilStatus"]').children("option:selected").val();
																				var contactNumber = $('[name="contactNumber"]').val();
																				var houseNo = $('[name="houseNo"]').val();
																				var streetBrgy = $('[name="streetBrgy"]').val();
																				var muniCity = $('[name="muniCity"]').val();
																				var province = $('[name="province"]').val();
																				var region = $('[name="region"]').val();
																				var country = $('[name="country"]').val();
																				var pid = $('[name="patientId"]').val();
																				$.ajax ({
																					url: 'data.php',
																					method: 'post',
																					data: {
																						type:type,
																						query:query,
																						id_registrationdate:regdate,
																						id_firstname:firstname,
																						id_lastname:lastname,
																						id_middlename:middlename,
																						id_suffix:suffix,
																						id_gender:gender,
																						id_birthdate:birthDate,
																						id_civilstatus:civilStatus,
																						id_contactno:contactNumber,
																						id_houseno:houseNo,
																						id_brgy:streetBrgy,
																						id_city:muniCity,
																						id_province:province,
																						id_region:region,
																						id_country:country
																					},
																					success:function(result) {
																						//check result for errors
																						$('.card-body').addClass('is-loading is-loading-lg')
																						setTimeout(function() { 
																							$('#formResult').fadeIn();
																							$('#formResult').html(result);
																							$('.card-body').removeClass('is-loading is-loading-lg')
																							setTimeout(function() {
																								window.location.href = 'medical-information.php?pid='+pid;
																							},600);
																							
																						}, 700);
																						//settimeout load redirect
																						//location.reload();
																					}
																				});
																			//});
																		} else {
																			$('#formResult').fadeIn();
																			$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Country is required</div>');
																		}
																	} else {
																		$('#formResult').fadeIn();
																		$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Region is required</div>');
																	}
																} else {
																	$('#formResult').fadeIn();
																	$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Province is required</div>');
																}
															} else {
																$('#formResult').fadeIn();
																$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Municipality/City is required</div>');
															}
														} else {
															$('#formResult').fadeIn();
															$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Street/Brgy is required</div>');
														}
													/*} else {
														$('#formResult').fadeIn();
														$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient contact number is  invalid format</div>');
													}	*/
												} else {
													$('#formResult').fadeIn();
													$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient contact number is required</div>');
												}
											} else {
												$('#formResult').fadeIn();
												$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient civil status is required</div>');
											}
										} else {
											$('#formResult').fadeIn();
											$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient Birthdate is required</div>');
										}
									} else {
										$('#formResult').fadeIn();
										$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient gender is required</div>');
									}
								} else {
									$('#formResult').fadeIn();
									$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient middlename is  invalid format</div>');
								}
							} else {
								$('#formResult').fadeIn();
								$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient middlename is required</div>');
							}
						} else{
							$('#formResult').fadeIn();
							$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient lastname is  invalid format</div>');
						}
					} else {
						$('#formResult').fadeIn();
						$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient lastname is required</div>');
					}
				} else {
					$('#formResult').fadeIn();
					$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient firstname is  invalid format</div>');
				}
			} else {
				$('#formResult').fadeIn();
				$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Patient firstname is required</div>');
			}
		});//end #formSubmit
		/*$("#streetBrgy").keyup(function(){
		var query = $(this).val();
		var type = 'streetBrgy';
			if(query != '') {
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query
					},
					success:function(result) {
						$('#streetBrgyResult').fadeIn();
						$('#streetBrgyResult').html(result);
					}
				});
			}
	  	});
		$("#muniCity").keyup(function(){
		var query = $(this).val();
		var type = 'muniCity';
			if(query != '') {
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query
					},
					success:function(result) {
						$('#muniCityResult').fadeIn();
						$('#muniCityResult').html(result);
					}
				});
			}
	  	});			
      $("#province").keyup(function(){
		var query = $(this).val();
		var type = 'province';
			if(query != '') {
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query
					},
					success:function(result) {
						$('#provinceResult').fadeIn();
						$('#provinceResult').html(result);
					}
				});
			}
	  	});
      $("#region").keyup(function(){
		var query = $(this).val();
		var type = 'region';
			if(query != '') {
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query
					},
					success:function(result) {
						$('#regionResult').fadeIn();
						$('#regionResult').html(result);
					}
				});
			}
	  	});
      $("#country").keyup(function(){
		var query = $(this).val();
		var type = 'country';
			if(query != '') {
				$.ajax ({
					url: 'data.php',
					method: 'post',
					data: {
						type:type,
						query:query
					},
					success:function(result) {
						$('#countryResult').fadeIn();
						$('#countryResult').html(result);
					}
				});
			}
	  	});	*/
	 /* $(document).on('click', 'li.streetBrgy', function () {
		$("#streetBrgy").val($(this).text());
		$('#streetBrgyResult').fadeOut();

	  });
	  $(document).on('click', 'li.province', function () {
		$("#province").val($(this).text());
		$('#provinceResult').fadeOut();
	  });
	  $(document).on('click', 'li.muniCity', function () {
		$("#muniCity").val($(this).text());
		$('#muniCityResult').fadeOut();
	  });
	  $(document).on('click', 'li.region', function () {
		$("#region").val($(this).text());
		$('#regionResult').fadeOut();

	  });
	  $(document).on('click', 'li.country', function () {
		$("#country").val($(this).text());
		$('#countryResult').fadeOut();

	  });
	  //on focus
	  /*
	$("#streetBrgy").focusout(function(){
		$('#streetBrgyResult').fadeOut();
	  });
	  $("#province").focusout(function(){
		$('#provinceResult').fadeOut();
	  });
	  $("#muniCity").focusout(function(){
		$('#muniCityResult').fadeOut();
	  });
	  $("#country").focusout(function(){
		$('#countryResult').fadeOut();
	  });
	  $("#region").focusout(function(){
		$('#regionResult').fadeOut();
	  });*/
	}); //end d.ready
	
	</script>
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
								<div class="card-body ">
								<form method="post" id='form'>
									<div class="row">
										<div class="col-md-12">
											<h3>1.1 Personal Information</h3>
											<hr>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label>Patient ID</label>
											<?php
												include('config.php');
													$getpid = mysqli_query($con, "SELECT * FROM `tb_id_patients` ORDER BY `tb_id_patients`.`id_pid` DESC LIMIT 1") or die(mysqli_error($con));
														
													if(mysqli_num_rows($getpid)<>0) {
														while($row=mysqli_fetch_assoc($getpid)) {
															$pid = $row['id_pid'];
															$pid+=1;
														}
													} else {
														$pid ='';
													}
											?>
												<input type="text" class="form-control" name= "patientId" value="<?php echo $pid;?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<?php 
											date_default_timezone_set('Asia/Manila');
											$now = new DateTime();
											$now = $now->format('Y-m-d h:i:s');
											?>
											<label>Registration Date</label>
												<input type="text" class="form-control" name="regDate" value= "<?php echo $now;?>">
											</div>
										</div>
									</div>
									<div class="row">	
										<div class="col-md-3">
											<div class="form-group">
											<label>First Name</label>
												<input type="text" class="form-control" name="firstname" placeholder='Mico'>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label>Last Name</label>
												<input type="text" class="form-control" name="lastname" placeholder='Palencia'>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label>Middle Name</label>
												<input type="text" class="form-control" name="middlename" placeholder='Trono'>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label>Suffix</label>
												<input type="text" class="form-control" name="suffix" placeholder='Jr'>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
											<label>Gender</label>
												<select name="gender" class="form-control" >
													<option value= "" selected>Please Select</option>
													<option value="M">Male</option>
													<option value="F">Female</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label>Birth Date</label>
											<input type="date" class="form-control" name='birthDate' autocomplete="off"  placeholder='yyyy/mm/dd'>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label>Civil Status</label>
												<select name="civilStatus" class="form-control" >
													<option value= "" selected>Please Select</option>
													<option value="Single">Single</option>
													<option value="Married">Married</option>
													<option value="Widowed/ER">Widowed/ER</option>
													<option value="Child">Child</option>
													<option value="Seperated">Seperated</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											<label>Contact Number</label>
											<input type="text" class="form-control" name="contactNumber" placeholder='09123456789'>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
											<label>House No./Lot/Bldg.:</label>
												<input type="text" class="form-control" name="houseNo" id="houseNo" placeholder='#8459'>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
											<label>Street/Brgy.:</label>
												<input type="text" class="form-control" name="streetBrgy" id="streetBrgy" data-type='streetBrgy' placeholder='Tagbak'>
												<div id='streetBrgyResult'></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Municipality/City:</label>
													<input type="text" class="form-control" name="muniCity" id="muniCity" data-type='muniCity' placeholder='Iloilo'>
													<div id='muniCityResult'></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Province:</label>
													<input type="text" class="form-control" name="province" id="province" data-type='province' placeholder='Iloilo'>
													<div id='provinceResult'></div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Region:</label>
													<input type="text" class="form-control" name="region" placeholder='Region VI' id="region" data-type='region'>
													<div id='regionResult'></div>

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Country:</label>
													<input type="text" class="form-control" name="country" id="country" data-type= 'country' placeholder='Philippines'>
													<div id='countryResult'></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<button type="button" class="btn btn-md btn-success" id="formSubmit">Save</button>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="formResult">
												
											</div>
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
					<div class="copyright ml-auto nav-link">
					© 2020 | HIS Department
					</div>				
				</div>
			</footer>
		</div>
		<!-- End Custom template -->
	</div>
<!--	<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script> -->
	
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap.min.js"></script>
	<script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
</body>
</html>