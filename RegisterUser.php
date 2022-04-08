<?php
//conexion a la Base de datos de usuarios
$conn = mysqli_connect( 'localhost', 'root', '', 'relocadb' );
if ( !$conn ) {
    die( 'Error de conexion: ' . mysqli_connect_error() );
}

//capturando datos
$nombre = $_REQUEST[ 'nombre_usuario_reg' ];
$correo = $_REQUEST[ 'correo_usuario_reg' ];
$password = $_REQUEST[ 'pass_usuario_reg' ];
$confirm_password = $_REQUEST[ 'confirm_password' ];
//data control
$statusProcess = '';
$responce = '';
$validForm = true;

//validando el nombre de usuario
if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($nombre))) {
    $statusProcess = "failed";
    $responce = 'El nombre de usuario debe contener solo letras, numeros y guión bajo';
    $validForm = false;
} else {
    //preparamos la sentencia sql
    $sql = "SELECT id FROM users WHERE nombre = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        //vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        //establecer parametros
        $param_username = trim($nombre);
        
        //intento de ejecucion de la sentencia sql
        if(mysqli_stmt_execute($stmt)){
            //guardar el resultado
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $statusProcess = "failed";
                $responce = 'El nombre de usuario ya está en uso. Intente con otro dato';
                $validForm = false;
            } else{
                $username = trim($nombre);
            }
        } else{
            $statusProcess = "failed";
            $responce = 'Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.';
            $validForm = false;
        }
        //cerramos la sentencia sql
        mysqli_stmt_close($stmt);
    }
}

//validando el password

//if(strlen(trim($password)) < 8){
    //(?=.*[#\$%&\/?]){2,}
if(!preg_match('/^(?=(?:\D*\d){2,})(?=.*[A-Z]){1,}(?=.*[#$%&\/?]{2,})[a-zA-Z0-9#$%&\/?]{8,}$/', trim($password))){
        $statusProcess = "failed";
        $responce = 'La contraseña debe de tener almenos 8 caracteres, 2 números, 1 mayúscula y 2 caracteres especiales';
        $validForm = false;
  
} else{
        $password = trim($password);
        
}

exit;
//validando la confirmacion del password
$confirm_password = trim($confirm_password);
if($password != $confirm_password){
    $statusProcess = "failed";
    $responce = 'La confirmación de la contraseña no coincide';
    $validForm = false;
}

//verificando antes de insertar en la base de datos
if($validForm){  
    //preparando la sentencia sql
    $sql = "INSERT INTO users (nombre, correo, password) VALUES (?, ?, ?)";
     
    if($stmt = mysqli_prepare($conn, $sql)){
        //vinculando variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_correo, $param_password);
        
        //estableciendo los parametros
        $param_username = $username;
        $param_correo = $correo;
        //$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $param_password = md5($password);
        
        //intento de ejecucion de la sentencia sql
        if(mysqli_stmt_execute($stmt)){
            $responce = 'El usuario ha sido registrado correctamente';
            $statusProcess = "success";
        } else{
            $statusProcess = "failed";
            $responce = 'Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.';
        }

        //cerramos la sentenia
        mysqli_stmt_close($stmt);
    }
}

//cerramos la coneccion
mysqli_close($conn);

$data_responce = array (
    'status'=> $statusProcess,
    'responce'=> $responce
);
echo json_encode($data_responce);
  
