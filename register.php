<?php
error_reporting ( 0 );
if ($_COOKIE ['LOGGED_IN'] == "true") {
	header ( 'Location: /pages/member.php' );
	die ();
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<link rel="stylesheet" href="css/style.css">
<link
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
	rel="stylesheet"
	integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
	crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
	integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
	crossorigin="anonymous"></script>
<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>
<?php

if (! empty ( $_GET ['action'] )) {
	?>
	<script>
	function redirect(){
		window.location = "/";
	}
	</script>
	<section class="container" id="rootSect" name="rootSect">
		<div class="login">
			<h1>Account Created!</h1>
			<div align="center">
			<p>
			Your account has been created! <br />
			You may now head to the home page a login. <br />
			<input type="submit" id="commit" name="commit" value="Return to home page" onclick="redirect();">
			</p>
			
			</div>
		</div>

		<div class="login-help"></div>
	</section>
	
<?php
} else {
	?>
	<section class="container" id="rootSect" name="rootSect">
		<div class="login">
			<h1>Account Creation</h1>
			<form id="loginForm" name="loginForm">
				<p>
					<input type="text" name="login" id="login" value=""
						placeholder="Username">
				</p>
				<p>
					<input type="text" name="email" id="email" value=""
						placeholder="E-mail">
				</p>
				<p>
					<input type="password" name="password" id="password" value=""
						placeholder="Password">
				</p>
				<p>
					<input type="password" name="password_confirm"
						id="password_confirm" value="" placeholder="Confirm Password">
				</p>
				<p>
					<input type="text" name="gender" id="gender" value=""
						placeholder="I identify as...">
				</p>
				<p class="submit">
					<input type="submit" name="commit" value="Login" id="commit"
						onClick="return(false)">
				</p>
			</form>
		</div>

		<div class="login-help"></div>
	</section>

	<script>

	  function shakeForm() {
			var l = 30;
			for (var i = 0; i < 10; i++)
				$("#rootSect").animate({
					'margin-left' : "+=" + ( l = -l ) + 'px',
					'margin-right' : "-=" + l + 'px'
				}, 35);
		}
	  /**
	   * Create cookie with javascript
	   *
	   * @param {string} name cookie name
	   * @param {string} value cookie value
	   * @param {int} days2expire
	   * @param {string} path
	   */
	  function create_cookie(name, value, days2expire, path) {
	    var date = new Date();
	    date.setTime(date.getTime() + (days2expire * 24 * 60 * 60 * 1000));
	    var expires = date.toUTCString();
	    document.cookie = name + '=' + value + ';' +
	                     'expires=' + expires + ';' +
	                     'path=' + path + ';';
	  }
  $( "#commit" ).click(function() {
	  $("#commit").val("Validating..");
	  $("#commit").prop("disabled",true);
	  $.ajax({
		  type: "POST",
		  url: "lib/API/register.php",
		  data: $("#loginForm").serialize(),
		  success: function (result) {
			$("#commit").val("Login");
			$("#commit").prop("disabled",false);
				if(result.indexOf("Warning") > -1 || result.indexOf("Fatal") > -1 || result.indexOf("error") > -1){
					$("#dialog").html(result);
			 	    $("#dialog" ).dialog();
				}else if(result == "ERR_NUMFIELDS"){
					$("#dialog").html("Please fill out all fields.");
			 	    $("#dialog" ).dialog();
				}else if(result == "ERR_PASSWORDMIX"){
					$("#dialog").html("Passwords do not match.");
			 	    $("#dialog" ).dialog();
				}else{
					window.location = "?action=done";
				}	
			}
		});
	});
	
  </script>
	<div id="dialog" name="dialog" title="A error has occured" hidden>
		<p>This is the default dialog which is useful for displaying
			information. The dialog window can be moved, resized and closed with
			the 'x' icon.</p>
	</div>
<?php
}
?>
</body>
</html>
