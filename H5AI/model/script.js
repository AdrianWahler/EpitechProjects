function getCurrentDirectory(pathName){

    
    $.ajax({
        url: window.location.origin+"/H5AI/model/h5ai.php?pathName="+pathName,
        type: "GET",
        success: function(data) {
            console.log(data)
            let fileArray = jQuery.parseJSON(data);
            let tagList = fileArray[1]
            fileArray = fileArray[0]
            console.log(fileArray)
            //displayDirectoryList(fileArray["directories"]);
            displayFileList(fileArray,pathName,tagList);
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });
}

function getFileIcon(fileType){
    fileType = fileType.split(".");
    fileType = fileType[fileType.length - 1];

    console.log(fileType); 

    switch (fileType) {
        case "txt":
        case "doc":
            return '<img class="listIcon" src="http://localhost/H5AI/assets/file-text.svg">'
            break;
        
        case "png":
        case "jpg":
        case "jpeg":
        case "svg":
        case "gif":
            return '<img class="listIcon" src="http://localhost/H5AI/assets/file-image.svg">'
            break;
        
        case "mp4":
            return '<img class="listIcon" src="http://localhost/H5AI/assets/file-play.svg">'
            break;

        case "mp3":
        case "wav":
            return '<img class="listIcon" src="http://localhost/H5AI/assets/file-music.svg">'
            break;
        
        case "exe":
            return '<img class="listIcon" src="http://localhost/H5AI/assets/filetype-exe.svg">'
            break;
        
        default:
            return '<img class="listIcon" src="http://localhost/H5AI/assets/file-text.svg">'
            break;
    }

}

function displayFileList(files,pathName,tagList) {

    pathArray = pathName.split("/");

    directoryTree = document.createElement("ul");
    directoryHeader = document.createElement("table");
    $(directoryHeader).addClass("table table-striped");
    $(directoryHeader).html("<thead><tr><th>Directory : <span id='path'>"+pathName+"</span></th></tr></thead>")
    $("#directoryTree").append(directoryHeader);
    $("#directoryTree").append(directoryTree);
    $(directoryTree).addClass("baseTreeUl");

    fileTable = document.createElement("table");
    $("#fileTable").append(fileTable);
    fileTableHead = document.createElement("thead");
    fileTableBody = document.createElement("tbody");
    $(fileTable).append(fileTableHead);
    $(fileTable).append(fileTableBody);
    $(fileTable).addClass("table");
    $(fileTable).addClass("table-striped");

    $(fileTableHead).html('<tr><th onclick="orderTableBy(\'fileName\')" class="col-6" scope="col">Name</th><th onclick="orderTableBy(\'modifyDate\')" class="col-4" scope="col">Last Modified</th><th onclick="orderTableByNumerical(\'fileSize\')" class="col-2" scope="col">Size</th></tr>');

    if (pathName != ""){
        backButton = document.createElement("tr");
        $(backButton).on("click",goToPreviousDirectory);
        $(backButton).addClass("backButton");
        $(backButton).html("<td><- Previous</td><td></td><td></td>';");
        $(fileTable).append(backButton);
    }

    for (var i in files) {
        if (files[i]["type"] == "directory"){
            let newFile = document.createElement("li");
            $(newFile).html("<a class='directoryListLink' href='http://localhost/H5AI/"+files[i]["name"]+"'>"+files[i]["name"]+"</a>");
            $(newFile).on("click", (event) => {
                if (event.target == $(newFile)[0]){
                    $(newFile).children("ul").slideToggle();
                }   
            })
            $(newFile).attr("id",files[i]["name"])
            $(newFile).addClass("directory");
            if (hasSubFolders(files[i]["content"])){
                let fileSubtree = document.createElement("ul");
                getRecursiveDirectories(files[i]["content"],fileSubtree,files[i]["name"]);
                $(fileSubtree).addClass("fileSubTree");
                $(newFile).addClass("parentDirectory");
                $(newFile).append(fileSubtree);
            }
            $(newFile).children("ul").hide();
            $(directoryTree).append(newFile);
        }
    }   

    if (pathArray != ""){
        for (var i in pathArray){
            $("#"+pathArray[i]).children("ul").show();
        }
    }

    pathArray.forEach(elem => {
        if ( elem in files ){
            files = files[elem]["content"];
        }
    });

    
    for (var i in files) {
        let newFile = document.createElement("tr");
        
        if (files[i]["type"] == "file"){
            $(newFile).attr("type","file");
            $(newFile).html("<td><button class='btn btn-outline-secondary tagButton' onclick='addTag(this);event.stopPropagation();'>+</button>"+getFileIcon(files[i]["name"])+"<span class='fileName'>"+files[i]["name"]+"</span></td><td class='modifyDate'>"+files[i]["modified"]+"</td><td class='fileSize'>"+files[i]["size"]+"</td>';");
            if (files[i]["name"].slice(files[i]["name"].length-4,files[i]["name"].length) == ".txt"){
                $(newFile).on("click", () => {
                    imagePopup = document.createElement("div");
                    $(imagePopup).addClass("popup");
                    console.log(files[i]["fileContent"]);
                    imagePopupContent = document.createElement("div");
                    $(imagePopupContent).addClass("popupContent");
                    $(imagePopupContent).text(files[i]["fileContent"]);
                
                    $(imagePopup).append(imagePopupContent);
                    $(imagePopup).click(() => {
                        $(imagePopup).remove();
                    })
                    $("body").append(imagePopup);
                });
            }
        } else {
            $(newFile).attr("type","directory");
            $(newFile).html("<td><button class='btn btn-outline-secondary tagButton' onclick='addTag(this);event.stopPropagation();'>+</button><img class='listIcon' src='https://localhost/H5AI/assets/directoryIcon.png'>"+"<span class='fileName'>"+files[i]["name"]+"</span></td><td class='modifyDate'>"+files[i]["modified"]+"</td><td>-</td>';");
            $(newFile).on("click", {path: files[i]["name"]} ,goToNextDirectory)
        }

        var regex = /[0-9A-Fa-f]{6}/g;

        tagList.forEach(tag => {
            if (tag["filename"] == files[i]["name"]){
                console.log($(newFile).attr("tags"))
                if ($(newFile).attr("tags") != null){
                    $(newFile).attr("tags", $(newFile).attr("tags")+" "+tag["tag"]);
                } else {
                    $(newFile).attr("tags",tag["tag"]);
                }
                
                tag["tag"].split(' ').forEach(subTag => {
                    if (subTag.match(regex)) {
                        $(newFile).find("button").css("background-color",subTag);
                    }
                });
            }
        });

        $(fileTable).append(newFile);
    }

    orderTableBy("fileName");
}

function getRecursiveDirectories(files,subTree,path){
    for (var i in files) {

        if (files[i]["type"] == "directory"){
            newPath = path+"/"+files[i]["name"];

            let newFile = document.createElement("li");
            $(newFile).html("<a class='directoryListLink' href='http://localhost/H5AI/"+newPath+"'>"+files[i]["name"]+"</a>");
            $(newFile).on("click", (event) => {
                if (event.target == $(newFile)[0]){
                    $(newFile).children("ul").slideToggle();
                }
            })
            $(newFile).attr("id",files[i]["name"])
            $(newFile).addClass("directory");
            if (hasSubFolders(files[i]["content"])){
                let fileSubtree = document.createElement("ul");
                getRecursiveDirectories(files[i]["content"],fileSubtree,path+"/"+files[i]["name"]);
                $(fileSubtree).addClass("fileSubTree");
                $(newFile).addClass("parentDirectory");
                $(newFile).append(fileSubtree);
            }
            $(newFile).children("ul").hide();
            $(subTree).append(newFile);
        }
    }
}

function hasSubFolders(folder){

    for(var i in folder){
        if (folder[i]["type"] == "directory"){
            return true;
        }
    }

    return false;

}

function searchByName(){

    query = $("#searchBar").val();

    $("tbody").find("tr").hide();
    $(".backButton").show();
    console.log($("tbody").find(".fileName:contains('"+query+"')").parent().parent().show());

    if (query != ""){
        $("#directoryTreeCopy").remove();

        directoryTreeCopy =  $("#directoryTree").clone();
        $("#directoryTree").after(directoryTreeCopy);
        $("#directoryTree").hide();
        $(directoryTreeCopy).attr("id","directoryTreeCopy");
        $(directoryTreeCopy).show();
        $(directoryTreeCopy).find("ul").hide();
        $(directoryTreeCopy).find(".directoryListLink:contains('"+query+"')").show();
        $(directoryTreeCopy).find(".directoryListLink:contains('"+query+"')").css("background-color","yellow");
        $(directoryTreeCopy).find(".directoryListLink:contains('"+query+"')").parents().show();
    } else {
        $("#directoryTreeCopy").remove();
        $("#directoryTree").show();
    }
}

function goToNextDirectory(event){

    newDirectory = event.data.path;

    if (window.location.toString()[window.location.toString().length-1] == "/") {
        window.location.replace(window.location+newDirectory);
    } else {
        window.location.replace(window.location+"/"+newDirectory);
    }
}

function changeDirectory(event){

    newDirectory = event.data.path;

    if (window.location.toString()[window.location.toString().length-1] == "/") {
        window.location.replace(window.location+newDirectory);
    } else {
        window.location.replace(window.location+"/"+newDirectory);
    }
    
}


function goToPreviousDirectory(){

    newUrl = window.location.toString();

    if (newUrl[newUrl.length-1] == "/") {
        newUrl = newUrl.slice(0, -1);
    }

    newUrl = newUrl.split("/").slice(0, -1).join("/")
    window.location.replace(newUrl);
    
}

function orderTableByNumerical(orderBy){

    fileList = $('*[type="file"]');
    directoryList = $('*[type="directory"]');

    for (let i = 0; i < fileList.length; i++) {
        fileList[i] = [fileList[i],parseInt($(fileList[i]).find("."+orderBy).text(),10)];
    }

    console.log(fileList);

    fileList.sort( (a,b) => {
        if (a[1] === b[1]) {
            return 0;
        }
        else {
            return (a[1] < b[1]) ? -1 : 1;
        }
    })

    for (let i = 0; i < directoryList.length; i++) {
        directoryList[i] = [directoryList[i],$(directoryList[i]).find("."+orderBy).text()];
    }

    directoryList.sort( (a,b) => {
        if (a[1] === b[1]) {
            return 0;
        }
        else {
            return (a[1] < b[1]) ? -1 : 1;
        }
    })

    for (let i = fileList.length-1; i >= 0 ; i--) {
        $("tbody").prepend(fileList[i][0]);
    }

    for (let i = directoryList.length-1; i >= 0 ; i--) {
        $("tbody").prepend(directoryList[i][0]);
    }

    console.log($(".backButton"))
    $("tbody").prepend($(".backButton"));
}

function orderTableBy(orderBy){

    fileList = $('*[type="file"]');
    directoryList = $('*[type="directory"]');

    for (let i = 0; i < fileList.length; i++) {
        fileList[i] = [fileList[i],$(fileList[i]).find("."+orderBy).text()];
    }

    fileList.sort( (a,b) => {
        if (a[1] === b[1]) {
            return 0;
        }
        else {
            return (a[1] < b[1]) ? -1 : 1;
        }
    })

    for (let i = 0; i < directoryList.length; i++) {
        directoryList[i] = [directoryList[i],$(directoryList[i]).find("."+orderBy).text()];
    }

    directoryList.sort( (a,b) => {
        if (a[1] === b[1]) {
            return 0;
        }
        else {
            return (a[1] < b[1]) ? -1 : 1;
        }
    })

    for (let i = fileList.length-1; i >= 0 ; i--) {
        $("tbody").prepend(fileList[i][0]);
    }

    for (let i = directoryList.length-1; i >= 0 ; i--) {
        $("tbody").prepend(directoryList[i][0]);
    }

    console.log($(".backButton"))
    $("tbody").prepend($(".backButton"));
}

function addTag(self){

    console.log($(self).parent());
    file = $(self).parent().find(".fileName").text();
    
    if ($(self).parent().parent().attr("tags") == null){
        tag = window.prompt("There are currently no tags. \n\nAdd tags separated by spaces, add an hexcode to change the file's color:");
    } else {
        tag = window.prompt("Current tags are : "+$(self).parent().parent().attr("tags")+" \n\nAdd tags separated by spaces, add an hexcode to change the file's color:",$(self).parent().parent().attr("tags"));
    }
    
    
    path = $("#path").text();
    console.log("tag :"+tag);

    if (tag != null && tag != false){
        $.ajax({
            url: "http://localhost/H5AI/model/addTag.php",
            type: "POST",
            data: {
                file: file,
                tag: tag,   
                path: path
            },
            success: function(data) {
                console.log(data);
            },error: function(jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR.responseText);
              console.log(errorThrown);
            }
        });
    }
}