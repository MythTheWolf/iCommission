<?php
if ($_COOKIE ['LOGGED_IN'] == "false" || empty ( $_COOKIE ['LOGGED_IN'] )) {
	header ( 'Location: /' );
	die ();
}
require_once $_SERVER ['DOCUMENT_ROOT'] . '/lib/user/SiteUser.php';
$USER = new siteUser ( $_COOKIE ['USERNAME'] );
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, shrink-to-fit=no, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Simple Sidebar - Start Bootstrap Template</title>

<!-- Bootstrap Core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="/css/simple-sidebar.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<form id="fieldVars" name="fieldVars">
		<input type="text" name="currentDate" id="currentDate" hidden="true">
		<input type="text" name="page" id="page" hidden="true">
	</form>
	<div id="wrapper" class="toggled">

		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand"><a href="#"> iCommission </a></li>
				<li style="background: rgba(255, 255, 255, 0.2); color: white"><a
					href="#">Dashboard</a></li>
				<li><a href="#">Browse</a></li>
				<li><a href="#">Mail</a></li>
				<li id="COMM_REQUESTS"></li>
			</ul>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1>Upcoming due commissions</h1>
						<hr class="divider">
						<div id="dashboard-upcoming"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- jQuery -->
	<script src="/js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="/js/bootstrap.min.js"></script>

	<!-- Menu Toggle Script -->
	<script>
	function getUrlParam(sParam) {
	    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : sParameterName[1];
	        }
	    }
	}
	 var LOAD = getUrlParam("load");
	 if(LOAD == null || LOAD === ""){
		 LOAD = "default";
	 }
	 
	</script>
	<script>
	(function(){
	    var d = new Date();
	    var curr_date = d.getDate();
	    var curr_month = d.getMonth() + 1; //Months are zero based
	    var curr_year = d.getFullYear();
	    $("#currentDate").val(curr_month + "/" + curr_date + "/" + curr_year );
	    
	 	$.ajax({
		  type: "POST",
		  url: "/lib/API/getDashboardStats.php",
		  data: $("#fieldVars").serialize(),
		  success: function (result) {
			 if(result.indexOf("Warning") > -1 || result.indexOf("Notice") > -1 || result.indexOf("Fatal") > -1 || result.indexOf("error") > -1){
					$("#dialog").html(result);
			 	    $("#dialog" ).dialog();
			 }else{
			  $("#dashboard-upcoming").html(result);
			   var obj = JSON.parse(result);
                $("#COMM_REQUESTS").html("<a href=\"#\">Commission Requests <span class=\"label label-danger\">" + obj.numUnansweredRequets + "</span> </a>");
                if(obj.numPastDue > 0){
                   
                }else{
                    
                }
                if(obj.upComingDues.length > 0){
                    var base = "<table class=\"table table-hover\">    <thead>      <tr>        <th>Project name</th>        <th>User</th>        <th>Catagory</th><th>Description</th><th>Step</th>      </tr>    </thead>    <tbody>";
                    var suffix = "";
                	var arrayLength = obj.upComingDues.length;
                	for (var i = 0; i < arrayLength; i++) {
                	    suffix = suffix+"<tr><td>" + obj.upComingDues[i].name + "</td><td>" + obj.upComingDues[i].endUser + "</td><td>" + obj.upComingDues[i].desc + "</td><td>" + obj.upComingDues[i].step +"</td></tr>";
                	    //Do something
                	}
                	$("#dashboard-upcoming").html(base+suffix+"</tbody></table>");
                }
		  	}
		  }
	 	});   
	    setTimeout(arguments.callee, 600);
	})();
	</script>
</body>

</html>
