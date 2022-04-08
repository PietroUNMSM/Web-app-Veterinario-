let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        myFunction_registrar(this);
    };
    xhttp.open("POST", "Registrar_perro.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let codigo_mascota = document.getElementById("codigo_mascota").value;
    let nombre_mascota_r = document.getElementById("nombre_mascota_r").value;
    let fechaNac_mascota = document.getElementById("fechaNac_mascota").value;
    let Genero = document.querySelector('input[name="Genero"]:checked').value;
    let raza_mascota_aux = document.getElementById("raza_mascota").value;
    let foto_mascota = document.getElementById("foto_mascota");
    //console.log(foto_mascota.files[0]);
    //return;
    //let foto_mascota = document.getElementById("foto_mascota").value;
    let data = `Codigo=${codigo_mascota}&Nombre=${nombre_mascota_r}&FechNac=${fechaNac_mascota}&Raza=${raza_mascota_aux}&Genero=${Genero}&Foto=${foto_mascota}`
    xhttp.send(data);

    function myFunction_registrar(xhttp) {
        document.getElementById("success_register").innerHTML = xhttp.responseText;
        document.getElementById("nombre_mascota").value = "";
        form_registrar.reset();
    }

    function consultar2() {
        let xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            myFunction_consultar(this);
        };
        xhttp.open("POST", "Consultar_perro.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let nombreMascota = document.getElementById("nombre_mascota").value;
        xhttp.send(`nombre=${nombreMascota}`);
    }
    
    function myFunction_consultar(xhttp) {
        let json_objet = JSON.stringify(xhttp.responseText);
        console.log(json_objet, xhttp);
        let image = `<img src="img_girl.jpg" alt="Girl in a jacket" width="500" height="600">`;
        document.getElementById("success_request").innerHTML = image;
    
        document.getElementById("nombre_mascota").value = "";
    }
    