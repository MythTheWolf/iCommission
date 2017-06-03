function doThing() {
	socket.emit("broadcast", JSON.stringify({scope:"hh",key:"reparse",value:"some text"}));
	$.ajax({
		type : "POST",
		url : "/lib/API/commitMessage.php",
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
				var sound = new Howl({
					  src: ['https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3']
					});
			}
		}
	});
}