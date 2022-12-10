// let config = document.getElementById('configure');
// let ctx = config.getContext('2d');

// ctx.fillStyle = "white";
// ctx.fillRect(0, 0, config.width, config.height);

// config.addEventListener("mousemove", (e)=>{
//     let rect = config.getBoundingClientRect();
//     let x = e.clientX - rect.left;
//     let y = e.clientY - rect.top;

//     ctx.fillStyle = "black";
//     ctx.fillRect(x, y, 5, 5);
// });

// Indikator nama object
var key = "";

var deleteIcon = "data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'%3E%3Csvg version='1.1' id='Ebene_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='595.275px' height='595.275px' viewBox='200 215 230 470' xml:space='preserve'%3E%3Ccircle style='fill:%23F44336;' cx='299.76' cy='439.067' r='218.516'/%3E%3Cg%3E%3Crect x='267.162' y='307.978' transform='matrix(0.7071 -0.7071 0.7071 0.7071 -222.6202 340.6915)' style='fill:white;' width='65.545' height='262.18'/%3E%3Crect x='266.988' y='308.153' transform='matrix(0.7071 0.7071 -0.7071 0.7071 398.3889 -83.3116)' style='fill:white;' width='65.544' height='262.179'/%3E%3C/g%3E%3C/svg%3E";

var json_model = {};

var deleteImg = document.createElement('img');
deleteImg.src = deleteIcon;

// let width = 600;
// let height = 600;

let width;
let height;

let depan;
let belakang;
let kanan;
let kiri;
let canvas;

function setCanvas(width, height, warna){
    if(warna === undefined){
        warna = 'rgb(240,240,240)';
    }
    if(width === undefined && height === undefined){
        width = document.getElementById('depan').offsetWidth;
        height = document.getElementById('depan').offsetHeight;
    }

    depan = new fabric.Canvas('depan', {
        backgroundColor: warna,
        width: width, height: height
    });
    belakang = new fabric.Canvas('belakang', {
        backgroundColor: warna,
        width: width, height: height
    });
    kanan = new fabric.Canvas('kanan', {
        backgroundColor: warna,
        width: width, height: height
    });
    kiri = new fabric.Canvas('kiri', {
        backgroundColor: warna,
        width: width, height: height
    });

    canvas = {depan, belakang, kanan, kiri};

    fabric.NamedImage = fabric.util.createClass(fabric.Image, {

        type: 'named-image',

        initialize: function(element, options) {
            this.callSuper('initialize', element, options);
            options && this.set('name', options.name);
        },

        toObject: function() {
            return fabric.util.object.extend(this.callSuper('toObject'), { name: this.name });
        }
    });

    fabric.NamedImage.fromObject = function(object, callback) {
        fabric.util.loadImage(object.src, function(img) {
            callback && callback(new fabric.NamedImage(img, object));
        });
    };

    fabric.NamedImage.async = true;

    Object.entries(canvas).forEach(([key, value]) => {
        value.on('object:selected',function(e){
            alert('tes');
            addDeleteBtn(key, e.target.oCoords.mt.x, e.target.oCoords.mt.y, e.target.width);
        });

        value.on('mouse:down',function(e){
            if(!value.getActiveObject())
            {
                $(".deleteBtn").remove();
            }
        });

        value.on('object:modified',function(e){
            addDeleteBtn(key, e.target.oCoords.mt.x, e.target.oCoords.mt.y, e.target.width);
        });

        value.on('object:moving',function(e){
            $(".deleteBtn").remove();
            console.log(value.getActiveObject().name);
        });

        // console.log(key, value) // "someKey" "some value", "hello" "world", "js javascript foreach object"
    });
}

// var kerah = new fabric.Canvas('kerah', {
//     backgroundColor: 'rgb(240,240,240)',
//     width: width, height: height
// });



// var ctx = config.getContext('2d');

// var background = new Image();
// background.src = img;

// // Make sure the image is loaded first otherwise nothing will draw.
// background.onload = function(){
//     ctx.drawImage(background,0,0);
// };

