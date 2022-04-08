/*Div de botones */
let botones = document.getElementById("botones");

/*Botones para seleccionar modulo */
let registrar_boton = document.getElementById("registrar_boton");
let consultar_boton = document.getElementById("consultar_boton");

/*Botones volver segun el modulo */
let volver_boton_reg = document.getElementById("volver_boton_reg");
let volver_boton_con = document.getElementById("volver_boton_con");

/*Div - modulo */
let registrar_mascota = document.getElementById("registrar_mascota");
let consultar_mascota = document.getElementById("consultar_mascota");

registrar_boton.addEventListener("click", function () {
    botones.style.display = "none";
    registrar_mascota.style.display = "table-cell";
    volver_boton_reg.style.display = "table-row";
});

consultar_boton.addEventListener("click", function () {
    botones.style.display = "none";
    consultar_mascota.style.display = "table-cell";
    volver_boton_con.style.display = "table-row";
});

volver_boton_reg.addEventListener("click", function () {
    registrar_mascota.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_reg.style.display = "none";
    document.getElementById("success_register").innerHTML = "";
});

volver_boton_con.addEventListener("click", function () {
    consultar_mascota.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_con.style.display = "none";
    document.getElementById("success_request").innerHTML = "";
    $("#nombre_mascota").val("");
});

$("#inicio_boton").on("click", function (e) {
    e.preventDefault();
    $("#botones").show();
    $("#success").hide();
});

/*Formularios */
let form_cosulta = document.getElementById("form_request");
let form_registrar = document.getElementById("form_register");

form_cosulta.addEventListener("submit", (event) => {
    event.preventDefault();
    consultar();
});

function consultar() {
    document.getElementById("success_request").innerHTML = "";
    let nombreMascota = document.getElementById("nombre_mascota").value;
    if (nombreMascota == "" || nombreMascota == null) {
        Swal.fire("Es necesario especificar un nombre");
    } else {
        $.ajax({
            url: "Consultar_perro.php",
            type: "post",
            dataType: "json",
            data: {
                nombre: nombreMascota,
                tipoConsulta: "specific",
            },
            success: function (data) {
                mostrarResultadoConsulta(data);
            },
        });
    }
}

form_registrar.addEventListener("submit", (event) => {
    event.preventDefault();
    registrar();
});

function registrar() {
    let codigo_mascota = $("#codigo_mascota").val();
    let nombre_mascota_r = $("#nombre_mascota_r").val();
    let fechaNac_mascota = $("#fechaNac_mascota").val();
    let Genero = document.querySelector('input[name="Genero"]:checked').value;
    let raza_mascota = document.getElementById("raza_mascota").value;
    let formData = new FormData();
    let files = $("#foto_mascota")[0].files[0];
    
    formData.append("Foto", files);
    formData.append("Codigo", codigo_mascota);
    formData.append("Nombre", nombre_mascota_r);
    formData.append("FechNac", fechaNac_mascota);
    formData.append("Genero", Genero);
    formData.append("Raza", raza_mascota);

    $.ajax({
        url: "Registrar_perro.php",
        type: "post",
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        data: formData,
        success: function (data) {
            if (data.responce == "success") {
                //document.getElementById("success_register").innerHTML = data.responceData;
                $("#registrar_mascota").hide();
                $("#success").show();
                form_registrar.reset();
            } else {
                alert("Formato de imagen incorrecto.");
            }
        },
    });
}

function mostrarResultadoConsulta(data) {
    let count_result = 0;
    let table = `
    <table class="table" style="color: #fff; text-align:center;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Raza</th>
            <th scope="col">Fecha Nac.</th>
            <th scope="col">Género</th>
            <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
    `;
    for (const pet of data.mascotas) {
        let genero_desc = "";
        switch (pet.genero) {
            case '0':
                genero_desc = "Hembra"
                break;
            case '1':
                genero_desc = "Macho"
                break;
        }
        table += `
                <tr>
                    <th scope="row">${++count_result}</th>
                    <td>${pet.nombre}</td>
                    <td>${pet.raza}</td>
                    <td>${pet.fechaNacimiento}</td>
                    <td>${genero_desc}</td>
                    <td><img src="${pet.foto}" alt="Girl in a jacket" width="200"></td>
                </tr>
                `;
    }
    table += `
            </tbody>
        </table>
    `;
    document.getElementById("success_request").innerHTML = table;
}

