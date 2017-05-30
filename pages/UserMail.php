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

<link rel="stylesheet"
	href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css"
	integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU"
	crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
	integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
	crossorigin="anonymous"></script>
<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	crossorigin="anonymous">
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
	integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
	crossorigin="anonymous"></script>
<script src="/JS/jquery.avgrund.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
<!-- Custom CSS -->
<link href="/css/avgrund.css" rel="stylesheet">
<link
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.css"
	rel="stylesheet">

<style>


/*	--------------------------------------------------
	:: Table Filter
	-------------------------------------------------- */
.panel {
	border: 1px solid #ddd;
	background-color: #fcfcfc;
}

.panel .btn-group {
	margin: 15px 0 30px;
}

.panel .btn-group .btn {
	transition: background-color .3s ease;
}

.table-filter {
	background-color: #fff;
	border-bottom: 1px solid #eee;
}

.table-filter tbody tr:hover {
	cursor: pointer;
	background-color: #eee;
}

.table-filter tbody tr td {
	padding: 10px;
	vertical-align: middle;
	border-top-color: #eee;
}

.table-filter tbody tr.selected td {
	background-color: #eee;
}

.table-filter tr td:first-child {
	width: 38px;
}

.table-filter tr td:nth-child(2) {
	width: 35px;
}

.ckbox {
	position: relative;
}

.ckbox input[type="checkbox"] {
	opacity: 0;
}

.ckbox label {
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

.ckbox label:before {
	content: '';
	top: 1px;
	left: 0;
	width: 18px;
	height: 18px;
	display: block;
	position: absolute;
	border-radius: 2px;
	border: 1px solid #bbb;
	background-color: #fff;
}

.ckbox input[type="checkbox"]:checked+label:before {
	border-color: #2BBCDE;
	background-color: #2BBCDE;
}

.ckbox input[type="checkbox"]:checked+label:after {
	top: 3px;
	left: 3.5px;
	content: '\e013';
	color: #fff;
	font-size: 11px;
	font-family: 'Glyphicons Halflings';
	position: absolute;
}

.table-filter .star {
	color: #ccc;
	text-align: center;
	display: block;
}

.table-filter .star.star-checked {
	color: #F0AD4E;
}

.table-filter .star:hover {
	color: #ccc;
}

.table-filter .star.star-checked:hover {
	color: #F0AD4E;
}

.table-filter .media-photo {
	width: 35px;
}

.table-filter .media-body {
	display: block;
	/* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
}

.table-filter .media-meta {
	font-size: 11px;
	color: #999;
}

.table-filter .media .title {
	color: #2BBCDE;
	font-size: 14px;
	font-weight: bold;
	line-height: normal;
	margin: 0;
}

.table-filter .media .title span {
	font-size: .8em;
	margin-right: 20px;
}

.table-filter .media .title span.pagado {
	color: #5cb85c;
}

.table-filter .media .title span.pendiente {
	color: #f0ad4e;
}

.table-filter .media .title span.cancelado {
	color: #d9534f;
}

.table-filter .media .summary {
	font-size: 14px;
}

/* CSS used here will be applied after bootstrap.css */ /*!
 * Start Bootstrap - SB Admin Bootstrap Admin Template (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

/* Global Styles */
body {
	margin-top: 100px;
	background-color: #222;
}

@media ( min-width :768px) {
	body {
		margin-top: 50px;
	}
}

#wrapper {
	padding-left: 0;
}

#page-wrapper {
	width: 100%;
	padding: 0;
	background-color: #fff;
}

.huge {
	font-size: 50px;
	line-height: normal;
}

@media ( min-width :768px) {
	#wrapper {
		padding-left: 225px;
	}
	#page-wrapper {
		padding: 10px;
	}
}

/* Top Navigation */
.top-nav {
	padding: 0 15px;
}

.top-nav>li {
	display: inline-block;
	float: left;
}

.top-nav>li>a {
	padding-top: 15px;
	padding-bottom: 15px;
	line-height: 20px;
	color: #999;
}

.top-nav>li>a:hover, .top-nav>li>a:focus, .top-nav>.open>a, .top-nav>.open>a:hover,
	.top-nav>.open>a:focus {
	color: #fff;
	background-color: #000;
}

