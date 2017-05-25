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
<title>Login Form</title>
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
	<section class="container" id="rootSect" name="rootSect">
		<div class="login">
			<h1>Login</h1>
			<form id="loginForm" name="loginForm">
				<p>
					<input type="text" name="login" id="login" value=""
						placeholder="Email">
				</p>
				<p>
					<input type="password" name="password" id="password" value=""
						placeholder="Password">
				</p>
				<p class="remember_me">
					<label> <input type="checkbox" name="remember_me" id="remember_me">
						Remember me on this computer
					</label>
				</p>
				<p class="submit">
					<input type="submit" name="commit" value="Login" id="commit"
						onClick="return(false)">
				</p>
			</form>
		</div>

		<div class="login-help">
			<p>
				Forgot your password? <a href="index.html">Click here to reset it</a>.
			</p>
		</div>
	</section>

	<script>

	  function shakeForm() {
			var l = 30;
			for (var i = 0; i < 10; i++)
				$("#rootSect").animate({
					'margin-left' : "+=" + ( l = -l ) + 'px',
					'margin-right' : "-=" + l + 'px'
				}, 30);
		}
		
  $( "#commit" ).click(function() {
	  $("#commit").val("Validating..");
	  $("#commit").prop("disabled",true);
	  $.ajax({
		  type: "POST",
		  url: "lib/API/validate.php",
		  data: $("#loginForm").serialize(),
		  success: function (result) {
			$("#commit").val("Login");
			$("#commit").prop("disabled",false);
				if(result.indexOf("Warning") > -1 || result.indexOf("Fatal") > -1 || result.indexOf("error") > -1){
					$("#dialog").html(result);
			 	    $("#dialog" ).dialog();
				}else if(result == "OK"){
					alert("HI");
				}else{
					shakeForm();
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
</body>
</html>
