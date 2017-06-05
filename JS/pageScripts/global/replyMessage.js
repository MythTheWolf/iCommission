function doThing() {
	$.ajax({
		type : "POST",
		url : "/lib/API/postMessage.php?chat="+$("#selectedChat").val(),
		data : $("#replyForm").serialize(),
		success : function(result) {
		
			if (result.indexOf("Warning") == 999
					|| result.indexOf("Fatal") > -1
					|| result.indexOf("error") > -1) {
				$("#dialog").html(result);
				$("#dialog").dialog();
			} else {
				$('#modal').iziModal('close');
				$("#chatMessage").val("");
				iziToast.show({
					id : 'haduken',
					color : 'dark',
					icon : 'icon-contacts',
					title : 'Info',
					message : "Message sent!",
					position : 'topCenter',
					transitionIn : 'flipInX',
					transitionOut : 'flipOutX',
					progressBarColor : 'rgb(0, 255, 184)',
					image : '',
					imageWidth : 70,
					layout : 2,
					onClose : function() {
						// console.info('onClose');
					},
					iconColor : 'rgb(0, 255, 184)'
				});
				var json = JSON.parse(result);
				socket.emit("broadcast",json.messagePush);
				socket.emit("broadcast",json.messageNotif);
			}
		}
	});
}