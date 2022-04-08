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
$v1 = $_REQUEST[ 'dni_clienteDeuda' ];
$v2 = $_REQUEST[ 'id_perroDeuda' ];
$v3 = $_REQUEST[ 'razon_deuda' ];
$v4 = $_REQUEST[ 'costo_deuda' ];
$v5 = $_REQUEST[ 'Estado' ];
//$v6 = $_REQUEST[ 'foto' ];
$v6; //para la foto

/* Verificando ausencia de datos */
if ( !isset( $v1 ) || !isset( $v2 ) || !isset( $v3 ) || !isset( $v4 ) || !isset( $v5 ) ) {
    $responceData = 'Existen datos vacíos en el formulario';
    $validForm = false;
}



//consulta SQL
if($validForm) {
    $sql = 'INSERT INTO deudas (id_Cliente, id_Perro, razon, costo, estado) ';
    $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4', '$v5' )";

    if ( mysqli_query( $conn, $sql ) ) {
        //Mensaje de conformidad
        $statusProcess = 'success';
        $responceData = 'Data guardada correctamente';
        $responceImage = 'Imagen subida correctamente';

        $dataSaved['id_Cliente'] = $v1;
        $dataSaved['id_Perro'] = $v2;
        $dataSaved['razon'] = $v3;
        $dataSaved['costo'] = $v4;
        $dataSaved['estado'] = $v5;
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