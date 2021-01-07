<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Patient Diary</title>
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
	.table td.x, .table  td.o { 
		vertical-align: top !important;
		height:150px;
		padding:1% !important; 
	}
	.table th.header {
		min-width: 150px;
		max-width: 100%;
		padding: 5px !important;
		height: 1px; 
	}
	.cursor, .cursor span {
		cursor: pointer;
	}
	.cursor .btn {
		font-size:14px;
		padding:2%;
	}
	#physicianResult, #addP, #nurseResult, #addN {
    	cursor: pointer;
	}
	.list-group-item.physician, .list-group-item.nurse  {
		color:#fff;
	}
	.form-control:disabled, .form-control[readonly] {
		opacity:1 !important;
		background-color: #1a2035 !important;
    	color: #fff !important;
    	border-color: #2f374b !important;
	}
	@media (max-width: 1366px) {
		.table td, .table th {
			font-size:12px;
			padding: 0 1% !important;
		}
		.table td.x, .table  td.o { 
			height:120px;
		}
		.table th.header {
			min-width: 120px;
		}
		.btn {
			font-size:12px;
		}
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
                    
						<h2 class="text-white pb-2">Patient Diary</h2>
                        
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark bg-primary-gradient">
								<div class="card-body">
								<div class="row no-gutters align-items-center">
								<?php 
                    include('config.php');
					#include('functions.php');
$mi_nurse = '{"0":"Name: Faith Rose Harder Baylen Start:      2020-10-14 End:      2020-10-17","1":"Name: Ahlerose Palabrica Bandong Start: 2020-10-14 End: 2020-10-26"}';
$mi_nurse = preg_replace('/[^A-Za-z0-9\-\s\,]/', '', $mi_nurse);
$mi_nurse = preg_replace('/[0-9]+Name/', 'Name', $mi_nurse);
$mi_nurse = preg_replace('/Name /', '', $mi_nurse);
$mi_nurse_name = preg_replace('/ Start +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}+ End +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse); 
$mi_end = preg_replace('/[A-Za-z]| Start +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse);
$mi_start = preg_replace('/[A-Za-z]| End +[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}/', '', $mi_nurse);

$mi_nurse_name = preg_split('/,/',$mi_nurse_name);
$mi_start = preg_split('/,/',$mi_start);
$mi_end = preg_split('/,/',$mi_end);
					
                    $pid = (isset($_GET['pid'])) ? $_GET['pid'] : '' ;
					$select = mysqli_query($con, "SELECT id_pid, CONCAT(id_firstname,' ', id_lastname,' ', id_middlename) AS patient_fullname FROM `tb_id_patients` WHERE id_pid='$pid'") or die(mysqli_error($con));
					if(mysqli_num_rows($select)<>0){
						while($row=mysqli_fetch_assoc($select)){
							$id = $row['id_pid'];
							$fullname = ucfirst($row['patient_fullname']);
						}
						echo '<div class="col-md-6">
							<h4>Patient ID: '.$id.'</h4>
							<h5>Patient Name: '.$fullname.'</h5>
						</div>';
					} else {
						echo '<div class="col-md-6"><h4>No available result</h4></div>';
					}
						
                    ?>
									
<?php
if(isset($id)) {
	$calendar = mysqli_query($con, "SELECT * FROM `tb_id_medical_info` WHERE id_pid='$id' AND mi_init='yes'") or die(mysqli_error($con));
	if(mysqli_num_rows($calendar)<>0) {
		while($row=mysqli_fetch_assoc($calendar)) {
			$miid = $row['miid'];
			$mi_init_date = $row['mi_init_date'];
			$mi_disease = $row['mi_disease'];
			$mi_room = $row['mi_room'];
			$mi_chief_complaint = $row['mi_chief_complaint'];
			$mi_physician = $row['mi_physician'];
			$mi_nurse = $row['mi_nurse'];
			$mi_physician = $row['mi_physician'];
			$nurses = explode(',', $mi_nurse);
			foreach($nurses as $nurse => $value) {
				#echo $value .'<br>';
			} 
			#echo 'Date: '. $mi_init_date.' |Physician '.$mi_physician.' |Nurse: '.$mi_nurse.'<br>';
			
			#echo '<br>'.$mi_physician;
		}
	}
}
?>
											<div class="col-md-6 mb-0" id='monthPicker'></div>
										</div>
                                   <div id="fetchCalendar"></div>
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
    <script src="../../assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="../../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js" charset="utf-8"></script>
    <script src="../../assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../../assets/js/plugin/moment/moment.min.js"></script>
    <script src="../../assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>
    <script src="../../assets/js/atlantis.min.js"></script>
	<script>
	<?php
		$dateComponents = getdate();
		$month = $dateComponents['mon'];	     
		$year = $dateComponents['year'];
		$monthName = $dateComponents['month'];
	?>
	$(document).ready(function () {
		var pid = <?php echo $pid = $_GET['pid'];?>;
		var d = new Date();
		var month = d.getMonth();
		var year = d.getFullYear();
		var day = d.getDate();
		var myPicker = '<div class="input-group no-gutters"><div class="input-group-prepend col-6"><span class="input-group-text"><i class="fa fa-calendar-alt"></i></span><select class="form-control rounded-0" name="month"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></div><div class="input-group-append col-6"><input type="text" class="form-control rounded-0" value="'+year+'" name="year"><button type="button" class="btn btn-warning filter">Filter</button></div></div>';
		$("#monthPicker").append(myPicker);
			$.ajax ({
				url: 'calendar-process.php',
				method: 'post',
				data: {
					pid:pid,
					month: '<?php echo $month; ?>',
					year: '<?php echo $year; ?>'
				},
				success:function(result) {
					$('#fetchCalendar').fadeIn();
					$('#fetchCalendar').html(result);
				}
			});
			
		$(document).on('click', '.filter', function() {
			var pid = <?php echo $pid = $_GET['pid'];?>;
			var month = $('[name="month"]').children("option:selected").val();
			var year = $('[name="year"]').val();
			$.ajax ({
				url: 'calendar-process.php',
				method: 'post',
				data: {
					pid:pid,
					month: month,
					year: year
				},
				success:function(result) {
					$('#fetchCalendar').fadeIn();
					$('#fetchCalendar').html(result);
				}
			});
		});
		$(document).on('click', '.next', function(e) {
			var pid = <?php echo $pid = $_GET['pid'];?>;
			var month = <?php echo $month+=1; ?>;
			var year = <?php echo $year;?>;
			console.log(month);
			$.ajax ({
				url: 'calendar-process.php',
				method: 'post',
				data: {
					pid:pid,
					month: month,
					year: year
				},
				success:function(result) {
					$('#fetchCalendar').fadeIn();
					$('#fetchCalendar').html(result);
				}
			});
		});
		
		$(document).on('click', '.addMedInfo', function(e) {
			var piid = e.currentTarget.dataset.piid;
			var date = e.currentTarget.dataset.date;
			var disease = e.currentTarget.dataset.disease;
			var chiefc = e.currentTarget.dataset.chiefc;
			var room = e.currentTarget.dataset.room;
			var doctor = e.currentTarget.dataset.physician;
			var nurse = e.currentTarget.dataset.nurse;
			$('#addMedInfo').modal('show');
			$('#addMedInfo').on('shown.bs.modal', function () {
				var modal  = $(this);
				var title = 'Patient ID: ' + piid;
				modal.find('#viewTitle').html(title);
				modal.find('[name="date"]').attr('data-piid', piid);
				modal.find('[name="date"]').attr('data-disease', disease);
				modal.find('[name="date"]').attr('data-chiefc', chiefc);
				modal.find('[name="date"]').val(date);
				modal.find('[name="room"]').val(room);
				modal.find('[name="disease"]').val(disease);
				modal.find('#appendPhysician').append(doctor);
				modal.find('#appendNurse').append(nurse);
			});
			
			$('#addMedInfo').on('hide.bs.modal', function () {
				location.reload();
			});
			//Doctor
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

				var group = '<div class="input-group mb-1 border border-dark '+dr.replace(/ |\./g,"-")+'" data-name="'+dr.replace(/\./g,"")+'" data-type="physician" data-id="'+id+'"><input type="text" class="form-control" name="aphysician" id="aphysician" data-type="aphysician" value="'+dr+'" readonly><div class="input-group-append"><span class="input-group-text btn btn-danger rounded-0 border-0" id="removeP" data-val="'+dr.replace(/ |\./g,"-")+'"><i class="fas fa-minus"></i></span></div></div>';
				$('#appendPhysician').fadeIn();
				$("#appendPhysician").append(group);
				$("#physician").val("");

				}
			});
			$(document).on('click', 'span#removeP', function (e) { 
				var x = e.target.dataset.val;
				var xid = "."+x;
				$(xid).remove();
				$(xid).fadeOut();
			
			});
			$("#nurse").keyup(function() {
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
			$("#nurse").focusout(function() {
				$('#nurseResult').fadeOut();
			});
			//Nurse
			$(document).on('click', 'span#addN', function () {
				var name = $.trim($("#nurse").val());
				var start = $.trim($("#start").val());
				var end = $.trim($("#end").val());
				if(name!="") {
					if(start!="") {
						if(end!="") {
							var group = '<div class="input-group mb-1 border border-dark '+name.replace(/ |\./g,"-")+'" data-name="'+name+'" data-start="'+start+'" data-end="'+end+'"><input type="text" class="form-control" name="anurse" id="anurse" data-type="anurse" value="'+name+'" readonly><input type="text" class="form-control" name="astart" id="astart" data-type="astart" value="'+start+'" readonly><input type="text" class="form-control" name="aend" id="aend" data-type="aend" value="'+end+'" readonly><div class="input-group-append"><span class="input-group-text btn btn-danger rounded-0 border-0" id="removeN" data-val="'+name.replace(/ |\./g,"-")+'"><i class="fas fa-minus"></i></span></div></div>';
							$('#appendNurse').fadeIn();
							$("#appendNurse").append(group);
							$("#nurse").val("");
							$("#start").val("");
							$("#end").val("");
						} 
					}
				}
			});
			$(document).on('click', 'span#removeN', function (e) { 
				var x = e.target.dataset.val;
				var xid = "."+x;
				$(xid).remove();
				$(xid).fadeOut();
			});
		});//end addMedinfo
		//form process
		$("#formSubmit").click(function(e) {
			//doctor array
			var arrPhysician = [];
			$.each($("#appendPhysician").children(), function() {
				arrPhysician.push($(this).data("id"));
         	});
			//nurse array
			var arrNurse = [];
			$.each($("#appendNurse").children(), function(key, value) {
				var name = 'Name: '+$(this).data("name") +  ' Start: ' + $(this).data("start") + ' End: ' + $(this).data("end");
				arrNurse.push(name);
         	 });
			//e.preventDefault();
			var type = 'diary_insert';
			var query = 'mi_insert';
			
			if($('[name="entry"]').val().length!=0) {
				if($('[name="procedure"]').val().length!=0) {
					if(arrPhysician.length!=0) { 
						if(arrNurse.length!=0) { 
							//declare and sanitize inputs
							var piid = $('[name="date"]').data('piid');
							var disease = $('[name="date"]').data('disease');
							var chiefc = $('[name="date"]').data('chiefc');
							var date = $('[name="date"]').val();
							var room = $('[name="room"]').val();
							var entry = $('[name="entry"]').val();//

							var procedure = $('[name="procedure"]').val();
							var medication = $('[name="medication"]').val();
							var physcian = arrPhysician;
							var nurse = arrNurse;
							//ajax
							$.ajax ({
								url: 'data.php',
								method: 'post',
								data: {
									type:type,
									query:query,
									id_pid:piid,
									mi_init_date:date,
									mi_disease:disease,
									mi_chief_complaint:chiefc,
									mi_room:room,
									mi_init:entry,
									mi_procedure:procedure,
									mi_medication:medication,
									mi_physician:physcian,
									mi_nurse:nurse
								},
								success:function(result) {
									$('.modal-body').addClass('is-loading is-loading-lg');
									setTimeout(function() { 
										$('.modal-body').removeClass('is-loading is-loading-lg');
										$('#formResult').fadeIn();
										$('#formResult').html(result);
										setTimeout(function() {
											location.reload();
										},1000);
									}, 1000);
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
				} else {
					$('#formResult').fadeIn();
					$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Procedure is required</div>');
				}
			} else {
				$('#formResult').fadeIn();
				$('#formResult').html('<div class="alert alert-danger text-dark animated fadeIn"><strong>Error! </strong>Diary entry name is required</div>');
			}
		});
		//start view and update
		$(document).on('click', '.viewMedInfo', function(e) {
			
			var miid = e.currentTarget.dataset.miid;
			var piid = e.currentTarget.dataset.piid;
			var name = e.currentTarget.dataset.name;
			var date = e.currentTarget.dataset.date;
			var disease = e.currentTarget.dataset.disease;
			var room = e.currentTarget.dataset.room;
			var entry = e.currentTarget.dataset.entry;
			var chiefc = e.currentTarget.dataset.chiefc;
			var physician = e.currentTarget.dataset.physician;
			var nurse = e.currentTarget.dataset.nurse;
			var procedure = e.currentTarget.dataset.procedure;
			var medication = e.currentTarget.dataset.medication;
			console.log(miid);
			$('#viewMedInfo').modal('show');
			$('#viewMedInfo').on('shown.bs.modal', function () {
				var modal  = $(this);
				var title = 'Patient ID: ' + piid;
				//var message = 'Initial Checkup: '+ date+'<br>Name: '+name+'<br>Infectious Disease: '+ disease + '<br> Room: '+room+ '<br> Chief Complaint: '+chiefc+'<br>Assigned Physician(s): '+physician+'Assigned Nurse(s): '+nurse+'Procedures: '+procedure+'<br> Medication: '+medication;
				modal.find('#viewTitle').html(title);
				modal.find('[name="date"]').attr('data-miid', miid);
				modal.find('[name="date"]').attr('data-piid', piid);
				modal.find('[name="date"]').attr('data-disease', disease);
				modal.find('[name="date"]').attr('data-chiefc', chiefc);
				modal.find('[name="date"]').val(date);
				modal.find('[name="room"]').val(room);
				modal.find('[name="room"]').val(room);
				modal.find('[name="entry"]').val(entry);
				modal.find('[name="procedure"]').append(procedure);
				modal.find('[name="medication"]').append(medication);
				modal.find('[name="disease"]').val(disease);
				modal.find('#appendPhysician').append(physician);
				modal.find('#appendNurse').append(nurse);
			});
			$('#viewMedInfo').on('hide.bs.modal', function() {
				location.reload();
			});
			//Doctor
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

				var group = '<div class="input-group mb-1 border border-dark '+dr.replace(/ |\./g,"-")+'" data-name="'+dr.replace(/\./g,"")+'" data-type="physician" data-id="'+id+'"><input type="text" class="form-control" name="aphysician" id="aphysician" data-type="aphysician" value="'+dr+'" readonly><div class="input-group-append"><span class="input-group-text btn btn-danger rounded-0 border-0" id="removeP" data-val="'+dr.replace(/ |\./g,"-")+'"><i class="fas fa-minus"></i></span></div></div>';
				$('#appendPhysician').fadeIn();
				$("#appendPhysician").append(group);
				$("#physician").val("");

				}
			});
			$(document).on('click', 'span#removeP', function (e) { 
				var x = e.target.dataset.val;
				var xid = "."+x;
				$(xid).remove();
				$(xid).fadeOut();
			
			});
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
			//Nurse
			$(document).on('click', 'span#addN', function () {
				var name = $.trim($("#nurse").val());
				var start = $.trim($("#start").val());
				var end = $.trim($("#end").val());
				if(name!="") {
					var group = '<div class="input-group mb-1 border border-dark '+name.replace(/ |\./g,"-")+'" data-name="'+name+'" data-start="'+start+'" data-end="'+end+'"><input type="text" class="form-control" name="anurse" id="anurse" data-type="anurse" value="'+name+'" readonly><input type="text" class="form-control" name="astart" id="astart" data-type="astart" value="'+start+'" readonly><input type="text" class="form-control" name="aend" id="aend" data-type="aend" value="'+end+'" readonly><div class="input-group-append"><span class="input-group-text btn btn-danger rounded-0 border-0" id="removeN" data-val="'+name.replace(/ |\./g,"-")+'"><i class="fas fa-minus"></i></span></div></div>';
					$('#appendNurse').fadeIn();
					$("#appendNurse").append(group);
					$("#nurse").val("");
					$("#start").val("");
					$("#end").val("");
				}
			});
			$(document).on('click', 'span#removeN', function (e) { 
				var x = e.target.dataset.val;
				var xid = "."+x;
				$(xid).remove();
				$(xid).fadeOut();
			});

		});
		//end view and update
		//form update
		$("#formUpdate").click(function(e) {
			console.log($('[name="entry"]').val().length);
			//e.preventDefault();
			var arrPhysician = [];
			$.each($("#appendPhysician").children(), function() {
				arrPhysician.push($(this).data("id"));
			});
			//nurse array
			var arrNurse = [];
			$.each($("#appendNurse").children(), function(key, value) {
				var name = 'Name: '+$(this).data("name") +  ' Start: ' + $(this).data("start") + ' End: ' + $(this).data("end");
				arrNurse.push(name);
			});
			var type = 'diary_update';
			var query = 'mi_insert';
			
			if($('[name="entry"]').val().length!=0) {
				if($('[name="procedure"]').val().length!=0) {
					if(arrPhysician.length!=0) { 
						if(arrNurse.length!=0) { 
							//declare and sanitize inputs
							var miid = $('[name="date"]').data('miid');
							var piid = $('[name="date"]').data('piid');
							var disease = $('[name="date"]').data('disease');
							var chiefc = $('[name="date"]').data('chiefc');
							var date = $('[name="date"]').val();
							var room = $('[name="room"]').val();
							var entry = $('[name="entry"]').val();
							var procedure = $('[name="procedure"]').val();
							var medication = $('[name="medication"]').val();
							var physcian = arrPhysician;
							var nurse = arrNurse;
							//ajax
							$.ajax ({
								url: 'data.php',
								method: 'post',
								data: {
									type:type,
									query:query,
									miid:miid,
									id_pid:piid,
									mi_init_date:date,
									mi_disease:disease,
									mi_chief_complaint:chiefc,
									mi_room:room,
									mi_init:entry,
									mi_procedure:procedure,
									mi_medication:medication,
									mi_physician:physcian,
									mi_nurse:nurse
								},
								success:function(result) {
									$('.modal-body').addClass('is-loading is-loading-lg');
									setTimeout(function() { 
										location.reload();
									}, 2000);
									$('#formResult').fadeIn();
									$('#formResult').html(result);
								}
							});
						} else {
							$('#formResult').fadeIn();
							$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Assigned Nurse is required</div>');
						}
					} else {
						$('#formResult').fadeIn();
						$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Assigned Physician is required</div>');
					}
				} else {
					$('#formResult').fadeIn();
					$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Procedure is required</div>');
				}
			} else {
				$('#formResult').fadeIn();
				$('#formResult').html('<div class="alert alert-danger text-dark animated shake"><strong>Error! </strong>Diary entry name is required</div>');
			}
		});
		
	});		
	
</script>
<!-- Modal -->

<div class="modal fade" id="addMedInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary-gradient">
			<h3 class="modal-title text-light" id="viewTitle"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="form-group" id="formResult"></div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3">
							<div class="form-group">
							<label>Date</label>
								<input type="date" class="form-control" name="date" autocomplete="off" value="" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							<label>Room</label>
								<input type="text" class="form-control" name="room">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label>Entry Name</label>
								<input type="text" class="form-control" name="entry"  placeholder='Daily Checkup...'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label>Procedure(s)</label>
							<textarea rows="5" name="procedure" class="form-control" placeholder='Lorem ipsum dolor...'></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label>Medication(s)</label>
							<textarea rows="5" name="medication" class="form-control" placeholder='Lorem ipsum dolor...'></textarea>
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="form-group">
							<label>Physician</label>
								<div class="input-group">
								<input type="text" class="form-control" placeholder="Physician Name" name="physician" id="physician" data-type="physician">
									<div class="input-group-append">
										<span class="input-group-text btn btn-success" id='addP' data-toggle="tooltip" data-placement="top" title="Add Physician"><i class="fas fa-plus"></i></span>
									</div>
								</div>
								<div id='physicianResult'></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group" id='appendPhysician'></div>
						</div>
					</div>	
					<div class="row no-gutters">
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
									<div class="input-group-append">
										<span class="input-group-text btn btn-success" id='addN' data-toggle="tooltip" data-placement="top" title="Add Nurse"><i class="fas fa-plus"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" ><div class="form-group pb-0 pt-0" id='appendNurse'></div></div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="form-group">
								<button type="button" class="btn btn-md btn-success" id="formSubmit">Save Entry</button>
							</div>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="viewMedInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary-gradient">
			<h3 class="modal-title text-light" id="viewTitle"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="form-group" id="formResult"></div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3">
							<div class="form-group">
							<label>Date</label>
								<input type="date" class="form-control" name="date" autocomplete="off" value="" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							<label>Room</label>
								<input type="text" class="form-control" name="room">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label>Entry Name</label>
								<input type="text" class="form-control" name="entry"  placeholder='Daily Checkup...'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label>Procedure(s)</label>
							<textarea rows="5" name="procedure" class="form-control" placeholder='Lorem ipsum dolor...'></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label>Medication(s)</label>
							<textarea rows="5" name="medication" class="form-control" placeholder='Lorem ipsum dolor...'></textarea>
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="form-group">
							<label>Physician</label>
								<div class="input-group">
								<input type="text" class="form-control" placeholder="Physician Name" name="physician" id="physician" data-type="physician">
									<div class="input-group-append">
										<span class="input-group-text btn btn-success" id='addP' data-toggle="tooltip" data-placement="top" title="Add Physician"><i class="fas fa-plus"></i></span>
									</div>
								</div>
								<div id='physicianResult'></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group" id='appendPhysician'></div>
						</div>
					</div>	
					<div class="row no-gutters">
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
									<div class="input-group-append">
										<span class="input-group-text btn btn-success" id='addN' data-toggle="tooltip" data-placement="top" title="Add Nurse"><i class="fas fa-plus"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" ><div class="form-group pb-0 pt-0" id='appendNurse'></div></div>
					</div>
					<!-- <div class="row no-gutters">
						<div class="col-md-12">
							<div class="form-group">
								<button type="button" class="btn btn-md btn-success" id="formUpdate">Update Entry</button>
							</div>
						</div>
						
					</div> -->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>