$("#all_boton_con").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: "Consultar_perro.php",
        type: "post",
        data: {
            tipoConsulta: "all",
        },
        dataType: "json",
        success: function (data) {
            mostrarResultadoConsulta(data);
        },
    });
});

$("#logout_boton").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: "Logout.php",
        type: "post",
        dataType: "json",
        complete: function () {
            window.location.replace("http://127.0.0.1/index.php");
        }
    });
});





/*CONSULTA - INICIO */
let div_registrar_consulta = document.getElementById("registrar_consulta");

let registrarConsulta_boton = document.getElementById("registrarConsulta_boton");

let form_register_Consulta = document.getElementById("form_register_Consulta");

let volver_boton_regConsulta = document.getElementById("volver_boton_regConsulta");

/*Botones */

volver_boton_regConsulta.addEventListener("click", function () {
    div_registrar_consulta.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_regConsulta.style.display = "none";
    document.getElementById("success_register_cliente").innerHTML = "";
});

registrarConsulta_boton.addEventListener("click", function () {
    botones.style.display = "none";
    div_registrar_consulta.style.display = "table-cell";
    volver_boton_regConsulta.style.display = "table-row";
});

form_register_Consulta.addEventListener("submit", (event) => {
    event.preventDefault();
    registrarConsulta();
});

function registrarConsulta(){
    let idPerro_con = $("#dni_perroConsulta").val();
    let idVeterinario_con = $("#id_veterinarioConsulta").val();
    let idCliente_con = $("#dni_clienteConsulta").val();
    let sintomas_con = $("#sintomas_consulta").val();
    let blood_test_con = $("#blood_test_diagnosis").val();
    let medicine_con = $("#medicine_consulta").val();
    let costo_con = $("#costo_consulta").val();
    
    //let Sexo = document.querySelector('input[name="Sexo"]:checked').value;
    //let confirm_password_veterinario = $("#confirm_password_veterinario").val();
    let formData = new FormData();
    //Foto de X-Ray
    let files = $("#x_ray_imagen")[0].files[0];
    
    formData.append("Foto", files);
    formData.append("idPerro_con", idPerro_con);
    formData.append("idVeterinario_con", idVeterinario_con);
    formData.append("idCliente_con", idCliente_con);
    formData.append("sintomas_con", sintomas_con);

    formData.append("blood_test_con", blood_test_con);
    formData.append("medicine_con", medicine_con);
    formData.append("costo_con", costo_con);
    
    $.ajax({
        url: "Registrar_consulta.php",
        type: "post",
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        data: formData,
        success: function (data) {
            if (data.responce == "success") {
                //document.getElementById("success_register").innerHTML = data.responceData;
                $("#registrar_consulta").hide();
                $("#success_RegConsulta").show();
                //form_register_Consulta.reset();
            } else {
                alert("No se logró registrar Consulta Veterinaria.");
            }
        },
    });
}

$("#inicio_boton_Consulta").on("click", function (e) {
    e.preventDefault();
    $("#botones").show();
    $("#success_RegConsulta").hide();
});
/*CONSULTA - FIN */


/*DEUDAS - INICIO */
let div_registrar_deuda = document.getElementById("registrar_deuda");

let registrarDeuda_boton = document.getElementById("registrarDeuda_boton");

let form_register_Deuda = document.getElementById("form_register_Deuda");

let volver_boton_regDeuda = document.getElementById("volver_boton_regDeuda");

/*Botones */

volver_boton_regDeuda.addEventListener("click", function () {
    div_registrar_deuda.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_regDeuda.style.display = "none";
    document.getElementById("success_register_cliente").innerHTML = "";
});

registrarDeuda_boton.addEventListener("click", function () {
    botones.style.display = "none";
    div_registrar_deuda.style.display = "table-cell";
    volver_boton_regDeuda.style.display = "table-row";
});

form_register_Deuda.addEventListener("submit", (event) => {
    event.preventDefault();
    registrarDeuda();
});

