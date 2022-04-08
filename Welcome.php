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
                <input type="button" value="Registar Perrito" id="registrar_boton" class="button-50">
                <input type="button" value="Consultar Perrito" id="consultar_boton" class="button-50">

                <!--Botones nuevos-->
                <!--Crear usuarios Cliente y Veterinario-->
                <input type="button" value="Registrar Veterinario" id="registrarVeterinario_boton" class="button-50">
                <input type="button" value="Registrar Cliente" id="registrarCliente_boton" class="button-50">

                <!--Botones Veterinario-->
                <input type="button" value="Registrar Consulta" id="registrarConsulta_boton" class="button-50">
                <input type="button" value="Registrar Deuda" id="registrarDeuda_boton" class="button-50">

                <!--Boton Ver Consultas de un Perro-->
                <input type="button" value="Ver Consultas" id="verConsultas_boton" class="button-50">

            
            </div>
            <div class="text-center mt-5">
                <input type="button" value="Cerrar Sesión" id="logout_boton" class="button-51"> 
            </div>
        </div>

        <!--REGISTRO DE PERROS-->
        <div id="registrar_mascota" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>Local Canino</em></h2>
            </div>

            </br>
                     <div class="button-52" style="text-align:center;">Sistema de Identificacion Perruno - Registro </div>
                  </br>
            <div class="carta">
                <img src="./images/Reg_Dogo.png" class="carta_img" alt="logo de historia clinica" />
                <div class="carta_cuerpo">
                    <!--h4>Registro de perritos</h4-->
                    <form action="#" method="POST" id="form_register" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="codigo_mascota" class="form-label">Ingresar código</label>
                            <input type="text" class="form-control" id="codigo_mascota">
                        </div>
                        <div class="mb-3">
                            <label for="nombre_mascota_r" class="form-label">Ingresar nombre</label>
                            <input type="text" class="form-control" id="nombre_mascota_r">
                        </div>
                        <div class="mb-3">
                            <label for="fechaNac_mascota" class="form-label">Ingresar Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNac_mascota">
                        </div>
                        <div class="mb-3">
                            <label for="Genero" class="form-label">Género</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Genero" id="Genero1" value="1">
                                <label class="form-check-label" for="Genero1">
                                    Macho
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Genero" id="Genero2" value="0"
                                    checked>
                                <label class="form-check-label" for="Genero2">
                                    Hembra
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Genero" class="form-label">Seleccione Raza</label>
                            <Select class="form-select" name="Raza" id="raza_mascota">
                                <Option value="Schnauzer"> Schnauzer </option>
                                <Option value="Pitbull"> Pitbull </option>
                                <Option value="Bulldog"> Bulldog </option>
                                <Option value="Shichu"> Shichu </option>
                                <Option value="Pequines"> Pequines </option>
                                <Option value="San Bernardo"> San Bernardo </option>
                                <Option value="Chiguahua"> Chiguahua </option>
                            </Select>
                        </div>

                        <div class="mb-3">
                            <label for="foto_mascota" class="form-label">Subir Foto</label>
                            <input class="form-control" type="file" id="foto_mascota">
                        </div>
                        <div class="acciones_boton">
                            <input name="Registrar" Type="Submit" value="Registrar" class="btn btn-primary">
                            <input Type="button" value="Volver" class="btn btn-primary" id="volver_boton_reg">
                        </div>
                        </P>
                        <div id="success_register"></div>
                    </form>
                </div>
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


        <!--REGISTRO DE MASCOTA EXITOSA-->
        <div id="success" class="contenidos" style="display: none;">
            <div class="button-30 text-center" style="margin-left: 550px;
                    margin-right: 550px;
                    margin-bottom: 20px;
                    margin-top: 20px;">
                ¡Perrito registrado exitosamente!
            </div>
            <div id="options_pages_pagina_inicio">
                <input type="button" value="Inicio" id="inicio_boton" class="boton">
            </div>
        </div>


        <!--REGISTRO DE VETERINARIO-->
        <div id="registrar_veterinario" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>

            </br>
                     <div class="button-52" style="text-align:center;">Sistema de Identificacion Veterinario - Registro</div>
                  </br>
            <div class="carta">
                <img src="./images/foto_veterinario.png" class="carta_img" alt="logo de historia clinica" />
                <div class="carta_cuerpo">
                    <!--h4>Registro de veterinarios</h4-->
                    <form action="#" method="POST" id="form_register_Veterinario" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="dni_veterinario" class="form-label">Ingresar DNI:</label>
                            <input type="text" class="form-control" id="dni_veterinario">
                        </div>
                        <div class="mb-3">
                            <label for="nombre_veterinario_r" class="form-label">Ingresar nombre y apellido:</label>
                            <input type="text" class="form-control" id="nombre_veterinario_r">
                        </div>
                        <div class="mb-3">
                            <label for="correo_veterinario" class="form-label">Ingresar correo electrónico:</label>
                            <input type="text" class="form-control" id="correo_veterinario">
                        </div>
                        <div class="mb-3">
                            <label for="sexo_veterinario" class="form-label">Sexo:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Sexo" id="Sexo1" value="1">
                                <label class="form-check-label" for="Sexo1">
                                    Hombre
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Sexo" id="Sexo2" value="0"
                                    checked>
                                <label class="form-check-label" for="Sexo2">
                                    Mujer
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pass_veterinario_reg" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass_veterinario_reg" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password_veterinario" class="form-label">Confirmar Password</label>
                            <input type="password" class="form-control" id="confirm_password_veterinario" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="foto_veterinario" class="form-label">Subir Foto:</label>
                            <input class="form-control" type="file" id="foto_veterinario">
                        </div>
                        <div class="acciones_boton">
                            <input name="Registrar_veterinario" Type="submit" value="Registrar" class="btn btn-primary">
                            <input Type="button" value="Volver" class="btn btn-primary" id="volver_boton_regVet">
                        </div>
                        </P>
                        <div id="success_register_vet"></div>
                    </form>
                </div>
            </div>
        </div>

        <div id="success_RegVet" class="contenidos" style="display: none;">
            <div class="button-30 text-center" style="margin-left: 550px;
                    margin-right: 550px;
                    margin-bottom: 20px;
                    margin-top: 20px;">
                ¡Veterinario registrado exitosamente!
            </div>
            <div id="options_pages_pagina_inicio">
                <input type="button" value="Inicio" id="inicio_boton_Veterinario" class="boton">
            </div>
        </div>


        <!--REGISTRO DE CLIENTE-->
        <div id="registrar_cliente" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>

            </br>
                     <div class="button-52" style="text-align:center;">Sistema de Identificacion Cliente - Registro</div>
                  </br>
            <div class="carta">
                <img src="./images/reg_Cliente.jpg" class="carta_img" alt="logo de registro cliente" />
                <div class="carta_cuerpo">
                    <!--h4>Registro de veterinarios</h4-->
                    <form action="#" method="POST" id="form_register_Cliente" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="dni_cliente" class="form-label">Ingresar DNI:</label>
                            <input type="text" class="form-control" id="dni_cliente">
                        </div>
                        <div class="mb-3">
                            <label for="nombre_cliente_r" class="form-label">Ingresar nombre y apellido:</label>
                            <input type="text" class="form-control" id="nombre_cliente_r">
                        </div>
                        <div class="mb-3">
                            <label for="correo_cliente" class="form-label">Ingresar correo electrónico:</label>
                            <input type="text" class="form-control" id="correo_cliente">
                        </div>
                        
                        <div class="mb-3">
                            <label for="pass_cliente_reg" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass_cliente_reg" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password_cliente" class="form-label">Confirmar Password</label>
                            <input type="password" class="form-control" id="confirm_password_cliente" required>
                        </div>
                        
                        
                        <div class="acciones_boton">
                            <input name="Registrar_cliente" Type="submit" value="Registrar" class="btn btn-primary">
                            <input Type="button" value="Volver" class="btn btn-primary" id="volver_boton_regCliente">
                        </div>
                        </P>
                        <div id="success_register_cliente"></div>
                    </form>
                </div>
            </div>
        </div>

        <div id="success_RegCliente" class="contenidos" style="display: none;">
            <div class="button-30 text-center" style="margin-left: 550px;
                    margin-right: 550px;
                    margin-bottom: 20px;
                    margin-top: 20px;">
                ¡Cliente registrado exitosamente!
            </div>
            <div id="options_pages_pagina_inicio">
                <input type="button" value="Inicio" id="inicio_boton_Cliente" class="boton">
            </div>
        </div>


        <!--REGISTRAR CONSULTA-->
        <div id="registrar_consulta" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>

            </br>
                <div class="button-52" style="text-align:center;"> Registro de Consulta Canina </div>
            </br>
            <div class="carta">
                <img src="./images/consultaCanina.png" class="carta_img" alt="logo de registro de consulta" />
                <div class="carta_cuerpo">
                    <!--h4>Registro de veterinarios</h4-->
                    <form action="#" method="POST" id="form_register_Consulta" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="dni_perroConsulta" class="form-label">Ingresar DNI del Perro:</label>
                            <input type="text" class="form-control" id="dni_perroConsulta">
                        </div>
                        <div class="mb-3">
                            <label for="id_veterinarioConsulta" class="form-label">Ingresar ID del Veterinario:</label>
                            <input type="text" class="form-control" id="id_veterinarioConsulta">
                        </div>
                        <div class="mb-3">
                            <label for="dni_clienteConsulta" class="form-label">Ingresar DNI del Cliente:</label>
                            <input type="text" class="form-control" id="dni_clienteConsulta">
                        </div>
                        <div class="mb-3">
                            <label for="sintomas_consulta" class="form-label">Ingrese los síntomas de la mascota:</label>
                            <input type="text" class="form-control" id="sintomas_consulta">
                        </div>

                        <div class="mb-3">
                            <label for="x_ray_imagen" class="form-label">Subir imagen de Rayos-X:</label>
                            <input class="form-control" type="file" id="x_ray_imagen">
                        </div>

                        <div class="mb-3">
                            <label for="blood_test_diagnosis" class="form-label">Diagnóstico del Test Sanguíneo:</label>
                            <input type="text" class="form-control" id="blood_test_diagnosis">
                        </div>

                        <div class="mb-3">
                            <label for="medicine_consulta" class="form-label">Medicina:</label>
                            <input type="text" class="form-control" id="medicine_consulta">
                        </div>
                        
                        <div class="mb-3">
                            <label for="costo_consulta" class="form-label">Costo de la Consulta:</label>
                            <input type="number" step="0.1" class="form-control" id="costo_consulta">
                        </div>

                        <div class="acciones_boton">
                            <input name="Registrar_consulta" Type="submit" value="Registrar Consulta" class="btn btn-primary">
                            <input Type="button" value="Volver" class="btn btn-primary" id="volver_boton_regConsulta">
                        </div>
                        </P>
                        <div id="success_register_consulta"></div>
                    </form>
                </div>
            </div>
        </div>

        <div id="success_RegConsulta" class="contenidos" style="display: none;">
            <div class="button-30 text-center" style="margin-left: 550px;
                    margin-right: 550px;
                    margin-bottom: 20px;
                    margin-top: 20px;">
                ¡Consulta de Perrito registrado exitosamente!
            </div>
            <div id="options_pages_pagina_inicio">
                <input type="button" value="Inicio" id="inicio_boton_Consulta" class="boton">
            </div>
        </div>


        <!--REGISTRAR DEUDA DE MASCOTA-->
        <div id="registrar_deuda" style="display: none;" class="contenidos">

            <!--Titulo y Botones-->
            <div>
                <h2 id="logo"><em>LOCAL CANINO</em></h2>
            </div>

            </br>
                     <div class="button-52" style="text-align:center;"> Registro de Deuda Canina </div>
                  </br>
            <div class="carta">
                <img src="./images/deuda_perro.jpg" class="carta_img" alt="logo de registro de deuda" />
                <div class="carta_cuerpo">
                    <!--h4>Registro de Deuda</h4-->
                    <form action="#" method="POST" id="form_register_Deuda" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id_perroDeuda" class="form-label">Ingresar ID del Perro:</label>
                            <input type="text" class="form-control" id="id_perroDeuda">
                        </div>
                        
                        <div class="mb-3">
                            <label for="dni_clienteDeuda" class="form-label">Ingresar DNI del Cliente:</label>
                            <input type="text" class="form-control" id="dni_clienteDeuda">
                        </div>
                        <div class="mb-3">
                            <label for="razon_deuda" class="form-label">Ingrese la razón de la deuda:</label>
                            <input type="text" class="form-control" id="razon_deuda">
                        </div>

                        <div class="mb-3">
                            <label for="costo_deuda" class="form-label">Monto de la deuda:</label>
                            <input type="number" step="0.01" class="form-control" id="costo_deuda">
                        </div>

                        <div class="mb-3">
                            <label for="Estado" class="form-label">Estado</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Estado" id="Estado1" value="1">
                                <label class="form-check-label" for="Estado1">
                                    Pagado
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Estado" id="Estado2" value="0"
                                    checked>
                                <label class="form-check-label" for="Estado2">
                                    Pendiente
                                </label>
                            </div>
                        </div>
                        
                        <div class="acciones_boton">
                            <input name="Registrar_deuda" Type="submit" value="Registrar deuda" class="btn btn-primary">
                            <input Type="button" value="Volver" class="btn btn-primary" id="volver_boton_regDeuda">
                        </div>
                        </P>
                        <div id="success_register_deuda"></div>
                    </form>
                </div>
            </div>
        </div>

        <div id="success_RegDeuda" class="contenidos" style="display: none;">
            <div class="button-30 text-center" style="margin-left: 550px;
                    margin-right: 550px;
                    margin-bottom: 20px;
                    margin-top: 20px;">
                ¡Deuda de Perrito registrado exitosamente!
            </div>
            <div id="options_pages_pagina_inicio">
                <input type="button" value="Inicio" id="inicio_boton_Deuda" class="boton">
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




        
    </div>
    
    <script type="text/javascript" src="./mascotas.js"></script>
    <!--script type="text/javascript" src="./veterinario.js"></script-->
    

</body>

</html>