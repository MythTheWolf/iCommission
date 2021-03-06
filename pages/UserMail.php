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
							<div>
								<img src="/assets/image/load.gif">
							</div>

						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<form id="messageForm" name="messageForm">
								<input type="text" id="partnerID" hidden="true">
								<textarea class="form-control" id="chatMessage"
									custom="chatMessage_page" name="chatMessage"
									placeholder="Enter Message" type="compose" rows="1"></textarea>

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
					<div class="panel-heading">Your conversations <a href="#" onClick="return(false)" id="openCompose" style="color:white">| Compose..</a></div>
					<div class="panel-body">
						<ul class="media-list" id="convoList">


						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div id="compose" hidden="true">
<form class="form-horizontal" id="composeForm">
<fieldset>

<!-- Form Name -->
<legend>Compose</legend>
<div id="warnings"></div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Username</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="Username" class="form-control input-md">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="composeText">Message</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="chatMessage" name="chatMessage"></textarea>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="composeGo"></label>
  <div class="col-md-8">
    <button id="composeGo" name="composeGo" class="btn btn-success" onClick="return(false)">Go</button>
    <button id="composeCance" name="composeCance" class="btn btn-danger" onClick="$('#compose').iziModal('close');">Cancel</button>
  </div>
</div>

</fieldset>
</form>

</div>


</body>


<script></script>
</body>
<script src="/JS/pageScripts/Member/queryComissions.js"></script>

<script src="/JS/pageScripts/global/socketClient.js"></script>
<script src="/JS/pageScripts/UserMail/main.js"></script>
</html>