// Images
// $(document).ready(function () {
//     if (window.File && window.FileList && window.FileReader) {
//         $("#files").on("change", function (e) {
//             var files = e.target.files,
//                 filesLength = files.length;
//             for (var i = 0; i < filesLength; i++) {
//                 var f = files[i];
//                 var fileReader = new FileReader();
//                 fileReader.onload = (function (e) {
//                     var file = e.target;
//                     $("<span class=\"pip\">" +
//                         "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
//                         "<br/><span class=\"remove\">Remove image</span>" +
//                         "</span>").insertAfter("#files");
//                     $(".remove").click(function () {
//                         $(this).parent(".pip").remove();
//                         $('#files').val("");// kehapus semua.
//                     });
//                     fabric.Image.fromURL(e.target.result, function(img){
//                         config.add(img);
//                     });
//                 });
//                 fileReader.readAsDataURL(f);
//             }
//         });
//     } else {
//         alert("Your browser doesn't support to File API");
//     }
// });

// $(document).ready(function () {
//     // add background image
//     depan.setBackgroundImage(bg_depan, depan.renderAll.bind(depan), {
//         scaleX: depan.width / bg_depan.width,
//         scaleY: depan.height / bg_depan.height
//     });
//     belakang.setBackgroundImage(bg_belakang, belakang.renderAll.bind(belakang), {
//         scaleX: belakang.width / bg_belakang.width,
//         scaleY: belakang.height / bg_belakang.height
//     });
//     kanan.setBackgroundImage(bg_kanan, kanan.renderAll.bind(kanan), {
//         scaleX: kanan.width / bg_kanan.width,
//         scaleY: kanan.height / bg_kanan.height
//     });
//     kiri.setBackgroundImage(bg_kiri, kiri.renderAll.bind(kiri), {
//         scaleX: kiri.width / bg_kiri.width,
//         scaleY: kiri.height / bg_kiri.height
//     });

// });


// var rect1 = new fabric.Rect({
//     left: 100,
//     top: 150,
//     fill: 'blue',
//     width: 200,
//     height: 200
// });

// var rect2 = new fabric.Rect({
//     left: 100,
//     top: 150,
//     fill: 'red',
//     width: 200,
//     height: 200
// });

// var rect3 = new fabric.Rect({
//     left: 100,
//     top: 150,
//     fill: 'yellow',
//     width: 200,
//     height: 200
// });

// var rect4 = new fabric.Rect({
//     left: 100,
//     top: 150,
//     fill: 'black',
//     width: 200,
//     height: 200
// });

// var rect5 = new fabric.Rect({
//     left: 100,
//     top: 150,
//     fill: 'green',
//     width: 200,
//     height: 200
// });

function addFabricImg(id, part, imgURL){
    // alert("tes");
    // console.log(AttachmentArray);
    // for(const parts in AttachmentArray){
    //     alert("ABABABA");
    //     if(AttachmentArray[parts]){
    //         console.log(AttachmentArray[parts][0]);
    //         fabric.Image.fromURL(AttachmentArray[parts][0].Content, function(img){
    //             [parts].add(img);
    //         });

    //         // [parts].add(AttachmentArray[parts][0].Content);
    //     }
    // }
    // console.log([name][0]);

    var img = document.createElement("img");
    img.src = imgURL;

    var namedImg = new fabric.NamedImage(img, { name: id });

    canvas[part].add(namedImg);

    var json = JSON.stringify(canvas[part]);

    canvas[part].clear();

    // and load everything from the same json
    canvas[part].loadFromJSON(json, function() {

        // making sure to render canvas at the end
        canvas[part].renderAll();

        // and checking if object's "name" is preserved
        // console.log(canvas[part].item(0).name);
    });

    // fabric.Image.fromURL(imgURL, function(img){
    //     img.scaleToWidth(width * 0.75);
    //     img.scaleToHeight(height * 0.75);
    //     img.set({dataImg: { name: id }});
    //     canvas[part].add(img);
    //     canvas[part].renderAll();
    // });
}

