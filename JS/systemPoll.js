setInterval(
		function() {

			$
					.ajax({
						type : "GET",
						url : "/lib/API/getNotifs.php",
						data : "",
						success : function(result) {
							if (location.pathname == "/pages/UserMail.php") {
								return;
							}

							var JSONOBJ = JSON.parse(result);
							var arrayLength = JSONOBJ.pushNotifs.length;
							for (var i = 0; i < arrayLength; i++) {
								switch (JSONOBJ.pushNotifs[i].key) {
								case "USER_MESSAGE_GET":
									$.get("/lib/API/markNotif.php?id="
											+ JSONOBJ.pushNotifs[i].id
											+ "&type=SOFT_READ");
									var sound = new Howl(
											{
												src : [ '/assets/sound/message_get.wav' ]
											});

									sound.play();
									iziToast
											.show({
												title : JSONOBJ.pushNotifs[i].subject
														+ ":",
												icon : 'icon-drafts',
												class : 'custom1',
												message : JSONOBJ.pushNotifs[i].content,
												position : 'bottomCenter',
												image : JSONOBJ.pushNotifs[i].sender_avatar,
												balloon : true,
												timeout : 5000,
												animateInside : false,
												transitionIn : "bounceInUp",
												transitionOut : "flipOutX",
												buttons : [
														[
																'<button>Reply</button>',
																function(
																		instance,
																		toast) {

																	// instance.hide({
																	// transitionOut:
																	// 'fadeOutUp'
																	// },
																	// toast);

																	alert("GOT");
																	$("#modal")
																			.iziModal(
																					{
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
																	$('#modal')
																			.iziModal(
																					'open');
																} ], ]
											});
									break;
								default:
									break;
								}
							}
						}
					});
		}, 1000);

setInterval(function() {
	$.get("/lib/API/heartBeat.php?id=" + $("#userID").val());
}, 30000);
