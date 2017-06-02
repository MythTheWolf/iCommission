var sockjs_url = 'http://192.168.1.71:9999/echo';
var sockjs = new SockJS(sockjs_url);
var didConnect;
sockjs.onopen = function() {
	console.log("Connected to socket server.");
};
sockjs.onmessage = function(e) {
	var OB = JSON.parse(e.data);
	console.log("Got inbound packet: " + e.data);
	if ($("#userID").val() == OB.wanted) {
		switch (OB.scope) {
		case "USER_MESSAGE_NOTIF":
			showInboundMessage(e.data);
			break;
		case "REPARSE_CHAT":
			alert("Requesting reparse");
			reparse(false);
			break;
		}

	}
};

function showInboundMessage(JSONDAT) {
	if (location.pathname == "/pages/UserMail.php") {
		return;
	}
	var OB = JSON.parse(JSONDAT);
	var sound = new Howl({
		src : [ '/assets/sound/message_get.wav' ]
	});

	sound.play();
	iziToast.show({
		title : OB.subject + ":",
		icon : 'icon-drafts',
		class : 'custom1',
		message : OB.message,
		position : 'bottomCenter',
		image : OB.userData.icon,
		balloon : true,
		timeout : 5000,
		animateInside : false,
		transitionIn : "bounceInUp",
		transitionOut : "flipOutX",
		buttons : [ [ '<button>Reply</button>', function(instance, toast) {

			// instance.hide({
			// transitionOut:
			// 'fadeOutUp'
			// },
			// toast);

			alert("GOT");
			$("#modal").iziModal({
				overlayClose : false,
				width : 600,
				overlayColor : 'rgba(0, 0, 0, 0.6)',
				transitionIn : 'bounceInDown',
				transitionOut : 'bounceOutDown',
				navigateCaption : true,
				navigateArrows : 'closeScreenEdge',
				onOpened : function() {
					// console.log('onOpened');
				},
				onClosed : function() {
					// console.log('onClosed');
				}
			});
			$('#modal').iziModal('open');
		} ], ]
	});
}