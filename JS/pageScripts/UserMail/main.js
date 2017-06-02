
function getUrlParam(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)), sURLVariables = sPageURL
			.split('&'), sParameterName, i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
}
function bind(result) {

}

function DDA(message) {
	iziToast.show({
		id : 'haduken',
		color : 'dark',
		icon : 'icon-contacts',
		title : 'Info',
		message : message,
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
}
function reparse(rebuild) {

	if (rebuild) {
		$("#chatbox").html("");

	}

	$
			.ajax({
				type : "POST",
				url : "/lib/API/getMail.php",
				data : $("#fieldVars").serialize(),
				success : function(result) {
					var JSONOBJ = JSON.parse(result);
					if (result.indexOf("Warning") == 999
							|| result.indexOf("Fatal") > -1
							|| result.indexOf("error") > -1) {
						$("#dialog").html(result);
						$("#dialog").dialog();
					} else {
						JSONOBJ = JSON.parse(result);
						var APP = "";
						var arrayLength = JSONOBJ.messages.length;
						var check;
						for (var i = 0; i < arrayLength; i++) {

							check = "#message_" + JSONOBJ.messages[i].id;

							if ($(check).length == 0) {
								$("#chatbox-header").html(
										"Chat with "
												+ JSONOBJ.userData[0].username);
								APP = "<div id=\"message_"
										+ JSONOBJ.messages[i].id
										+ "\"><li class=media><div class=media-body><div class=media><a class=pull-left href=#><img class=\"img-circle media-object\"onerror='this.src=\"/assets/image/logo-default.png\"'src=\"\"style=width:50px;height:50px></a><div class=media-body><small class=text-muted>"
										+ JSONOBJ.messages[i].senderName
										+ "</small><br>"
										+ JSONOBJ.messages[i].content
										+ "</div></div></div></li><hr></div>";
								$("#chatbox").append(APP);
								if ($('#follow').is(':checked')) {
									window.location = "#commit-text";
									;
								}
							} else {

							}
						}
					}
				}
			});
}
$('#follow').change(function() {

	if (this.checked) {
		DDA("The page will now auto scroll to the bottom on new message.");
	} else {
		DDA("Scrolling is now manual.");
	}
});
$('#chatMessage').bind(
		"enterKey",
		function(e) {
			$.ajax({
				type : "POST",
				url : "/lib/API/commitMessage.php",
				data : $("#messageForm").serialize(),
				success : function(result) {
					sockjs.send(result);
					if (result.indexOf("Warning") == 999
							|| result.indexOf("Fatal") > -1
							|| result.indexOf("error") > -1) {
						$("#dialog").html(result);
						$("#dialog").dialog();
					} else {
						$("#chatMessage").val("");
						DDA("Your message has been sent.");
						reparse(false);

					}
				}
			});
		});
$('#chatMessage').keyup(function(e) {
	if (e.keyCode == 13) {
		if (!e.shiftKey) {
			alert("SHIFT_NOT_ENTER");
			$(this).trigger("enterKey");
		} else {
			alert("SHIFT_ENTER");
		}
	}
});
$("#commit-text").click(
		function() {
			$.ajax({
				type : "POST",
				url : "/lib/API/commitMessage.php",
				data : $("#messageForm").serialize(),
				success : function(result) {
					sockjs.send(result);
					if (result.indexOf("Warning") == 999
							|| result.indexOf("Fatal") > -1
							|| result.indexOf("error") > -1) {
						$("#dialog").html(result);
						$("#dialog").dialog();
					} else {
						$("textarea[custom='chatMessage_page']").val("");
						DDA("Your message has been sent.");
						reparse(false);

					}
				}
			});
		});