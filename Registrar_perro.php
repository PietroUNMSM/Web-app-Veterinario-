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
$v1 = $_REQUEST[ 'Codigo' ];
$v2 = $_REQUEST[ 'Nombre' ];
$v3 = $_REQUEST[ 'FechNac' ];
$v4 = $_REQUEST[ 'Raza' ];
$v5 = $_REQUEST[ 'Genero' ];
$v6;

if ( !isset( $v1 ) || !isset( $v2 ) || !isset( $v3 ) || !isset( $v4 ) || !isset( $v5 ) ) {
    $responceData = 'Existen datos vacíos en el formulario';
    $validForm = false;
}

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
    $sql = 'INSERT INTO perritos (dni, nombre, raza, genero, fechaNacimiento, foto) ';
    $sql .= "VALUES ('$v1', '$v2', '$v4', '$v5', '$v3', '$v6' )";

    if ( mysqli_query( $conn, $sql ) ) {
        //Mensaje de conformidad
        $statusProcess = 'success';
        $responceData = 'Data guardada correctamente';
        $responceImage = 'Imagen subida correctamente';

        $dataSaved['codigo'] = $v1;
        $dataSaved['nombre'] = $v2;
        $dataSaved['fechaNacimiento'] = $v3;
        $dataSaved['genero'] = $v4;
        $dataSaved['raza'] = $v5;
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