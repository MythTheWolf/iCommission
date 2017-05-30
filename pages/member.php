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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
<!-- Custom CSS -->
<link href="/css/simple-sidebar.css" rel="stylesheet">
<link href="/css/avgrund.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.css" rel="stylesheet">
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
				<li style="background: rgba(255, 255, 255, 0.2); color: white"
					id="dashboard-link"><a href="#" id="dashboard-link">Dashboard</a></li>
				<li><a href="#">Browse</a></li>
				<li><a href="#">Mail</a></li>
				<li><a href="#" id="COMM_REQUESTS"> </a></li>
				<li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Page 1-1</a></li>
						<li><a href="#">Page 1-2</a></li>
						<li><a href="#">Page 1-3</a></li>
					</ul></li>
			</ul>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1>Upcoming due commissions</h1>
						<button type="button" id="av" name="av"></button>
						<hr class="divider">
						<div id="dashboard-upcoming"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->



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
	function bind(result){
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
		
			  if(result.indexOf("Warning") == 999 || result.indexOf("Fatal") > -1 || result.indexOf("error") > -1){
					$("#dialog").html(result);
			 	    $("#dialog" ).dialog();
			  }else{
			  $("#dashboard-upcoming").html(result);
			   var obj = JSON.parse(result);
                $("#COMM_REQUESTS").html("Commission reqests <span class=\"label label-danger\">" + obj.numUnansweredRequets + "</span>");
                if(obj.numPastDue > 0){
                   $("#dashboard-link").html("Dashboard <span class=\"label label-danger\">!</span>");
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
