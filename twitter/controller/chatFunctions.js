class ChatBar{

    constructor() {

        this.test = "test";
        this.ChatBar = document.createElement("div");
        this.chatBarToggle = document.createElement("div");
        this.chatBarToggleContainer = document.createElement("div");
        this.chatBarContainer = document.createElement("div");
        this.chatBarBackButton = document.createElement("div");
        
        $("body").append(this.ChatBar);
        $(this.chatBarToggleContainer).append(this.chatBarBackButton);
        $(this.chatBarToggleContainer).append(this.chatBarToggle);
        this.chatBarToggleContainer.style.display = "flex"
        $(this.ChatBar).append(this.chatBarToggleContainer);
        $(this.ChatBar).append(this.chatBarContainer);
        $(this.ChatBar).addClass("chatBar")

        $(this.chatBarToggle).text("Messages");
        $(this.chatBarToggle).addClass("chatBarToggle");
        $(this.chatBarToggle).on("click",() => {
            $(this.chatBarContainer).slideToggle();
        })

        $(this.chatBarBackButton).addClass("backButton");
        $(this.chatBarBackButton).text("<");
        $(this.chatBarBackButton).on("click",() => {
            $(this.chatBarContainer).html("")
            this.getConversationList();
        })

        $(this.chatBarContainer).hide();
        $(this.chatBarContainer).addClass("chatBarContainer");

        this.getConversationList();
    
    }

    getNewConversation(userHandle,classObject) {

        let handle = userHandle.replace("@","");
        $.ajax({
            url: "model/getIDfromHandle.php",
            type: "POST",
            data: {
                handle: handle,
            },
            success: (data) => {
                let result = jQuery.parseJSON(data);
                this.getConversationMessages(result[0]["id"],this)
            },error: function(jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR.responseText);
              console.log(errorThrown);
            }
        });

    }

    getConversationList() {
        let converstationList = document.createElement("ul")
        let $this = this
        $(this.chatBarContainer).append(converstationList,this);

        let newConversation = document.createElement("li");
        newConversation.innerHTML = "<div style='display:flex'><input id='newMessage' oninput='newMessageOnModify(this)' class='' type='text'><button id='newMessageButton' type='button'>NEW</button></div>"
        $(converstationList).append(newConversation);
        $("#newMessageButton").on("click", () => {
            this.getNewConversation($("#newMessage").val());
        })

        $.ajax({
            url: "model/getConversationList.php",
            type: "POST",
            success: function(data) {
                let conversations = jQuery.parseJSON(data);

                for (let i = 0; i < conversations.length; i++) {
                    let item = document.createElement("li")
                    item.innerHTML = "<div class='autoCompleteProfile'><img src='"+conversations[i]["Path"]+"'>"
                    +"<div><span class='username'>"+conversations[i]["username"]+"</span><span class='handle'>@"+conversations[i]["handle"]
                    +"</span><p>"+conversations[i]["message"]+"</p></div>";

                    $(converstationList).append(item);
                    $(item).on("click", () => {
                        $this.getConversationMessages(conversations[i]["id"], $this)
                    })
                }
            },error: function(jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR.responseText);
              console.log(errorThrown);
            }
        });
    }

    getConversationMessages(correspondantID,$this){
        $this.chatBarContainer.innerHTML = ""

        let messageFlexContainer = document.createElement("div")
        $(messageFlexContainer).addClass("messageFlexContainer")
        $(messageFlexContainer).attr("id","messageFlexContainer")
        $($this.chatBarContainer).append(messageFlexContainer);

        $.ajax({
            url: "model/getConversationMessages.php",
            type: "POST",
            data: {
                correspondantID: correspondantID,
            },
            success: function(data) {
                let messages = jQuery.parseJSON(data);

                messages.forEach(message => {
                    let messageContainer = document.createElement("div");

                    if (message["Path"] != null) {
                        let imageMessage = document.createElement("div");
                        $(imageMessage).html("<img class='imageMessage' onclick='createModalFromLink(\""+message["Path"]+"\")' src='"+message["Path"]+"'>");
                        $(messageContainer).append(imageMessage);
                    }

                    let messageText = document.createElement("div");
                    $(messageText).text(message["message"]);
                    $(messageContainer).addClass("message")
                    $(messageContainer).append(messageText);
                    $(messageFlexContainer).append(messageContainer);

                    if (message["user_from"] == correspondantID){
                        $(messageContainer).addClass("incomingMessage")
                    } else {
                        $(messageContainer).addClass("outgoingMessage")
                    }
                });
            },error: function(jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR.responseText);
              console.log(errorThrown);
            }
        });

        let messageBarContainer = document.createElement("div");
        let messageBar = document.createElement("input");
        $(messageBarContainer).addClass("messageBarContainer")
        $(messageBar).addClass("messageBar")
        $(messageBarContainer).append(messageBar);
        $($this.chatBarContainer).append(messageBarContainer);

        $(messageBar).on( "keypress",{
            correspondantID: correspondantID,
            message: messageBar
        }, $this.sendPrivateMessage )


        let chatBarImageButton = document.createElement("div");
        $(chatBarImageButton).append(chatBarImageButton);
        $(chatBarImageButton).addClass("messageBox__buttons");
        $(chatBarImageButton).html(`<label for="privateMessageFile"><span class="material-symbols-outlined">
                add_photo_alternate
         </span></label>
        <input type="file" class="tweetBox__imageButton" id="privateMessageFile" name="privateMessageFile">`)

        $(messageBarContainer).append(chatBarImageButton);

        messageFlexContainer.scrollTop = messageFlexContainer.scrollHeight;
    }

    sendPrivateMessage(event){
        let correspondantID = event.data.correspondantID;
        let message = event.data.message.value;

        if (event.keyCode == 13 && message != ""){

            let blob = document.getElementById("privateMessageFile").files[0];

            var data = new FormData();
            data.append('image', blob);
            data.append('correspondantID', correspondantID);
            data.append('message', message);

            $.ajax({
                url: "model/sendPrivateMessage.php",
                type: "POST",
                contentType: false,
                processData: false,
                data: data,
                success: function(data) {
                    message = jQuery.parseJSON(data);
                    let messageContainer = document.createElement("div");

                    if (message["Path"] != null) {
                        let imageMessage = document.createElement("div");
                        $(imageMessage).html("<img class='imageMessage' src='"+message["Path"]+"'>");
                        $(messageContainer).append(imageMessage);
                    }

                    let messageText = document.createElement("div");
                    $(messageText).text(message["message"]);
                    $(messageContainer).addClass("message")
                    $(messageContainer).append(messageText);
                    $(messageFlexContainer).append(messageContainer);
                    $(messageContainer).addClass("outgoingMessage");

                    $(".messageBar").val("");
                    document.getElementById("privateMessageFile").value = null;
                },error: function(jqXHR, textStatus, errorThrown)
                {
                  console.log(jqXHR.responseText);
                  console.log(errorThrown);
                }
            });
        }
    }
}