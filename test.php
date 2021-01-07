
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>MIHMCI RT-PCR Daily Statiscal Result</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/images/logo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<link rel="stylesheet" href="jquery-ui.css">
<body style="background-color:#458af7">
	<div class="wrapper fullheight-side sidebar_minimize">
		 
	<style type="text/css" >
#hidden_div{
	
display: none; }
    }
</style>


<div class='main-header'>
   <!-- Logo Header -->
   <div class='logo-header' data-background-color='blue'>
    <a href='index.php' class='logo'>
     <img src='../assets/images/logo.png' width='32' alt='navbar brand' class='navbar-brand'><font color='#fff'><b> MIHMCI iBB</b></font>
    </a>
    <button class='navbar-toggler sidenav-toggler ml-auto' type='button' data-toggle='collapse' data-target='collapse' aria-expanded='false' aria-label='Toggle navigation'>
     <span class='navbar-toggler-icon'>
      <i class='icon-menu'></i>
     </span>
    </button>
    <button class='topbar-toggler more'><i class='icon-options-vertical'></i></button>
    <div class='nav-toggle'>
     <button class='btn btn-toggle toggle-sidebar'>
      <i class='icon-menu'></i>
     </button>
 </div>
   </div>
   <!-- End Logo Header -->
    
    
    
    <!-- Navbar Header -->
   <nav class='navbar navbar-header navbar-expand-lg' data-background-color='blue2'>
    
    <div class='container-fluid'>
     <div class='collapse' id='search-nav'>
       
        <font color='#fff'>Metro Iloilo Hospital & Medical Center, Inc.</font>
       
     </div>
    
    </div>
   </nav>
   <!-- End Navbar -->
  </div> 

<!-- Sidebar -->
<div class='sidebar sidebar-style-2'>
   <div class='sidebar-wrapper scrollbar scrollbar-inner'>
    <div class='sidebar-content'>
    <ul class='nav nav-primary'>
 </ul>
  </div>
   </div>
  </div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="container">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Statistical Data</h2>
							</div> 
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body" style="background-color: #1572e8;">
									<div class="row">
										<div class="form-group">
										<label>Input Date Picker</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-calendar-alt"></i>
													</span>
												</div>
												<input type="text" class="form-control" id="datepicker" name="datepicker">
												<select class="form-control rounded-0" name="result"><option value="0"></option><option value="1">Positive</option><option value="2">Negative</option></select>
												<div class="input-group-append">
													<button type="button" class="btn btn-warning filter">Filter</button>	
												</div>
											</div>
										</div>
										<div class="col-12" id="statResult"></div>
                                        
										<!--<div class="col-12 mb-3" id="chart-container"><canvas class="bg-light" id="multipleBarChart"></canvas></div>
										<div class="col-12 mb-3" id="chart-container"><canvas class="bg-light" id="pCity"></canvas></div>
										<div class="col-12 mb-3" id="chart-container"><canvas class="bg-light" id="pProvince"></canvas></div>
										<div class="col-12 mb-3" id="chart-container"><canvas class="bg-light" id="pRegion"></canvas></div>-->
									</div>                      
								</div><!-- end card-body-->
							</div>
						</div>
						 
					</div>
				</div>
			</div>
		<br>
		<br>
		<br>
		<br>
			<footer class="footer">
				<div class="container-fluid">
					 
					<div class="copyright ml-auto">
					&copy; 2020 | HIS Department
					</div>				
				</div>
			</footer>
		</div>
	
		 
		 
		 
	</div>

	<script>
 function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
   
     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

	 

}</script>
  <!--  var x = <?php# echo $id; ?>;
	 window.location.href = "rtpcr.reg2.php?rtid=" + x + "&&type=" + x;   --> 
  <!--   Core JS Files   --> 
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Moment JS -->
	<script src="../assets/js/plugin/moment/moment.min.js"></script>

	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- Bootstrap Toggle -->
	<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Google Maps Plugin -->
	<script src="../assets/js/plugin/gmaps/gmaps.js"></script>

	<!-- Dropzone -->
	<script src="../assets/js/plugin/dropzone/dropzone.min.js"></script>

	<!-- Fullcalendar -->
	<script src="../assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>

	<!-- DateTimePicker -->
	<script src="../assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

	<!-- Bootstrap Tagsinput -->
	<script src="../assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

	<!-- Bootstrap Wizard -->
	<script src="../assets/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

	<!-- jQuery Validation -->
	<script src="../assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>

	<!-- Summernote -->
	<script src="../assets/js/plugin/summernote/summernote-bs4.min.js"></script>

	<!-- Select2 -->
	<script src="../assets/js/plugin/select2/select2.full.min.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Owl Carousel -->
	<script src="../assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>

	<!-- Magnific Popup -->
	<script src="../assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	 
	<script>
	$(document).ready(function () {
		$('#datepicker').datetimepicker({
			format: 'MM/DD/YYYY',
		});
		
		$(document).on('click', '.filter', function() {
			var date = $('[name="datepicker"]').val();
			if(date!=0){
				$.ajax ({
					url: 'stat.php',
					method: 'post',
					data: {
						filter:'byDate',
						date: date
					},
					success:function(result) {
						$('#statResult').fadeIn();
						$('#statResult').html(result);
					}
				});
			}
		});
		//chart
var multipleBarChart = document.getElementById('multipleBarChart').getContext('2d');

var myMultipleBarChart = new Chart(multipleBarChart, {
	type: 'bar',
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],//regions
		datasets : [{
			label: "Negative Results",
			backgroundColor: '#31CE36',
			borderColor: '#31CE36',
			data: [95, 100, 112, 101, 144, 159, 178, 156, 188, 190, 210, 245],
		},{
			label: "Positive Results",
			backgroundColor: '#F25961',
			borderColor: '#F25961',
			data: [145, 256, 244, 233, 210, 279, 287, 253, 287, 299, 312,356],
		}],
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		legend: {
			position : 'bottom'
		},
		title: {
			display: true,
			text: 'City'
		},
		tooltips: {
			mode: 'index',
			intersect: false
		},
		responsive: true,
		scales: {
			xAxes: [{
				stacked: true,
			}],
			yAxes: [{
				stacked: true
			}]
		}
	}
});
//bar
var pCity = document.getElementById('pCity').getContext('2d');
var pProvince = document.getElementById('pProvince').getContext('2d');
var pRegion = document.getElementById('pRegion').getContext('2d');

var myBarChart = new Chart(pCity, {
	type: 'bar',
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets : [{
			label: "Positive Result (City)",
			backgroundColor: '#F25961',
			borderColor: '#F25961',
			data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
		}],
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true
				}
			}]
		},
	}
});
var prol = $('#prol').data("prol");
console.log(prol);
var myBarChart = new Chart(pProvince, {
	type: 'bar',
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets : [{
			label: "Positive Result (Province)",
			backgroundColor: '#F25961',
			borderColor: '#F25961',
			data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
		}],
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true
				}
			}]
		},
	}
});
var myBarChart = new Chart(pRegion, {
	type: 'bar',
	data: {
		labels: [, "", "(CAR)", "(NCR)", "REGION II", "REGION IX", "REGION V", "REGION VI", "REGION VII", "REGION VIII", "REGION X", "REGION XI", "REGION XII", "VI"],
		datasets : [{
			label: "Positive Result (Region)",
			backgroundColor: '#F25961',
			borderColor: '#F25961',
			data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
		}],
	},
	options: {
		responsive: true,
		maintainAspectRatio: false,
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true
				}
			}]
		},
	}
});
	});
	</script>
</body>
</html>