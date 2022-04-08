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
$v1 = $_REQUEST[ 'dni_cliente' ];
$v2 = $_REQUEST[ 'nombre_cliente_r' ];
$v3 = $_REQUEST[ 'correo_cliente' ];
$v4 = $_REQUEST[ 'confirm_password_cliente' ];


if ( !isset( $v1 ) || !isset( $v2 ) || !isset( $v3 ) || !isset( $v4 )  ) {
    $responceData = 'Existen datos vacíos en el formulario';
    $validForm = false;
}



//consulta SQL
if($validForm) {
    $sql = 'INSERT INTO clientes (dni, nombre, correo, password) ';
    $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4')";

    if ( mysqli_query( $conn, $sql ) ) {
        //Mensaje de conformidad
        $statusProcess = 'success';
        $responceData = 'Data guardada correctamente';
        $responceImage = 'Imagen subida correctamente';

        $dataSaved['dni'] = $v1;
        $dataSaved['nombre'] = $v2;
        $dataSaved['correo'] = $v3;
        $dataSaved['password'] = $v4;
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