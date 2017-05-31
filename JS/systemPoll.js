setInterval(function() {
	$.ajax({
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
							+ JSONOBJ.pushNotifs[i].id + "&type=SOFT_READ");
					iziToast.show({
						title : JSONOBJ.pushNotifs[i].subject + ":",
						icon : 'icon-drafts',
						class : 'custom1',
						message : JSONOBJ.pushNotifs[i].content,
						position : 'bottomCenter',
						image : JSONOBJ.pushNotifs[i].sender_avatar,
						balloon : true,
						timeout: 5000,
						animateInside: false,
						transitionIn: "bounceInUp",
						transitionOut: "flipOutX",
						buttons : [
								[ '<button>Photo</button>',
										function(instance, toast) {

											// instance.hide({ transitionOut:
											// 'fadeOutUp' },
											// toast);

											alert("GOT");
										    $("#modal").iziModal();
										    $('#modal').iziModal('open');
										} ],
								[ '<button>Video</button>',
										function(instance, toast) {

											// instance.hide({ transitionOut:
											// 'fadeOutUp' },
											// toast);

											iziToast.show({
												color : 'dark',
												icon : 'icon-ondemand_video',
												title : 'OK',
												message : 'Callback VÃ­deo!',
												position : 'bottomCenter',
											// iconText: 'star',
											});

										} ],
								[ '<button>Text</button>',
										function(instance, toast) {

											// instance.hide({ transitionOut:
											// 'fadeOutUp' },
											// toast);

											iziToast.show({
												color : 'dark',
												icon : 'icon-event_note',
												title : 'OK',
												message : 'Callback Text!',
												position : 'bottomCenter',
											// iconText: 'star',
											});

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