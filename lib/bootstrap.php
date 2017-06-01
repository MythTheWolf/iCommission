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
<link rel="stylesheet" href="/css/iziToast.css">
<script src="/JS/iziToast.js"></script>

<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.4.2/css/iziModal.css">
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.4.2/js/iziModal.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.0.3/howler.core.min.js"></script>
<style>

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
		<input type="text" name="page" id="page" hidden="true">
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
					<li id="liDashboard" class=""><a href="?" id="dashboard-link"><i
							class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
					<li id="liMessages"><a href="/pages/UserMail.php?view=inbox"><i
							class="fa fa-fw fa-comment"></i> Messages</a></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>

		<script src="/JS/systemPoll.js"></script>
		<script src="/JS/pageScripts/Member/queryComissions.js"></script>

		<script>
	function activate(my){
		$("#"+my).addClass("active");
	}
	</script>
		<div id="modal" hidden="true">
			<form class="form-horizontal" id="replyForm" name="replyForm">
				<fieldset>

					<!-- Form Name -->
					<legend align="center">Reply to message</legend>

					<!-- Textarea -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="textarea">Message</label>
						<div class="col-md-4">
							<textarea class="form-control" id="chatMessage"
								name="chatMessage" placeholder="Message.."></textarea>
						</div>
					</div>

					<!-- Button (Double) -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="button1id"></label>
						<div class="col-md-8">
							<button id="button1" type="button" name="button1"
								class="btn btn-success" onclick="doThing()">Go</button>
							<button id="button2id" type="button" name="button2id"
								class="btn btn-danger" onclick="$('#modal').iziModal('close');">Cancel</button>
						</div>
					</div>

				</fieldset>
			</form>

		</div>
		<input id="userID" name="userID" value="<?php echo siteUser::convertToId($_COOKIE['USERNAME']);?>" hidden="true">
		<script src="/JS/pageScripts/global/replyMessage.js"></script>
		<script>
		$.get("/lib/API/heartBeat.php?id=" + $("#userID").val());
		</script>