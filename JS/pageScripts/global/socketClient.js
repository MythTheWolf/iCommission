var randData = makeid();
console.log("[iComission socket] Initiating connection to the server...");
var socket = io.connect("http://192.168.1.71:3000/");
socket.on('welcome', function(data) {
	// Respond with a message including this clients' id sent from
	// the server
	console.log("[iComission socket]Got welcome packet, running handshake..");
	socket.emit('__INIT', {
		message : randData,
		id : data.id
	});
});
socket
		.on(
				'__SERVINIT',
				function(data) {
					console
							.log("[iComission socket]Server replied to handshake, JSON:"
									+ JSON.stringify(data));
					if (data.UUID == randData) {
						console
								.log("[iComission socket]Data matches, connection accepted!, sending username for server.");
						socket.emit("__COMPLETE", {
							USERNAME : $("#username").val()
						});
						socket
								.on(
										"__DONE",
										function(data) {
											console
													.log("[iComission socket]Connection complete, your IDs are: "
															+ JSON
																	.stringify(data.IDS));
										});
					}
				});
socket.on("message_get", function(raw){
	var loc = window.location.pathname;
	if(loc == "/pages/UserMail.php"){
		return;
	}
	var data = JSON.parse(raw);
	$("#selectedChat").val(data.ID);
	iziToast.show({
		title : data.subject,
		icon : 'icon-drafts',
		class : 'custom1',
		message : data.content,
		position : 'bottomCenter',
		image : data.icon,
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
});


socket.on("chat_select",function(data){
	$("#selectedChat").val(data.ID);
});
function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 20; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}