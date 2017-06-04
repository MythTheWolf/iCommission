socket
		.on(
				"message_push",
				function(data) {
					alert(data);
					var JSONOBJ = JSON.parse(data);
					var toAppend = "<div id=\"message_"
							+ "\"><li class=media><div class=media-body><div class=media><a class=pull-left href=#><img class=\"img-circle media-object\"onerror='this.src=\"/assets/image/logo-default.png\"'src=\"\"style=width:50px;height:50px></a><div class=media-body><small class=text-muted>"
							+ JSONOBJ.senderName + "</small><br>"
							+ JSONOBJ.message
							+ "</div></div></div></li><hr></div>";
					$("#chatbox").append(toAppend);

				});

$
		.ajax({
			type : "POST",
			url : "/lib/API/getConvoList.php",
			data : $("#fieldVars").serialize(),
			success : function(result) {
				var OB = JSON.parse(result);
				var arrayLength = OB.list.length;
				setChat(OB.list[0].id);
				for (var i = 0; i < arrayLength; i++) {
					var appendstr = "<li class=\"media\"> <div class=\"media-body\"> <div class=\"media\"> <a class=\"pull-left\" href=\"#\" onClick=\"setChat('"
							+ OB.list[i].id
							+ "')\"> <img class=\"media-object img-circle\" style=\"height: 40px; width: 40px;\" src=\""
							+ OB.list[i].icon
							+ "\"/> </a> <div class=\"media-body\"> <h5>"
							+ OB.list[i].user
							+ "</h5> <small class=\"text-muted\">"
							+ OB.list[i].content
							+ "</small> </div> </div> </div> </li>";
					$("#convoList").append(appendstr);
				}
			}
		});
function setChat(theId) {
	$("#selectedChat").val(theId);
	remakeThread();
}
function remakeThread(){
	$("#chatbox-header").html("Chat with " + $("#selectedChat").val());
$
		.ajax({
			type : "POST",
			url : "/lib/API/getMessageThread.php",
			data : $("#fieldVars").serialize(),
			success : function(result) {
				var JSONOBJ = JSON.parse(result);
			
				var all = "";
				var arrayLength = JSONOBJ.messages.length;
				for (var i = 0; i < arrayLength; i++) {
					all += "<div id=\"message_"
							+ JSONOBJ.messages[i].id
							+ "\"><li class=media><div class=media-body><div class=media><a class=pull-left href=#><img class=\"img-circle media-object\" style=\"width=50px\" src=\""+JSONOBJ.messages[i].senderAvatar+"\"></a><div class=media-body><small class=text-muted>"
							+ JSONOBJ.messages[i].senderName + "</small><br>"
							+ JSONOBJ.messages[i].text
							+ "</div></div></div></li><hr></div>";
				
				}
				$("#chatbox").html(all);
			}
		});
}
$("#commit-text").click(function(){
	$.ajax({
		type : "POST",
		url : "/lib/API/postMessage.php?chat="+$("#selectedChat").val(),
		data : $("#messageForm").serialize(),
		success : function(result) {
			var json = JSON.parse(result);
			socket.emit("broadcast",json.messagePush);
			socket.emit("broadcast",json.messageNotif);
		}
	});
});