.top-nav>.open>.dropdown-menu {
	float: left;
	position: absolute;
	margin-top: 0;
	border: 1px solid rgba(0, 0, 0, .15);
	border-top-left-radius: 0;
	border-top-right-radius: 0;
	background-color: #fff;
	-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
	box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}

.top-nav>.open>.dropdown-menu>li>a {
	white-space: normal;
}

ul.message-dropdown {
	padding: 0;
	max-height: 250px;
	overflow-x: hidden;
	overflow-y: auto;
}

li.message-preview {
	width: 275px;
	border-bottom: 1px solid rgba(0, 0, 0, .15);
}

li.message-preview>a {
	padding-top: 15px;
	padding-bottom: 15px;
}

li.message-footer {
	margin: 5px 0;
}

ul.alert-dropdown {
	width: 200px;
}

/* Side Navigation */
@media ( min-width :768px) {
	.side-nav {
		position: fixed;
		top: 51px;
		left: 225px;
		width: 225px;
		margin-left: -225px;
		border: none;
		border-radius: 0;
		background-color: #222;
		bottom: 0;
		padding-bottom: 40px;
	}
	.side-nav>li>a {
		width: 225px;
	}
	.side-nav li a:hover, .side-nav li a:focus {
		outline: none;
		background-color: #000 !important;
	}
}

.side-nav>li>ul {
	padding: 0;
}

.side-nav>li>ul>li>a {
	display: block;
	padding: 10px 15px 10px 38px;
	text-decoration: none;
	color: #999;
}

.side-nav>li>ul>li>a:hover {
	color: #fff;
}

/* Flot Chart Containers */
.flot-chart {
	display: block;
	height: 400px;
}

.flot-chart-content {
	width: 100%;
	height: 100%;
}

/* Custom Colored Panels */
.huge {
	font-size: 40px;
}

.panel-green {
	border-color: #5cb85c;
}

.panel-green>.panel-heading {
	border-color: #5cb85c;
	color: #fff;
	background-color: #5cb85c;
}

.panel-green>a {
	color: #5cb85c;
}

.panel-green>a:hover {
	color: #3d8b3d;
}

.panel-red {
	border-color: #d9534f;
}

.panel-red>.panel-heading {
	border-color: #d9534f;
	color: #fff;
	background-color: #d9534f;
}

.panel-red>a {
	color: #d9534f;
}

.panel-red>a:hover {
	color: #b52b27;
}

.panel-yellow {
	border-color: #f0ad4e;
}

.panel-yellow>.panel-heading {
	border-color: #f0ad4e;
	color: #fff;
	background-color: #f0ad4e;
}

.panel-yellow>a {
	color: #f0ad4e;
}

.panel-yellow>a:hover {
	color: #df8a13;
}

.table.table-vertical-middle>thead>tr>th, .table.table-vertical-middle>tbody>tr>td
	{
	vertical-align: middle;
}

.nav i.fa {
	margin: 0 3px 0 0;
}
</style>
</head>

<body>
	<form id="fieldVars" name="fieldVars">
		<input type="text" name="currentDate" id="currentDate" hidden="true">
		<input type="text" name="view" id="view" hidden="true">
		
	</form>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">iCommission</a>
			</div>
			<!-- Top Menu Items -->
			<ul class="nav navbar-right top-nav">
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b
						class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
						<li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>
						<li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
					</ul></li>
			</ul>
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li class=""><a href="/pages/member.php" id="dashboard-link"><i
							class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
					<li class="active"><a href="/pages/UserMail.php?view=inbox"><i class="fa fa-fw fa-comment"></i>
							 Messages</a></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>

		<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Messages</h1>
					</div>
				</div>
				<!-- /.row -->

				<div class="row">
					<div class="container">
						<div class="row">



							<div class="panel panel-default">
								<div class="panel-body">

									<div class="btn-group">
										<button type="button" class="btn btn-success btn-filter"
											data-target="pagado">Inbox</button>
										<button type="button" class="btn btn-warning btn-filter"
											data-target="pendiente">Outbox</button>
										<button type="button" class="btn btn-danger btn-filter"
											data-target="cancelado">Trash</button>
										<button type="button" class="btn btn-default btn-filter"
											data-target="all">Sent</button>
									</div>

									<div class="table-container">
										<table class="table table-filter">
											<tbody>
												<tr>
													<td>
														<div class="ckbox">
															<input type="checkbox" id="checkbox1"> <label
																for="checkbox1"></label>
														</div>
													</td>
													<td><a href="javascript:;" class="star"> <i
															class="glyphicon glyphicon-star"></i>
													</a></td>
													<td>
														<div class="media">
															<a href="#" class="pull-left"> <img
																src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg"
																class="media-photo">
															</a>
															<div class="media-body">
																<span class="media-meta pull-right">Febrero 13, 2016</span>
																<h4 class="title">
																	Lorem Impsum <span class="pull-right pagado">(Pagado)</span>
																</h4>
																<p class="summary">Ut enim ad minim veniam, quis nostrud
																	exercitation...</p>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- /.row -->

			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->


	</div>
