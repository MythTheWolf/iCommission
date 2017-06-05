socket
    .on(
        "message_push",
        function(data) {

            var JSONOBJ = JSON.parse(data);
            var toAppend = "<div id=\"message_" +
                "\"><li class=media><div class=media-body><div class=media><a class=pull-left href=#><img class=\"img-circle media-object\"onerror='this.src=\"/assets/image/logo-default.png\"'src=\"\"style=width:50px;height:50px></a><div class=media-body><small class=text-muted>" +
                JSONOBJ.senderName + "</small><br>" +
                JSONOBJ.message +
                "</div></div></div></li><hr></div>";
            $("#chatbox").append(toAppend);

        });

$
    .ajax({
        type: "POST",
        url: "/lib/API/getConvoList.php",
        data: $("#fieldVars").serialize(),
        success: function(result) {
            var OB = JSON.parse(result);
            var arrayLength = OB.list.length;
            setChat(OB.list[0].id);
            for (var i = 0; i < arrayLength; i++) {
                var appendstr = "<li class=\"media\"> <div class=\"media-body\"> <div class=\"media\"> <a class=\"pull-left\" href=\"#\" onClick=\"setChat('" +
                    OB.list[i].id +
                    "')\"> <img class=\"media-object img-circle\" style=\"height: 40px; width: 40px;\" src=\"" +
                    OB.list[i].icon +
                    "\"/> </a> <div class=\"media-body\"> <h5>" +
                    OB.list[i].user +
                    "</h5> <small class=\"text-muted\">" +
                    OB.list[i].content +
                    "</small> </div> </div> </div> </li>";
                $("#convoList").append(appendstr);
            }
        }
    });

function setChat(theId) {
    $.get(
            "/lib/API/getID.php?username=" + theId,
            function(data) {
            	alert(data);
            	$("#chatbox-header").html("Chat with "+data);
            });
    $("#selectedChat").val(theId);
    remakeThread();

}

function remakeThread() {

        $
        .ajax({
            type: "POST",
            url: "/lib/API/getMessageThread.php",
            data: $("#fieldVars").serialize(),
            success: function(result) {
                var JSONOBJ = JSON.parse(result);

                var all = "";
                var arrayLength = JSONOBJ.messages.length;
                for (var i = 0; i < arrayLength; i++) {
                    all += "<div id=\"message_" +
                        JSONOBJ.messages[i].id +
                        "\"><li class=media><div class=media-body><div class=media><a class=pull-left href=#><img class=\"img-circle media-object\" style=\"height: 40px; width: 40px;\" src=\"" +
                        JSONOBJ.messages[i].senderAvatar +
                        "\"></a><div class=media-body><small class=text-muted>" +
                        JSONOBJ.messages[i].senderName +
                        "</small><br>" + JSONOBJ.messages[i].text +
                        "</div></div></div></li><hr></div>";

                }
                $("#chatbox").html(all);
            }
        });
    }
    $("#commit-text").click(function() {
        $.ajax({
            type: "POST",
            url: "/lib/API/postMessage.php?chat=" + $("#selectedChat").val(),
            data: $("#messageForm").serialize(),
            success: function(result) {
                var json = JSON.parse(result);
                socket.emit("broadcast", json.messagePush);
                socket.emit("broadcast", json.messageNotif);
            }
        });
    });

    $("#compose").iziModal({
        overlayClose: false,
        width: 600,
        overlayColor: 'rgba(0, 0, 0, 0.6)',
        transitionIn: 'bounceInDown',
        transitionOut: 'bounceOutDown',
        navigateCaption: true,
        navigateArrows: 'closeScreenEdge',
        onOpened: function() {
            // console.log('onOpened');
        },
        onClosed: function() {
            // console.log('onClosed');
        }
    });

    $("#composeGo")
        .click(
            function() {
                var ID;
                $
                    .get(
                        "/lib/API/getID.php?username=" +
                        $("#textinput").val(),
                        function(data) {
                            if (data == "ERROR->NOTFOUND") {
                                $("#warnings")
                                    .html(
                                        "<center><label><font color='red'>Username doesn't exist!</font></center></label>")
                                shakeform();
                            } else {
                                $("#selectedChat").val(data);
                                postToServer();
                            }
                        });

                function postToServer() {
                    $.ajax({
                        type: "POST",
                        url: "/lib/API/postMessage.php?chat=" +
                            $("#selectedChat").val(),
                        data: $("#composeForm").serialize(),
                        success: function(result) {

                            var json = JSON.parse(result);
                            socket.emit("broadcast", json.messagePush);
                            socket.emit("broadcast", json.messageNotif);
                            rebuildLists();
                            $('#compose').iziModal('close');
                            $("#chatMessage").val("");
                            remakeThread();
                        }
                    });
                }
            });

    function shakeform() {
        var l = 30;
        for (var i = 0; i < 8; i++)
            $("#compose").animate({
                'margin-left': "+=" + (l = -l) + 'px',
                'margin-right': "-=" + l + 'px'
            }, 36);
    }

    function rebuildLists() {
        $
            .ajax({
                type: "POST",
                url: "/lib/API/getConvoList.php",
                data: $("#fieldVars").serialize(),
                success: function(result) {
                    var OB = JSON.parse(result);
                    var arrayLength = OB.list.length;
                    setChat(OB.list[0].id);
                    var appendstr = "";
                    for (var i = 0; i < arrayLength; i++) {
                        appendstr += "<li class=\"media\"> <div class=\"media-body\"> <div class=\"media\"> <a class=\"pull-left\" href=\"#\" onClick=\"setChat('" +
                            OB.list[i].id +
                            "')\"> <img class=\"media-object img-circle\" style=\"height: 40px; width: 40px;\" src=\"" +
                            OB.list[i].icon +
                            "\"/> </a> <div class=\"media-body\"> <h5>" +
                            OB.list[i].user +
                            "</h5> <small class=\"text-muted\">" +
                            OB.list[i].content +
                            "</small> </div> </div> </div> </li>";

                    }
                    $("#convoList").html(appendstr);
                }
            });
    }
    $("#openCompose").click(function() {
        $('#compose').iziModal('open');
    });