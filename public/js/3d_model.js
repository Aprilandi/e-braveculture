import * as THREE from 'https://cdn.skypack.dev/three@0.129.0';
import { OrbitControls } from 'https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js';
import { GLTFExporter } from 'https://cdn.skypack.dev/three@0.129.0/examples/jsm/exporters/GLTFExporter.js';
/*
    Faktor penting dalam THREE.js
    Scene
    - lingkungan 3D / 3D World
    Camera
    - kamera yang digunakan untuk melihat ke dalam 3D World tersebut
    Renderer
    - menampilkan hasil kamera ke layar
*/

var mount = document.querySelector('.scene');
// let width = document.getElementById('scene').offsetWidth;
// let height = document.getElementById('scene').offsetWidth;
let width;
let height;

// console.log(width);
// console.log(height);

var scene, cam, canvas, renderer, controls, planeGeo, planeMat, planeMesh, grid, pLight1, pLight2, pLight3, pLight4, pLight5, canvasTextureDepan, canvasTextureBelakang, canvasTextureKanan, canvasTextureKiri;
var laki = new THREE.Object3D();
var laki_depan = new THREE.Object3D();
var laki_belakang = new THREE.Object3D();
var laki_kanan = new THREE.Object3D();
var laki_kiri = new THREE.Object3D();
var laki_kerah = new THREE.Object3D();
var wanita = new THREE.Object3D();
var wanita_depan = new THREE.Object3D();
var wanita_belakang = new THREE.Object3D();
var wanita_kanan = new THREE.Object3D();
var wanita_kiri = new THREE.Object3D();
var wanita_kerah = new THREE.Object3D();


export function innit(width, height){
    if(width === undefined && height === undefined){
        width = document.getElementById('depan').offsetWidth;
        height = document.getElementById('depan').offsetHeight;
    }

    scene = new THREE.Scene();
    /*
    1. FOV. semakin besar maka semakin wide angle kamera nya
    2. Aspect Ratio. disesuaikan dengan layar
    3. Near Clip - seberapa dekat yang bisa dilihat kamera
    4. Far Clip - seberapa jauh yang bisa dilihat kamera
    */
    cam = new THREE.PerspectiveCamera(45, width/height, 1, 1000);
    cam.position.z += 7;
    cam.position.y += 3;
    scene.background = new THREE.Color(0x0a0a0a);
    canvas = document.getElementById('model');
    renderer = new THREE.WebGLRenderer({alpha: true, canvas: canvas});
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.basicShadowMap;

    renderer.setSize(width, height);
    // camera controls
    controls = new OrbitControls(cam, renderer.domElement);

    // Field
    planeGeo = new THREE.PlaneGeometry(25, 25);
    planeMat = new THREE.MeshBasicMaterial({color: 0xffffff, side: THREE.DoubleSide});
    planeMesh = new THREE.Mesh(planeGeo, planeMat);
    planeMesh.rotation.x -= Math.PI/2;
    planeMesh.position.y -= 2;
    scene.add(planeMesh);

    // Field's Grid
    grid = new THREE.GridHelper(100, 100, 0x0a0a0a, 0x000000);
    grid.position.set(0, -1.5, 0);
    scene.add(grid);

    // Lightning
    // Pointer Lightning
    pLight1 = new THREE.PointLight(0xdddddd, 1);
    pLight1.position.set(0, 1, 3);
    scene.add(pLight1);
    // scene.add(new THREE.PointLightHelper(pLight1, 0.1, 0xff0000));
    pLight2 = new THREE.PointLight(0xdddddd, 1);
    pLight2.position.set(0, 1, -3);
    scene.add(pLight2);
    // scene.add(new THREE.PointLightHelper(pLight2, 0.1, 0xff0000));
    pLight3 = new THREE.PointLight(0xdddddd, 1);
    pLight3.position.set(3, 1, 0);
    scene.add(pLight3);
    // scene.add(new THREE.PointLightHelper(pLight3, 0.1, 0xff0000));
    pLight4 = new THREE.PointLight(0xdddddd, 1);
    pLight4.position.set(-3, 1, 0);
    scene.add(pLight4);
    // scene.add(new THREE.PointLightHelper(pLight4, 0.1, 0xff0000));
    pLight5 = new THREE.PointLight(0xdddddd, 1);
    pLight5.position.set(0, 4, 0);
    scene.add(pLight5);
    scene.add(new THREE.PointLightHelper(pLight5, 0.1, 0xff0000));

};