// depan.add(rect1);
// depan.add(rect2);
// belakang.add(rect2);
// kanan.add(rect3);
// kiri.add(rect4);
// kerah.add(rect5);

// Hapus object gambar dari canvas
function addDeleteBtn(bagian, x, y, w){
	$(".deleteBtn").remove();
	var btnLeft = x;
	var btnTop = y - 25;
	var widthadjust=w/2;
	btnLeft=widthadjust+btnLeft-10;
	var deleteBtn = '<img src="'+ srcBtnHapus +'" data-bagian="'+ bagian +'" class="deleteBtn" style="position:absolute;top:'+btnTop+'px;left:'+btnLeft+'px;cursor:pointer;height:50px;width:50px;"/>';
	$(".canvas-container").append(deleteBtn);
}

$(document).on('click',".deleteBtn",function(){
    hapusIMG($(this).data("bagian"));
    // console.log($(this));
});

function hapusIMG(bagian, name){
    // console.log(canvas[bagian].getActiveObject());
    var selectedOBJ;
    if(canvas[bagian].getActiveObject() !== undefined)
    {
        // canvas[bagian].getActiveObject().name = name;
        // console.log(canvas[bagian].getActiveObject().name);
        selectedOBJ = canvas[bagian].getActiveObject();
        name = canvas[bagian].getActiveObject().name;
        $(".deleteBtn").remove();
    }
    else{
        canvas[bagian].forEachObject(function(obj){
            if(obj.name && obj.name === name) selectedOBJ = obj;
        });
    }
    canvas[bagian].remove(selectedOBJ);
    removeAtt(name, bagian);
}

// simpan model dengan pendekatan menyimpan canvas nya bukan 3d modelnya
$("button#order").on("click", function(e){
    $("#PesanModal").modal('show');
    // saveCanvas();
});

function saveCanvas(){
    var token = $('input[name=_token]').val();
    var url = $("button#order").data('href');
    Object.entries(canvas).forEach(([key, value]) => {
        if(json_model[key] === undefined){
            json_model[key] = [];
        }
        json_model[key] = JSON.stringify(value);
    });

    return json_model;
    // Codingan lama dengan token
    // $.post(url, { _token:token, model:JSON.stringify(json_model) }, function(result){
    //     // console.log(json_model);
    // })
    // .done( function() {
    //     alert('done');
    // })
    // .fail( function(e) {
    //     console.log(e);
    // });

    // Tanpa token karena sudah di include csrf di header
    // $.post(url, { model:JSON.stringify(json_model) }, function(result){
    //     // console.log(json_model);
    // })
    // .done( function() {
    //     alert('done');
    // })
    // .fail( function(e) {
    //     console.log(e);
    // });
}

// $("button#export").on("click", function(e){
//     loadCanvas();
// });

function loadCanvas(json_model){
    // console.log(json_model);
    Object.entries(canvas).forEach(([key, value]) => {
        // clear canvas
        // console.log(value);
        value.clear();

        // and load everything from the same json
        if(json_model[key] !== undefined){
            value.loadFromJSON(json_model[key], function() {

                // console.log(json_model[key]);
                // making sure to render canvas at the end
                value.renderAll();

                // and checking if object's "name" is preserved
                // console.log(canvas.item(0).name);
            });
        }
    });
}

// setCanvas();
// fabric.Object.prototype.controls.deleteControl = new fabric.Control({
//     x: 0.5,
//     y: -0.5,
//     offsetY: -16,
//     offsetX: 16,
//     cursorStyle: 'pointer',
//     mouseUpHandler: deleteObject,
//     render: renderIcon(deleteImg),
//     cornerSize: 24
// });

// function deleteObject(eventData, transform) {
//     var target = transform.target;
//     var canvas = target.canvas;
//     canvas.remove(target);
//     canvas.requestRenderAll();
// }
