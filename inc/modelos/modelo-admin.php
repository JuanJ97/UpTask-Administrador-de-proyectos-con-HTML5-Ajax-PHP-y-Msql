<?php
$accion = $_POST['accion'];
$password = $_POST['password'];
$usuario = $_POST['usuario'];
if($accion === 'crear'){
    //hashear password
    $opciones = array(
    'cost' => 12
    );
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
    // importar la conexion
    include '../funciones/conexion.php';
    try{//Realizar la consulta a la base de datos
      $stmt = $con->prepare("Insert into usuarios (usuario, password) Values (?, ?)");
        $stmt->bind_param('ss', $usuario, $hash_password);
        $stmt->execute();
        $respuesta = array(
    'respuesta' => $stmt->error_list,
        'error' => $stmt->error );
        $stmt->close();
        $con->close();
    }catch(Exception $e){//En caso de un error, tomar la excepcion
         $respuesta = array(
    'pass' => $e->getMessage() );
    }
   echo json_encode($respuesta);
   
}
if($accion === 'login'){
    
}
?>