export function getCanvas(){
    let depan = document.getElementById('depan');
    let belakang = document.getElementById('belakang');
    let kanan = document.getElementById('kanan');
    let kiri = document.getElementById('kiri');
    // let ctx = config.getContext('2d');

    // config.addEventListener("mousemove", (e) => {
    //     let rect = config.getBoundingClientRect();
    //     let x = e.clientX - rect.left;
    //     let y = e.clientY - rect.top;

    //     ctx.fillStyle = 'black';
    //     ctx.fillRect(x, y, 5, 5);
    // });
    canvasTextureDepan = new THREE.Texture(depan);
    canvasTextureDepan.wrapS = THREE.RepeatWrapping;
    canvasTextureDepan.repeat.x = -1;
    canvasTextureBelakang = new THREE.Texture(belakang);
    canvasTextureBelakang.wrapS = THREE.RepeatWrapping;
    canvasTextureBelakang.repeat.x = -1;
    canvasTextureKanan = new THREE.Texture(kanan);
    canvasTextureKanan.wrapS = THREE.RepeatWrapping;
    canvasTextureKanan.repeat.x = -1;
    canvasTextureKanan.flipY = false;
    canvasTextureKiri = new THREE.Texture(kiri);
    canvasTextureKiri.wrapS = THREE.RepeatWrapping;
    canvasTextureKiri.repeat.x = -1;
};

export function loadModel(){
    // MODEL
    // let boxGeo = new THREE.BoxGeometry(1,1,1); //Geometry pernyataan bentuk
    // let boxMat = new THREE.MeshBasicMaterial({ map: canvasTexture }); //Material pernyataan jenis (seperti warnanya atau pemantulnya)
    // let box = new THREE.Mesh(boxGeo, boxMat); //3D Model dari THREE.js memperlukan 2 unsur pembentuk yaitu Geometry dan Material
    // box.position.set(0,0,0);
    // box.castShadow = true;
    // scene.add(box);

    // 3D Model Loader
    // instantiate a loader
    const loader = new GLTFLoader().load(
        // resource URL
        model,
        // called when the resource is loaded
        function ( result ) {
            laki = result.scene.children[0];
            wanita = result.scene.children[1];
            // console.log(result);
            laki.scale.set( 0.05, 0.05, 0.05 );
            laki.position.set(0,-1,0);
            // wanita.scale.set( 0.05, 0.05, 0.05 );
            // wanita.position.set(3,0,0);
            laki_depan = result.scene.children[0].children[0];
            laki_belakang = result.scene.children[0].children[1];
            laki_kanan = result.scene.children[0].children[2];
            laki_kiri = result.scene.children[0].children[3];
            laki_kerah = result.scene.children[0].children[4];
            // laki_belakang.scale.set( 0.05, 0.05, 0.05 );
            // laki_belakang.position.set(0,0,0);
            // wanita_depan = result.scene.children[1].children[1];
            // wanita_belakang = result.scene.children[1].children[2];
            // wanita_kanan = result.scene.children[1].children[4];
            // wanita_kiri = result.scene.children[1].children[3];
            // wanita_kerah = result.scene.children[1].children[5];
            // laki_depan.material.map = document.getElementById('configure');

            // uv scaling
            laki_depan.material.map = document.getElementById("depan");
            laki_belakang.material.map = document.getElementById("belakang");
            laki_kanan.material.map = document.getElementById("kanan");
            laki_kiri.material.map = document.getElementById("kiri");

            laki_depan.material = new THREE.MeshPhysicalMaterial( { map: canvasTextureDepan } );
            laki_depan.material.side = THREE.DoubleSide;
            laki_belakang.material = new THREE.MeshPhysicalMaterial( { map: canvasTextureBelakang } );
            laki_belakang.material.side = THREE.DoubleSide;
            laki_kanan.material = new THREE.MeshPhysicalMaterial( { map: canvasTextureKanan } );
            laki_kanan.material.side = THREE.DoubleSide;
            laki_kiri.material = new THREE.MeshPhysicalMaterial( { map: canvasTextureKiri } );
            laki_kiri.material.side = THREE.DoubleSide;
            // let mat001 = new THREE.MeshPhysicalMaterial();
            // let mat002 = new THREE.MeshPhysicalMaterial();
            // let mat003 = new THREE.MeshPhysicalMaterial();
            // mat001.color = new THREE.Color("gold");
            // mat002.color = new THREE.Color("red");
            // mat003.color = new THREE.Color("blue");
            // laki_depan.material = mat001;
            // laki_belakang.material = mat001;
            // laki_kanan.material = mat002;
            // laki_kiri.material = mat002;
            // laki_kerah.material = mat003;
            // laki_depan.material.side = THREE.DoubleSide;
            // laki_belakang.material.side = THREE.DoubleSide;
            // laki_kanan.material.side = THREE.DoubleSide;
            // laki_kiri.material.side = THREE.DoubleSide;
            // laki_kerah.material.side = THREE.DoubleSide;
            // for (i = 0; i < laki.faces.length ; i++) {
            //     laki.faceVertexUvs[0].push([
            //       new THREE.Vector2( 0, 0 ),
            //       new THREE.Vector2( 0, 0 ),
            //       new THREE.Vector2( 0, 0 ),
            //     ]);
            // };
            // scene.add(laki);
        },
        // called while loading is progressing
        function ( xhr ) {

            console.log( ( xhr.loaded / xhr.total * 100 ) + '% loaded' );

        },
        // called when loading has errors
        function ( error ) {

            console.log( 'An error happened : ' +error );

        }
    );
};