function registrarDeuda(){
    let dni_clienteDeuda = $("#dni_clienteDeuda").val();
    let id_perroDeuda = $("#id_perroDeuda").val();
    let razon_deuda = $("#razon_deuda").val();
    let costo_deuda = $("#costo_deuda").val();
    
    let Estado = document.querySelector('input[name="Estado"]:checked').value;
    //let raza_mascota = document.getElementById("raza_mascota").value;
    let formData = new FormData();
    //let files = $("#foto_mascota")[0].files[0];
    
    //formData.append("Foto", files);
    formData.append("id_perroDeuda", id_perroDeuda);
    formData.append("dni_clienteDeuda", dni_clienteDeuda);
    formData.append("razon_deuda", razon_deuda);
    formData.append("costo_deuda", costo_deuda);
    formData.append("Estado", Estado);

    $.ajax({
        url: "Registrar_deuda.php",
        type: "post",
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        data: formData,
        success: function (data) {
            if (data.responce == "success") {
                //document.getElementById("success_register").innerHTML = data.responceData;
                $("#registrar_deuda").hide();
                $("#success_RegDeuda").show();
                form_registrar.reset();
            } else {
                alert("Formato de imagen incorrecto.");
            }
        },
    });
}

$("#inicio_boton_Deuda").on("click", function (e) {
    e.preventDefault();
    $("#botones").show();
    $("#success_RegDeuda").hide();
});

/*DEUDAS - FIN */


/* VER CONSULTAS - INICIO */
let verConsultas_boton = document.getElementById("verConsultas_boton");

let form_Verconsultas = document.getElementById("form_request_consultas");

let div_ver_consultas = document.getElementById("ver_consultas");

let volver_boton_VerCon = document.getElementById("volver_boton_VerCon");

verConsultas_boton.addEventListener("click", function () {
    botones.style.display = "none";
    div_ver_consultas.style.display = "table-cell";
    volver_boton_VerCon.style.display = "table-row";
});

volver_boton_VerCon.addEventListener("click", function () {
    div_ver_consultas.style.display = "none";
    botones.style.display = "table-cell";
    volver_boton_VerCon.style.display = "none";
    document.getElementById("success_request").innerHTML = "";
    $("#nombre_mascotaVerCon").val("");
});

$("#volver_boton_VerCon").on("click", function (e) {
    e.preventDefault();
    $("#botones").show();
    $("#success_request_VerConsulta").hide();
});

form_Verconsultas.addEventListener("submit", (event) => {
    event.preventDefault();
    verConsultas();
});

function verConsultas() {
    document.getElementById("success_request_VerConsulta").innerHTML = "";
    let dniPerro = document.getElementById("dni_mascotaVerCon").value;
    if (dniPerro == "" || dniPerro == null) {
        Swal.fire("Es necesario ingresar DNI de la mascota");
    } else {
        $.ajax({
            url: "Ver_consultas.php",
            type: "post",
            dataType: "json",
            data: {
                idPerro: dniPerro,
                tipoConsulta: "specific",
            },
            success: function (data) {
                mostrarResultado_VerConsulta(data);
            },
        });
    }
}

function mostrarResultado_VerConsulta(data) {
    let count_result = 0;
    let table = `
    <table class="table" style="color: #fff; text-align:center;">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">idPerro</th>
            <th scope="col">idVeterinario</th>
            <th scope="col">idCliente</th>
            <th scope="col">Sintomas</th>
            <th scope="col">Rayos-X</th>
            <th scope="col">Diagnóstico de Test Sanguíneo</th>
            <th scope="col">Medicina</th>
            <th scope="col">Costo</th>
            </tr>
        </thead>
        <tbody>
        `;
        for (const pet of data.mascotas) {
            
            table += `
                    <tr>
                        <th scope="row">${++count_result}</th>
                        <td>${pet.idPerro}</td>
                        <td>${pet.idVeterinario}</td>
                        <td>${pet.idCliente}</td>
                        <td>${pet.sintomas}</td>
                        <td><img src="${pet.x_ray}" alt="Rayos de X de lomito" width="200"></td>
                        <td>${pet.blood_test_diagnosis}</td>
                        <td>${pet.medicine}</td>
                        <td>${pet.cost}</td>
                    </tr>
                    `;
        }
        table += `
                </tbody>
            </table>
        `;
    document.getElementById("success_request_VerConsulta").innerHTML = table;
}

/* VER CONSULTAS - FIN */

