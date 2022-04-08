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
$v1 = $_REQUEST[ 'idPerro_con' ];
$v2 = $_REQUEST[ 'idVeterinario_con' ];
$v3 = $_REQUEST[ 'idCliente_con' ];
$v4 = $_REQUEST[ 'sintomas_con' ];
$v6 = $_REQUEST[ 'blood_test_con' ];
$v7 = $_REQUEST[ 'medicine_con' ];
$v8 = $_REQUEST[ 'costo_con' ];
$v5; //foto de rayos x
 
if ( !isset( $v1 ) || !isset( $v2 ) || !isset( $v3 ) || !isset( $v4 ) || !isset( $v6 ) || !isset( $v7 ) || !isset( $v8 ) ) {
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
            $v5 = $location;
        } else {
            // subimos la imagen
            if ( move_uploaded_file( $_FILES[ 'Foto' ][ 'tmp_name' ], $location ) ) {
                $response = $location;
                $v5 = $response;
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
    $sql = 'INSERT INTO consultas (idPerro, idVeterinario, idCliente, sintomas, x_ray, blood_test_diagnosis, medicine, cost) ';
    $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4', '$v5', '$v6', '$v7', '$v8' )";

    if ( mysqli_query( $conn, $sql ) ) {
        //Mensaje de conformidad
        $statusProcess = 'success';
        $responceData = 'Data guardada correctamente';
        $responceImage = 'Imagen subida correctamente';

        $dataSaved['idPerro'] = $v1;
        $dataSaved['idVeterinario'] = $v2;
        $dataSaved['idCliente'] = $v3;
        $dataSaved['sintomas'] = $v4;
        $dataSaved['x-ray'] = $v5;
        $dataSaved['blood_test_diagnosis'] = $v6;
        $dataSaved['medicine'] = $v7;
        $dataSaved['cost'] = $v8;
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