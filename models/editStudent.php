<?php

include "connection.php";

$object = new Connection();

$conexion = $object->connect();

$id = $_GET['id'];
$name = $_POST['name'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$phoneNumber = $_POST['phoneNumber'];

$consulta = "UPDATE students SET name = '$name', lastName = '$lastName', address = '$address', phoneNumber = '$phoneNumber' WHERE id = '$id'";

$resultado = $conexion->query($consulta);

$response = array();

if ($resultado) {
    $response['status'] = 'success';
    $response['message'] = 'Estudiante actualizado correctamente';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error al actualizar el estudiante';
}

echo json_encode($response);
