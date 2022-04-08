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
    $v2 = $_POST[ 'nombre' ];
    //$v2 = $_REQUEST[ 'Nombre' ];
    //conuslta SQL
    $sql = "select * from perritos where nombre like '".$v2."'";
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

/* echo '<p>Número de perros encontrados: '.$num_resultados.'</p>';
//mostrando informacion de los perros y detalle
for ( $i = 0; $i <$num_resultados; $i++ ) {
    $row = mysqli_fetch_array( $result );

    //echo ( $i+1 );
    echo ' DNI : '.$row[ 'dni' ];
    echo ' </br>Nombre : '.$row[ 'nombre' ];
    echo ' </br>Raza : '.$row[ 'raza' ];
    echo ' </br>Genero : '.$row[ 'genero' ];
    echo ' </br>Nacio en : '.$row[ 'fechaNacimiento' ];
    echo '</p>';
}
*/

function consultar_todos() {
    $conn = connection();
    $sql = 'select * from perritos';
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
