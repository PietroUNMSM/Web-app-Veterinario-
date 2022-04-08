<?php

$tipoConsulta = $_POST[ 'tipoConsulta' ];
switch ( $tipoConsulta ) {
    case 'specific':
    consultar_especifico();
    break;
    default:
    consultar_todos();
    break;
}

function connection() {
    //( nombre de la base de datos, $enlace ) mysql_select_db( 'RelocaDB', $link );
    //conexion a la Base de datos ( Servidor, usuario, password )
    $conn = mysqli_connect( 'localhost', 'root', '', 'relocadb' );
    if ( !$conn ) {
        die( 'Error de conexion: ' . mysqli_connect_error() );
    }
    return $conn;
}

function consultar_especifico() {
    $conn = connection();
    //capturando datos
    $v2 = $_POST[ 'idPerro' ];
    //$v2 = $_REQUEST[ 'Nombre' ];
    //conuslta SQL
    $sql = "select * from consultas where idPerro like '".$v2."'";
    $result = mysqli_query( $conn, $sql );
    //cuantos reultados hay en la busqueda
    $num_resultados = mysqli_num_rows( $result );

    // creamos un array auxiliar
    $emparray = array();
    // Iniciamos con la conversion a JSON
    while( $row = mysqli_fetch_assoc( $result ) )
 {
        $emparray[] = $row;
    }
    //$emparray[ 'numeroResultados' ] = $num_resultados;
    // array de respuesta
    $dataResponce = array(
        'mascotas' => $emparray
    );
    echo json_encode( $dataResponce );
}
exit;



function consultar_todos() {
    $conn = connection();
    $sql = 'select * from consultas';
    $result = mysqli_query( $conn, $sql );
    // creamos un array auxiliar
    $emparray = array();
    // Iniciamos con la conversion a JSON
    while( $row = mysqli_fetch_assoc( $result ) )
 {
        $emparray[] = $row;
    }
    // array de respuesta
    $dataResponce = array(
        'mascotas' => $emparray
    );
    echo json_encode( $dataResponce );
}
?>
