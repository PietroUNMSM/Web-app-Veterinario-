
/*ADMINISTRADOR - INICIO */
$("#registro_usuario").on("click", function (e) {
    e.preventDefault();
    $("#login_div").hide();
    $("#registro_div").show();
});


$("#volver_login_boton").on("click", function (e) {
    e.preventDefault();
    $("#login_div").show();
    $("#registro_div").hide();
});

$("#login_user_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_usuario_reg = $("#nombre_usuario_log").val();
    let pass_usuario_reg = $("#pass_usuario_log").val();
    $.ajax({
        url: "LoginUser.php",
        type: "post",
        data: {
            nombre_usuario_reg,
            pass_usuario_reg,
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#login_user_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/Welcome.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});

$("#register_user_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_usuario_reg = $("#nombre_usuario_reg").val();
    let correo_usuario_reg = $("#correo_usuario_reg").val();
    let pass_usuario_reg = $("#pass_usuario_reg").val();
    let confirm_password = $("#confirm_password").val();
    $.ajax({
        url: "RegisterUser.php",
        type: "post",
        data: {
            nombre_usuario_reg,
            correo_usuario_reg,
            pass_usuario_reg,
            confirm_password,
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#register_user_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});

function password_show_hide() {
    var x = document.getElementById("pass_usuario_log");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
      x.type = "text";
      show_eye.style.display = "none";
      hide_eye.style.display = "block";
    } else {
      x.type = "password";
      show_eye.style.display = "block";
      hide_eye.style.display = "none";
    }
  }

let loginAdmin_boton = document.getElementById("loginAdmin_boton");
let login_admin_div = document.getElementById("login_div");

loginAdmin_boton.addEventListener("click", function(){
    login_admin_div.style.display="block";
    login_veterinario_div.style.display="none";
    login_cliente_div.style.display="none";
});

/*ADMINISTRADOR - FIN */



/* Variables de módulos  */

let loginVet_boton = document.getElementById("loginVet_boton");
let login_veterinario_div = document.getElementById("login_veterinario_div");

loginVet_boton.addEventListener("click", function(){
    login_admin_div.style.display="none";
    login_veterinario_div.style.display="block";
    login_cliente_div.style.display="none";
});

/*CLIENTE - INICIO */
let login_cliente_div = document.getElementById("login_cliente_div");
let login_cliente_form = document.getElementById("login_cliente_form");
let loginCliente_boton = document.getElementById("loginCliente_boton");

loginCliente_boton.addEventListener("click", function(){
    login_admin_div.style.display="none";
    login_veterinario_div.style.display="none";
    login_cliente_div.style.display="block";
});


/*
$("#loginCliente_boton").on("click", function (e) {
    e.preventDefault();
    $("#login_veterinario_div").hide();
    $("#login_div").hide();
    $("#login_cliente_div").show();
});

$("#loginAdmin_boton").on("click", function (e) {
    e.preventDefault();
    $("#login_veterinario_div").hide();
    $("#login_div").show();
    $("#login_cliente_div").hide();
});

$("#loginVet_boton").on("click", function (e) {
    e.preventDefault();
    $("#login_veterinario_div").show();
    $("#login_div").hide();
    $("#login_cliente_div").hide();
});
*/

/*CLIENTE - FIN */


$("#login_veterinario_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_veterinario_reg = $("#nombre_veterinario_log").val();
    let pass_veterinario_reg = $("#pass_veterinario_log").val();
    $.ajax({
        url: "LoginVeterinario.php",
        type: "post",
        data: {
            nombre_veterinario_reg,
            pass_veterinario_reg,
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#login_veterinario_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/WelcomeVeterinario.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});

$("#login_cliente_form").on("submit", function (e) {
    e.preventDefault();
    let nombre_cliente_reg = $("#nombre_cliente_log").val();
    let pass_cliente_reg = $("#pass_cliente_log").val();
    $.ajax({
        url: "LoginCliente.php",
        type: "post",
        data: {
            nombre_cliente_reg,
            pass_cliente_reg,
        },
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                Swal.fire("¡Éxito!", `${data.responce}`, "success");
                $("#login_cliente_form")[0].reset();
                setTimeout(() => {
                    window.location.replace("http://127.0.0.1/WelcomeCliente.php");
                }, 2000);
            } else {
                Swal.fire("Hubo un problema", `${data.responce}`, "error");
            }
        },
    });
});