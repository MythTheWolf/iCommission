<?php include_once $_SERVER['DOCUMENT_ROOT'].'/lib/bootstrap.php';?>
<html>
<head>

<script src="http://cdn.jsdelivr.net/sockjs/1.0.1/sockjs.min.js"></script>
<style>
.box {
	width: 300px;
	float: left;
	margin: 0 20px 0 20px;
}

.box div, .box input {
	border: 1px solid;
	-moz-border-radius: 4px;
	border-radius: 4px;
	width: 100%;
	padding: 0px;
	margin: 5px;
}

.box div {
	border-color: grey;
	height: 300px;
	overflow: auto;
}

.box input {
	height: 30px;
}

h1 {
	margin-left: 30px;
}

body {
	background-color: #F0F0F0;
	font-family: "Arial";
}
</style>
</head>
<body lang="en">
	<h1>SockJS Echo example</h1>

	<div id="first" class="box">
		<div></div>
		<form>
			<input autocomplete="off" value="Type here..."></input>
		</form>
	</div>

	<script>
		var sockjs_url = 'http://192.168.1.71:9999/echo';
		var sockjs = new SockJS(sockjs_url);
		$('#first input').focus();

		var div = $('#first div');
		var inp = $('#first input');
		var form = $('#first form');

		var print = function(m, p) {
			p = (p === undefined) ? '' : p;
			div.append($("<code>").text(m + ' ' + p));
			div.append($("<br>"));
			div.scrollTop(div.scrollTop() + 10000);
			alert(p)
		};

		sockjs.onopen = function() {
			print('[*] open', sockjs.protocol);
		};
		sockjs.onmessage = function(e) {
			print('[.] message', e.data);
		};
		sockjs.onclose = function() {
			print('[*] close');
		};

		form.submit(function() {
			print('[ ] sending', inp.val());
			sockjs.send(inp.val());
			inp.val('');
			return false;
		});
	</script>
</body>
</html>