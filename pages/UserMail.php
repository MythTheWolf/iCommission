<?php include_once $_SERVER['DOCUMENT_ROOT'].'/lib/bootstrap.php';?>
<div style="font-family: Verdana">
	<div class="container" style="overflow: hidden;">
		<div class="row " style="padding-top: 40px; overflow: hidden;">
			<div class="col-md-8">
				<div class="panel panel-info">
					<div class="panel-heading"
						style="background: rgba(144, 144, 144, 0.4);" id="chatbox-header">Chat
						with {username}</div>
					<div class="panel-body" style="">
						<ul class="media-list" id="chatbox">
						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<form id="messageForm" name="messageForm">
								<input type="text" id="partnerID" hidden="true">
								<textarea class="form-control" id="chatMessage"
									name="chatMessage_page" placeholder="Enter Message" rows="1"></textarea>

							</form>
							<span class="input-group-btn">
								<button class="btn btn-info" type="button" id="commit-text"
									name="commit-text">SEND</button>
							</span>

						</div>
						<div class="checkbox">
							<label><input type="checkbox" value="0" id="follow">Follow thread</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Your conversations</div>
					<div class="panel-body">
						<ul class="media-list">

							<li class="media">

								<div class="media-body">

									<div class="media">
										<a class="pull-left" href="#"> <img
											class="media-object img-circle"
											style="height: 40px; width: 40px;"
											src="http://4.bp.blogspot.com/_22tHQU4Gxcumulus1.jpg"
											onerror="this.src='/assets/image/logo-default.png'" />
										</a>
										<div class="media-body">
											<h5>Alex Deo | User</h5>

											<small class="text-muted">Active From 3 hours</small>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>



</body>


<script></script>
</body>
<div id="dialog" name="dialog" title="A error has occured" hidden>
	<p>This is the default dialog which is useful for displaying
		information. The dialog window can be moved, resized and closed with
		the 'x' icon.</p>
</div>
<script src="/JS/pageScripts/Member/queryComissions.js"></script>
<script src="/JS/pageScripts/UserMail/main.js"></script>
</html>
