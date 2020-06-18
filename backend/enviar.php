<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
$json = file_get_contents('php://input');

$obj = json_decode($json);

$to = "robertogonzaloalvarez01@gmail.com"; 
$subject = $obj -> {'apellido'} . ", " . $obj -> {'nombre'} . " Asbacco Propiedades";
$message = "Se ha ingresado una nueva consulta en el formulario de contacto. \nDatos del usuario: \nApellido y nombre: " . $obj -> {'apellido'} . " " . $obj -> {'nombre'} . ".\nEmail: ". $obj -> {'email'} . "\nTelefono: " . $obj -> {'telefono'} . "\nHa dejado el siguiente mensaje: " . $obj -> {'mensaje'};
$headers = "From: " . $obj -> {'email'} . "\r\n" . "CC: franco@asbaccopropiedades.com";

$llamada = mail($to, $subject, $message, $headers);
if($llamada){ 
        echo json_encode(array('status' => true, 'info' => "El mail se ha enviado con exito"));
}else{ 
        echo json_encode(array('status' => false, 'info' => "Ha ocurrido un error en el envio del mail"));
        echo error_get_last()['message'];
}



//var_dump(json_decode($json, true));

?>
