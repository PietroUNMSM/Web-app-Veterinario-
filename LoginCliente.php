<?php
//inicializando la sesion
//session_start();

//data control
$statusProcess = '';
$responce = '';

//conexion a la Base de datos de usuarios
$conn = mysqli_connect( 'localhost', 'root', '', 'relocadb' );
if ( !$conn ) {
    die( 'Error de conexion: ' . mysqli_connect_error() );
}
 
/* // Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = ""; */
 
/* // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
} */

$nombre = $_REQUEST[ 'nombre_cliente_reg' ];
$password = $_REQUEST[ 'pass_cliente_reg' ];

/*  // Check if username is empty
 if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
} else{
} */

$username = trim($nombre);

/* // Check if password is empty
if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
} else{
} */
$password = trim($password);

//validacion de credenciales

//preparando la sentencia de select
$sql = "SELECT dni, nombre, correo, password FROM clientes WHERE nombre = ?";
    
if($stmt = mysqli_prepare($conn, $sql)){
    //vincular variables a la declaración preparada como parámetros
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    
    //establecer parametros
    $param_username = $username;
    
    //intento de ejecucion de la sentencia sql
    if(mysqli_stmt_execute($stmt)){
        //guardar resultado
        mysqli_stmt_store_result($stmt);
        
        //Verifique si existe el nombre de usuario, si es asi, verifique la contraseña
        if(mysqli_stmt_num_rows($stmt) == 1){                    
            
            //vincular las variables de resultados
            mysqli_stmt_bind_result($stmt, $dni, $username,  $correo, $hashed_password);
            
            if(mysqli_stmt_fetch($stmt)){
                //if(password_verify($password, $hashed_password)){
                
                if($password == $hashed_password){
                    // Password es correcto, iniciamos una nueva sesion
                    session_start();
                    
                    //almacenar las variables de sesion
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $dni;
                    $_SESSION["username"] = $username;                            
                    
                    $statusProcess = 'success';
                } else{
                    // Password nos es valido
                    $statusProcess = 'failed';
                    $responce = 'La contraseña es incorrecta';
                }
            }
        } else{
            //nombre de usuario no existe
            $statusProcess = 'failed';
            $responce = 'El nombre de usuario no existe';
        }
    } else{
        $statusProcess = "failed";
        $responce = 'Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.';
    }

     //cerramos la sentencia sql
    mysqli_stmt_close($stmt);
}

//cerramos la coneccion
mysqli_close($conn);

$data_responce = array (
    'status'=> $statusProcess,
    'responce'=> $responce
);
echo json_encode($data_responce);