innit();
getCanvas();
loadModel();

//Biar mengikuti resize layar nya
window.addEventListener('resize', function() {
    renderer.setSize(width, height);
    cam.aspect = width/height;
    cam.updateProjectionMatrix();
});

function update(){
    // box.rotation.y += 0.01;
    scene.add(laki);
    canvasTextureDepan.needsUpdate = true;
    canvasTextureBelakang.needsUpdate = true;
    canvasTextureKanan.needsUpdate = true;
    canvasTextureKiri.needsUpdate = true;
    renderer.render(scene, cam);
    requestAnimationFrame(update);
};

update();

// simpan model dengan pendekatan simpan 3d modelnya hasilnya aneh texturenya tidak sesuai dengan awalan.
// $("button#order").on("click", function(e){
//     saveModel();
// });

function saveModel(){
    // var token = $('input[name=_token]').val();
    var url = $("button#order").data('href');
    var gltfExporter = new GLTFExporter();
    gltfExporter.parse(
        laki,
        function(result){
            var output = JSON.stringify( result, null, 2 );
            // alert(output);
            // $('#model').val(output);
            // $('#sendModel').attr("action", url);
            // $('#sendModel').submit();

            // Masih dengan token coba baru dengan kodingan yg dibawah
            // $.post(url, { _token:token, model:output }, function(result){
            //     console.log(result);
            // })
            // .done( function() {
            //     alert('done');
            // })
            // .fail( function(e) {
            //     console.log(e);
            // });

            // Tanpa token karena sudah di taruh di header html
            $.post(url, { model:output }, function(result){
                console.log(result);
            })
            .done( function() {
                alert('done');
            })
            .fail( function(e) {
                console.log(e);
            });
            // $.ajax({
            //     type:'POST',
            //     url:url,
            //     data:{ _token:token, model:output },
            //     dataType:'json',
            //     success:function(data){

            //     }
            // });
            // console.log( output );
            // downloadJSON( output, 'nama.gltf' );
        },
        function( error ){
            console.log( 'An error happened' + error );
        }
    );
}