</body>


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
	 var LOAD = getUrlParam("view");
	 if(LOAD == null || LOAD === ""){
		 LOAD = "inbox";
	 }
	 
	</script>
<script>
	function bind(result){
		//alert(result);
		$("#editButton").click(function(){
			var ID = $(this).attr("name");
			var obj = JSON.parse(result);
			
		});
	}
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
			//alert(result);
			  if(result.indexOf("Warning") == 999 || result.indexOf("Fatal") > -1 || result.indexOf("error") > -1){
					$("#dialog").html(result);
			 	    $("#dialog" ).dialog();
			  }else{
			  $("#dashboard-upcoming").html(result);
			   var obj = JSON.parse(result);
                $("#COMM_REQUESTS").html("Commission reqests <span class=\"label label-danger\">" + obj.numUnansweredRequets + "</span>");
                if(obj.numPastDue > 0){
                    
                   $("#dashboard-link").html("<i class=\"fa fa-fw fa-dashboard\"></i> Dashboard</a> <span class=\"label label-danger\">!</span>");
                }else{
                    
                }
                if(obj.overDues.length > 0){
                    var base = "<table class=\"table table-hover\" id=\"upcoming\">    <thead>      <tr> <th>Action</th>        <th>Project name</th>        <th>User</th>        <th>Catagory</th> <th>Description</th>  <th>Step</th>     <th>Expected due date</th> </tr>    </thead>    <tbody>";
                    var suffix = "";
                	var arrayLength = obj.overDues.length;
                	for (var i = 0; i < arrayLength; i++) {
                    	if(obj.overDues[i].isWarning == "true"){
                    		suffix = suffix+"<tr class=\"warning\"> <td><button type=\"button\" class=\"btn btn-primary\" id=\"editButton\" name=\" " + obj.overDues[i].id + "\">Edit..</button></td><td>" + obj.overDues[i].name +"</td><td>" + obj.overDues[i].endUser +"</td><td>" + obj.overDues[i].catName + "</td><td>" + obj.overDues[i].desc + "</td><td>" + obj.overDues[i].stepName + "</td><td>" + obj.overDues[i].projectedEnd + "</td>";
                	    //Do something
                    	}else{
                    		suffix = suffix+"<tr class=\"danger\"> <td><button type=\"button\" class=\"btn btn-primary\" id=\"editButton\" name=\" " + obj.overDues[i].id + "\">Edit..</button></td><td>" + obj.overDues[i].name +"</td><td>" + obj.overDues[i].endUser +"</td><td>" + obj.overDues[i].catName + "</td><td>" + obj.overDues[i].desc + "</td><td>" + obj.overDues[i].stepName + "</td><td>" + obj.overDues[i].projectedEnd + "</td>";
                    	}
                	}
                	$("#dashboard-upcoming").html(base+suffix+"</tbody></table>");
                	 bind(result);
                }
			  }
		  	}
	   			
	 	});   
	    setTimeout(arguments.callee, 1000);
	})();

	
	</script>
</body>
<div id="dialog" name="dialog" title="A error has occured" hidden>
	<p>This is the default dialog which is useful for displaying
		information. The dialog window can be moved, resized and closed with
		the 'x' icon.</p>
</div>
</html>
