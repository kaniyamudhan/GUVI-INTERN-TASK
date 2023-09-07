<?php

include("config.php");
include("session.php");

//count total exp

$v=0;
$v2=0;
$de="Not availabe";
$year="";
$tf=0;
$tt=0;
                            
	$query = "select ID, sum( datediff( ifnull(ID, now()) , PASS) +1 )AS value_sum from login group by id having ID='$s';";
	$query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$student = mysqli_fetch_assoc($query_run); 
	$sum=$student['value_sum'];
							
	$years = floor($sum / 365);
	$months = floor(($sum - ($years * 365))/30.5);
	$days = floor($sum - ($years * 365) - ($months * 30.5));
							
	$v= $years . " Years, " . $months . " Months, " . $days . " Days";

	}
//count mkce exp

	$query = "select ID, sum(datediff(now() , PASS) +1 )AS value_sum from login group by ID having ID='$s';";
	$query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$student = mysqli_fetch_assoc($query_run); 
	$sum=$student['value_sum'];							
	$years = floor($sum / 365);
	$months = floor(($sum - ($years * 365))/30.5);
	$days = floor($sum - ($years * 365) - ($months * 30.5));
							//echo "Days received: " . $sum . " days <br />";
	$v2= $years . " Years, " . $months . " Months, " . $days . " Days";
	}

//active days

	$query = "SELECT ID,PASS FROM login WHERE ID='$s'";
    $query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['PASS'];
	
	if($f!="0000-00-00")
	{
    $year = date('Y', strtotime($f));
	$de=$row['design'];
	}
	else{
		$year = "";
		$de="Not availabe";
	}}

?>


<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>SRMS</title>
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="main">
                        <!-- Logo icon -->
     
                        <!--End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="assets/images/srms.png" alt="homepage" class="light-logo" />
                            
                        </span>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
      
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">

                                <a class="dropdown-item" href="Logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
			<?php include("Aside.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard (Welcome <?php echo $s;?>)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-6">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="fa fa-user"></i></h1>
                                <h4 class="text-white"><b>Total Experience</b></h4>
								<h4 class="text-white"><b><?php echo $v; ?> </b></h4>
								

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-calendar-check"></i></h1>
                                <h4 class="text-white"><b>Active </b></h4>
								<h4 class="text-white"><b><?php echo $year; ?> - Current</b></h4>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class=" mdi mdi-worker"></i></h1>
                                <h4 class="text-white"><b>Designation</b></h4>
								<h4 class="text-white"><b><?php echo $de; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                <h4 class="text-white"><b>Total Experience in MKCE</b></h4>
								<h4 class="text-white"><b><?php echo $v2; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-new-box"></i></h1>
								<h4 class="text-white"><b>Family Members</b></h4>
								<h4 class="text-white"><b><?php echo $tf; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Total Training</b></h4>
								<h4 class="text-white"><b><?php echo $tt; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    
                </div>
								<?php
									
							//count basic		
									$query2 = "SELECT * FROM basic WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$c=0.25;
										}
										else{
											$c=25;
											};
									
									
									$query2 = "SELECT * FROM academic WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$c1=0.25;
										}
										else{
											$c1=25;
											};
									
									
									$query2 = "SELECT * FROM family WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$c2=0.25;
										}
										else{
											$c2=25;
											};

									$query2 = "SELECT * FROM nominee WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$c3=0.25;
										}
										else{
											$c3=25;
											};
									$cf=$c1+$c2+$c3+$c;
						

						//count academic			
									
									
								$query2 = "SELECT * FROM exp WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$d=0.25;
										}
										else{
											$d=25;
											};	
									
								$query2 = "SELECT * FROM posting WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$d1=0.25;
										}
										else{
											$d1=25;
											};	
								$query2 = "SELECT * FROM training WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$d2=0.25;
										}
										else{
											$d2=25;
											};	
									
								$query2 = "SELECT * FROM research WHERE id='$s'";
									$query_run2 = mysqli_query($db, $query2);

									if(mysqli_num_rows($query_run2)== 0)
										{
											$d3=0.25;
										}
										else{
											$d3=25;
											};	
									$cd=$d1+$d2+$d3+$d;
									
									$querybc = "INSERT INTO faculty(bc,ac) VALUES('$cf','$cd')";
									$querybc = "UPDATE faculty SET bc='$cf',ac='$cd' WHERE id='$s'";
									$query_runbc = mysqli_query($db, $querybc);								
										?>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-12">
                        <!-- card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0">Progress Box</h4>
                                <div class="m-t-20">
                                    <div class="d-flex no-block align-items-center">
                                        <span><?php echo $cf; ?>% Basic Profiles</span>
                                        <div class="ml-auto">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="progress">
									
										
										
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php echo $cf; ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex no-block align-items-center m-t-25">
                                        <span><?php echo $cd; ?>% Academic Profiles</span>
                                        <div class="ml-auto">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $cd; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                          
                            </div>
                        </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            		 <?php include "./footer.html" ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>

</body>

</html>