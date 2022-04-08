<?php
//inicializando la sesion
session_start();
// Compruebe si el usuario ya ha iniciado sesión; en caso afirmativo, rediríjalo a la página de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Welcome.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Canino</title>

    <link rel="stylesheet" href="./index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="icon" type="image/x-icon" href="./images/crash icon.png">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
</head>

<body>
    <div class="container1">


        
        <!--MODULOS DE INICIO DE SESIÓN-->


        <!--LOGIN ADMINISTRADOR-->
        <div id="login_div" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            </br>
                <div class="button-52" style="text-align:center;">Iniciar Sesión - Administrador</div>
            </br>


            <div id="options_pages_pagina_inicio">
                <!--Botones ya establecidos-->
                <input type="button" value="Administrador" id="loginAdmin_boton" class="button-50">
                <input type="button" value="Veterinario" id="loginVet_boton" class="button-50">
                <input type="button" value="Cliente" id="loginCliente_boton" class="button-50">
  
            </div>

            <div class="card" style="width: 20rem; margin: auto;">
                <img src="./images/login_Dogo.jpg" class="card-img-top" alt="..." style="height: 200px;
                        width: 250px;margin:auto">
                <div class="card-body">
                    <!--h5 class="card-title text-center">Iniciar Sesión</h5-->
                    <form action="" id="login_user_form">
                        <div class="mb-3">
                            <label for="nombre_usuario_log" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="nombre_usuario_log" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass_usuario_log" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass_usuario_log" required>
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" style="background-color:#6f2f74; border-color:#6f2f74;">Iniciar Sesión!</button>
                        </div>
                    </form>
                    <div class="text-center mt-1">
                        <a href="#" style="color: gray" id="registro_usuario">¿No tienes cuenta? Crea una aquí</a>
                    </div>
                </div>
            </div>
        </div>


        <!--LOGIN Veterinario-->
        <div id="login_veterinario_div" class="contenidos" style="display: none;">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            </br>
                <div class="button-52" style="text-align:center;">Iniciar Sesión - Veterinario</div>
            </br>

            <!--Botones ya establecidos-->
            <div id="options_pages_pagina_inicio"> 
                <input type="button" value="Administrador" id="loginAdmin_boton" class="button-50">
                <input type="button" value="Veterinario" id="loginVet_boton" class="button-50">
                <input type="button" value="Cliente" id="loginCliente_boton" class="button-50">
  
            </div>

            <div class="card" style="width: 20rem; margin: auto;">
                <img src="./images/Reg_Veterinario.png" class="card-img-top" alt="..." style="height: 200px;
                        width: 250px;margin:auto">
                <div class="card-body">
                    <!--h5 class="card-title text-center">Iniciar Sesión</h5-->
                    <form action="" id="login_veterinario_form">
                        <div class="mb-3">
                            <label for="nombre_veterinario_log" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="nombre_veterinario_log" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass_veterinario_log" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass_veterinario_log" required>
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" style="background-color:#6f2f74; border-color:#6f2f74;">Iniciar Sesión!</button>
                            <!--a href="#" class="btn btn-warning" id="volver_login_boton">Regresar</a-->
                        </div>
                    </form>
                    <div class="text-center mt-1">
                        <!--a href="#" style="color: gray" id="registro_usuario">¿No tienes cuenta? Crea una aquí</a-->
                    </div>
                </div>
            </div>
        </div>

        <!--LOGIN CLIENTE-->
        <div id="login_cliente_div" class="contenidos" style="display: none;">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            </br>
                <div class="button-52" style="text-align:center;">Iniciar Sesión - Cliente</div>
            </br>

            <!--Botones ya establecidos-->
            <div id="options_pages_pagina_inicio"> 
                <input type="button" value="Administrador" id="loginAdmin_boton" class="button-50">
                <input type="button" value="Veterinario" id="loginVet_boton" class="button-50">
                <input type="button" value="Cliente" id="loginCliente_boton" class="button-50">
  
            </div>

            <div class="card" style="width: 20rem; margin: auto;">
                <img src="./images/reg_Cliente.jpg" class="card-img-top" alt="..." style="height: 200px;
                        width: 250px;margin:auto">
                <div class="card-body">
                    <!--h5 class="card-title text-center">Iniciar Sesión</h5-->
                    <form action="" id="login_cliente_form">
                        <div class="mb-3">
                            <label for="nombre_cliente_log" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="nombre_cliente_log" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass_cliente_log" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass_cliente_log" required>
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" style="background-color:#6f2f74; border-color:#6f2f74;">Iniciar Sesión!</button>
                            <!--a href="#" class="btn btn-warning" id="volver_login_boton">Regresar</a-->
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- REGISTRO DE USUARIO ADMINISTRADOR -->
        <div id="registro_div" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            </br>
                <div class="button-52" style="text-align:center;">Registrar Usuario - Administrador</div>
            </br>

            <div class="card" style="width: 20rem; margin: auto;">
                <img src="./images/lomito_facho.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <!--h5 class="card-title text-center">Registrar Usuario</h5-->
                    <form action="" id="register_user_form">
                        <div class="mb-3">
                            <label for="nombre_usuario_reg" class="form-label">Nombre: </label>
                            <input type="text" class="form-control" id="nombre_usuario_reg" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo_usuario_reg" class="form-label">E-Mail: </label>
                            <input type="email" class="form-control" id="correo_usuario_reg"
                                aria-describedby="emailHelp" required>
                            <!--div id="emailHelp" class="form-text">Nunca compartiremos tu correo electrónico con nadie
                                más.</div-->
                        </div>
                        <div class="mb-3">
                            <label for="pass_usuario_reg" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass_usuario_reg" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Password</label>
                            <input type="password" class="form-control" id="confirm_password" required>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" style="background-color:#6f2f74; border-color:#6f2f74;">Crear Cuenta!</button>
                            <a href="#" class="btn btn-warning" id="volver_login_boton">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="./index.js"></script>
</body>

</html>