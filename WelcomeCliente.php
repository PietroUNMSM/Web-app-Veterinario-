<?php
//inicializando la sesion
session_start();

// Compruebe si el usuario ya ha iniciado sesión; en caso afirmativo, rediríjalo a la página de bienvenida
if(!isset($_SESSION["loggedin"])){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Canino - Sesión Iniciada</title>

    <link rel="stylesheet" href="./index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/x-icon" href="./images/crash icon.png">

</head>

<body>
    <div class="container1">
        <div id="botones" class="contenidos">
            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            
            <div class="button-30 text-center" style="margin-left: 550px;
                    margin-right: 550px;
                    margin-bottom: 20px;
                    margin-top: 20px;">
                    Bienvenido <?php echo $_SESSION["username"]; ?> !
            </div>
            <div id="options_pages_pagina_inicio">
                <!--Botones ya establecidos-->
                <input type="button" value="Consultar Perrito" id="consultar_boton" class="button-50">

                <!--Boton Ver Consultas de un Perro-->
                <input type="button" value="Ver Consultas" id="verConsultas_boton" class="button-50">

                <!--Boton Jugar Trivia-->
                <input type="button" value="Jugar Trivia Canina" id="jugarTrivia_boton" class="button-50">

            
            </div>
            <div class="text-center mt-5">
                <input type="button" value="Cerrar Sesión" id="logout_boton" class="button-51"> 
            </div>
        </div>


        <!--CONSULTA DE MASCOTA-->
        <div id="consultar_mascota" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            </br>
                     <div class="button-52" style="text-align:center;">Sistema de Identificacion Perruno - Consulta </div>
                  </br>
            <div class="carta">
                
                <div class="carta_cuerpo">
                    <!--h4>Sistema de Identificación Perruno</h4-->
                    <form action="#" method="POST" id="form_request">
                        <div class="mb-3">
                            <label for="nombre_mascota" class="form-label">Ingresar Nombre a buscar</label>
                            <input type="text" class="form-control" id="nombre_mascota">
                        </div>
                        <div class="acciones_boton">
                            <input type="submit" value="Buscar" class="btn btn-primary">
                            <input type="button" value="Volver" class="btn btn-danger" id="volver_boton_con">
                            <input type="button" value="Mostrar todos" class="btn btn-warning" id="all_boton_con">
                        </div>
                        <div id="success_request"></div>
                    </form>
                </div>
            </div>
        </div>



        <!--VER CONSULTA-->
        <div id="ver_consultas" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            </br>
                     <div class="button-52" style="text-align:center;"> Ver Consultas de Mascotas</div>
                  </br>
            <div class="carta" style="max-width:75rem;">
                
                <div class="carta_cuerpo" style=" width: 70rem;"> 
                    <!--h4>Sistema de Identificación Perruno</h4-->
                    <form action="#" method="POST" id="form_request_consultas" > 
                        <div class="mb-3">
                            <label for="dni_mascotaVerCon" class="form-label">Ingresar DNI de la mascota: </label>
                            <input type="text" class="form-control" id="dni_mascotaVerCon">
                        </div>
                        <div class="acciones_boton">
                            <input type="submit" value="Buscar Consulta(s)" class="btn btn-primary">
                            <input type="button" value="Volver" class="btn btn-danger" id="volver_boton_VerCon">
                            <!--input type="button" value="Mostrar todos" class="btn btn-warning" id="all_boton_con"-->
                        </div>
                        <div id="success_request_VerConsulta"></div>
                    </form>
                </div>
            </div>
        </div>

        <!--JUGAR TRIVIA-->
        <div id="jugar_trivia" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>
            </br>
                     <div class="button-52" style="text-align:center;"> JUEGO DE TRIVIA CANINA</div>
                  </br>
            <div class="carta">
                
                <div class="carta_cuerpo">
                    <div class="wrapper">	
                        <div id= "timecount"></div>
                        <div id= "questionbox"></div>
                        <div id= "answerbox"></div>
                        <button class ="btn btn-success" id ="start" style="margin-top: 10pc;
                            margin-left: 16pc;
                            margin-right: 10pc;">Iniciar Juego</button><br>
                        <button class="btn btn-primary" id="reset" style="margin-top: 5pc;
                            margin-left: 16pc;
                            margin-right: 10pc;">Jugar de nuevo</button>
                    </div>

                    <div class="acciones_boton">
                        <input type="button" value="Volver" class="btn btn-danger" id="volver_boton_Trivia" style="margin-top: 3rem;"> 
                        <!--input type="button" value="Mostrar todos" class="btn btn-warning" id="all_boton_con"-->
                    </div>
                </div>
            </div>
        </div>

   
    </div>
    
    <script type="text/javascript" src="./cliente.js"></script>
    <!--script type="text/javascript" src="./mascotas.js"></script-->
    

</body>

</html>