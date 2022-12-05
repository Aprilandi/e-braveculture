//I added event handler for the file upload control to access the files properties.
document.addEventListener("DOMContentLoaded", init, false);

//To save an array of attachments
var AttachmentArray = {};

// Untuk menyimpan list preview untuk setiap bagian
var ThumbnailArray = {};

//an ordered list to keep attachments thumbnails
var ul = {};

//counter for attachment array
var arrCounter = 0;

//to make sure the error message for number of files will be shown only one time.
var filesCounterAlertStatus = false;

function init() {
    //add javascript handlers for the file upload event
    $(':file').on('change', handleFileSelect);
    // document
    //     .querySelector("file")
    //     .addEventListener("change", handleFileSelect, false);
}

//the handler for file upload event
function handleFileSelect(e) {
    // alert('tes');

    // get data name
    var name = $(this).data('nama');

    //to make sure the user select file/files
    if (!e.target.files) return;

    //To obtaine a File reference
    var files = e.target.files;
    // console.log(files);

    // Loop through the FileList and then to render image files as thumbnails.
    for (var i = 0, f; (f = files[i]); i++) {
        //instantiate a FileReader object to read its contents into memory
        var fileReader = new FileReader();

        // Closure to capture the file information and apply validation.
        fileReader.onload = (function (readerEvt) {
            return function (e) {
                //Apply the validation rules for attachments upload
                ApplyFileValidationRules(readerEvt);

                //Fill the array of attachment
                FillAttachmentArray(e, name, readerEvt);

                //Render attachments thumbnails.
                RenderThumbnail(e, name, readerEvt);
                // console.log(readerEvt);

            };
        })(f);

        // Read in the image file as a data URL.
        // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
        // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
        fileReader.readAsDataURL(f);
    }
    // $(':file').on('change', handleFileSelect);
    // document
    //     .getElementById("files")
    //     .addEventListener("change", handleFileSelect, false);
}

//To remove attachment once user click on x button
jQuery(function ($) {
    $("div").on("click", ".img-wrap .close", function () {
        var id = $(this)
            .closest(".img-wrap")
            .find("img")
            .data("id");

        var name = $(this)
            .closest(".img-wrap")
            .find("img")
            .data("name");

        // removeAtt(id, name);

        // console.log(id);
        hapusIMG(name, id);

    });
});

// Function remove attachment files
function removeAtt(id, name){
    //to remove the deleted item from array
    var elementPos = AttachmentArray[name].map(function (x) {
        return x.FileName;
    }).indexOf(id);
    if (elementPos !== -1) {
        AttachmentArray[name].splice(elementPos, 1);
    }

    //to remove li parent with its child
    $("li[data-"+name+"='"+id+"']").remove();
}

//Apply the validation rules for attachments upload
function ApplyFileValidationRules(readerEvt) {
    //To check file type according to upload conditions
    if (CheckFileType(readerEvt.type) == false) {
        alert(
            "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, You can only upload jpg/png/gif files"
        );
        e.preventDefault();
        return;
    }

    //To check file Size according to upload conditions
    if (CheckFileSize(readerEvt.size) == false) {
        alert(
            "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, The maximum file size for uploads should not exceed 300 KB"
        );
        e.preventDefault();
        return;
    }

    //To check files count according to upload conditions
    if (CheckFilesCount(AttachmentArray) == false) {
        if (!filesCounterAlertStatus) {
            filesCounterAlertStatus = true;
            alert(
                "You have added more than 10 files. According to upload conditions you can upload 10 files maximum"
            );
        }
        e.preventDefault();
        return;
    }
}

//To check file type according to upload conditions
function CheckFileType(fileType) {
    if (fileType == "image/jpeg") {
        return true;
    } else if (fileType == "image/png") {
        return true;
    } else if (fileType == "image/gif") {
        return true;
    } else {
        return false;
    }
    return true;
}

//To check file Size according to upload conditions
function CheckFileSize(fileSize) {
    if (fileSize < 300000) {
        return true;
    } else {
        return false;
    }
    return true;
}

//To check files count according to upload conditions
function CheckFilesCount(AttachmentArray) {
    //Since AttachmentArray.length return the next available index in the array,
    //I have used the loop to get the real length
    var len = 0;
    for (var i = 0; i < AttachmentArray.length; i++) {
        if (AttachmentArray[i] !== undefined) {
            len++;
        }
    }
    //To check the length does not exceed 10 files maximum
    if (len > 9) {
        return false;
    } else {
        return true;
    }
}

