<?php
//conexion a la Base de datos ( Servidor, usuario, password )
$conn = mysqli_connect( 'localhost', 'root', '', 'relocadb' );
if ( !$conn ) {
    die( 'Error de conexion: ' . mysqli_connect_error() );
}
// data de respuesta
$statusProcess = '';
$responceData = '';
$responceImage = '';
$validForm = true;
$dataSaved = array();

//capturando datos
$v1 = $_REQUEST[ 'dni_veterinario' ];
$v2 = $_REQUEST[ 'nombre_veterinario_r' ];
$v3 = $_REQUEST[ 'CorreoVeterinario' ];
$v4 = $_REQUEST[ 'sexo_veterinario' ];
$v5 = $_REQUEST[ 'confirm_password_veterinario' ];
//$v6 = $_REQUEST[ 'foto' ];
$v6; //para la foto

/* Verificando ausencia de datos */
if ( !isset( $v1 ) || !isset( $v2 ) || !isset( $v3 ) || !isset( $v4 ) || !isset( $v5 ) ) {
    $responceData = 'Existen datos vacíos en el formulario';
    $validForm = false;
}

/*Validación de la foto del veterinario */
if ( isset( $_FILES[ 'Foto' ][ 'name' ] ) ) {

    // obtenemos el nombre de la imagen
    $filename = $_FILES[ 'Foto' ][ 'name' ];

    // localizamos donde se guardara
    $location = 'upload/'.$filename;
    $imageFileType = pathinfo( $location, PATHINFO_EXTENSION );
    $imageFileType = strtolower( $imageFileType );

    // validamos las extensiones deseadas
    $valid_extensions = array( 'jpg', 'jpeg', 'png' );

    $response = 0;
    /* verificamos que sean de las extensiones especificadas */
    if ( in_array( strtolower( $imageFileType ), $valid_extensions ) ) {
        // verificamos si existe la imagen
        if(is_file($location)) {
            $v6 = $location;
        } else {
            // subimos la imagen
            if ( move_uploaded_file( $_FILES[ 'Foto' ][ 'tmp_name' ], $location ) ) {
                $response = $location;
                $v6 = $response;
            }
        }
    } else {
        $responceImage = 'Formato o extensión inválida';
        $validForm = false;
    }
} else {
    $responceImage = 'Imagen no subida';
    $validForm = false;
}

//consulta SQL
if($validForm) {
    $sql = 'INSERT INTO veterinarios (dni, nombre, correo, sexo, password, foto) ';
    $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4', '$v5', '$v6' )";

    if ( mysqli_query( $conn, $sql ) ) {
        //Mensaje de conformidad
        $statusProcess = 'success';
        $responceData = 'Data guardada correctamente';
        $responceImage = 'Imagen subida correctamente';

        $dataSaved['dni'] = $v1;
        $dataSaved['nombre'] = $v2;
        $dataSaved['correo'] = $v3;
        $dataSaved['sexo'] = $v4;
        $dataSaved['password'] = $v5;
        $dataSaved['foto'] = $v6;
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error( $conn );
        $statusProcess = 'failed';
        $responceData = 'Data guardada incorrectamente';
        $responceImage = 'Imagen subida incorrectamente';
    }
    
    mysqli_close( $conn );
    
} else {
    $statusProcess = 'failed';
}
$data_responce = array (
    'responce'=> $statusProcess,
    'responceData'=> $responceData,
    'responceImage'=> $responceImage,
    'dataSaved'=> $dataSaved
);
echo json_encode($data_responce);
?>