//Render attachments thumbnails.
function RenderThumbnail(e, name, readerEvt) {

    if(ul[name] === undefined){
        ul[name] = document.createElement("ul");
        ul[name].className = "thumb-Images";
        ul[name].id = "imgList_" + name;
    }

    // if(ThumbnailArray[name] === undefined){
    //     ThumbnailArray[name] = [];
    // }
    // var val =
    //     '<div class="img-wrap img-wrapper">' +
    //     '<a href="' + e.target.result + '"><img class="thumb" src="' +
    //     e.target.result +
    //     '" title="' +
    //     escape(readerEvt.name) +
    //     '" data-id="' +
    //     readerEvt.name +
    //     '" data-name="' +
    //     name +
    //     '"/></a>' + "<span class=\"close\"><i class=\"far fa-trash-alt\"></i></span></div>"
    // ;

    // console.log(e.target.result);
    // ThumbnailArray[name].push(val);

    // for(const parts in AttachmentArray){
    //     if(AttachmentArray[parts]){
    //         for (let index = 0; index < AttachmentArray[parts].length; index++) {
    //             var li = document.createElement("li");
    //             ul.appendChild(li);
    //             li.innerHTML = ThumbnailArray[parts][index];
    //             var div = document.createElement("div");
    //             div.className = "file-info";
    //             li.appendChild(div);
    //             div.innerHTML = AttachmentArray[parts][index][0].FileName;
    //             var id = "gallery_" + parts;
    //             console.log(AttachmentArray[parts][index][0].FileName);
    //             document.getElementById(id).insertBefore(ul, null);
    //         }
    //     }
    // }

    var li = document.createElement("li");
    li.setAttribute("data-"+name, readerEvt.name);
    ul[name].appendChild(li);
    li.innerHTML =
        '<div class="img-wrap img-wrapper">' +
        '<a href="' + e.target.result + '"><img class="thumb" src="' +
        e.target.result +
        '" title="' +
        escape(readerEvt.name) +
        '" data-id="' +
        readerEvt.name +
        '" data-name="' +
        name +
        '"/></a>' + "<span class=\"close\"><i class=\"far fa-trash-alt\"></i></span></div>"
    ;
    var div = document.createElement("div");
    div.className = "file-info";
    li.appendChild(div);
    div.innerHTML = readerEvt.name;
    var id = "gallery_" + name;
    // console.log(e.target.result);
    document.getElementById(id).insertBefore(ul[name], null);

    // Original
    // var li = document.createElement("li");
    // ul.appendChild(li);
    // li.innerHTML = [
    //     '<div class="img-wrap img-wrapper">' +
    //     '<a href="', e.target.result, '"><img class="thumb" src="',
    //     e.target.result,
    //     '" title="',
    //     escape(readerEvt.name),
    //     '" data-id="',
    //     readerEvt.name,
    //     '" data-name="',
    //     name,
    //     '"/></a>' + "<span class=\"close\"><i class=\"far fa-trash-alt\"></i></span></div>"
    // ].join("");
    // var div = document.createElement("div");
    // div.className = "file-info";
    // li.appendChild(div);
    // div.innerHTML = [readerEvt.name].join("");
    // var id = "gallery_" + name;
    // console.log(e.target.result);
    // document.getElementById(id).insertBefore(ul, null);
}

//Fill the array of attachment
function FillAttachmentArray(e, name, readerEvt) {

    // CHECK IF OBJECT (CANVAS NAME) IS NOT EXISTED THEN ADD A NEW OBJECT TO THE ARRAY
    if(AttachmentArray[name] === undefined){
        AttachmentArray[name] = [];
    }

    // ATTRIBUTE INSIDE ARRAY FOR IMAGES
    var att  = {
        AttachmentType: 1,
        ObjectType: 1,
        FileName: readerEvt.name,
        FileDescription: "Attachment",
        NoteText: "",
        MimeType: readerEvt.type,
        Content: e.target.result.split("base64,")[1],
        FileSizeInBytes: readerEvt.size
    };
    // AttachmentArray= {
    //     name: [{
    //         AttachmentType: 1,
    //         ObjectType: 1,
    //         FileName: readerEvt.1name,
    //         FileDescription: "Attachment",
    //         NoteText: "",
    //         MimeType: readerEvt.type,
    //         Content: e.target.result.split("base64,")[1],
    //         FileSizeInBytes: readerEvt.size
    //     }]
    // };

    // INSERT ATTRIBUTE TO OBJECT ARRAY
    AttachmentArray[name].push(att);

    addFabricImg(readerEvt.name, name, e.target.result);
    // console.log(AttachmentArray);
    arrCounter = arrCounter + 1;
}
