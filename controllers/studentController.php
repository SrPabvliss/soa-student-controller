<?php

include "../models/studentService.php";

$requestType = $_SERVER['REQUEST_METHOD'];
$studentService = new StudentService();

switch ($requestType) {
  case 'GET':
    $result = $studentService->getAllStudents();
    echo $result;
    break;

  case 'POST':
    $id = $_POST['id'];
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];

    $result = $studentService->createStudent(
      $id,
      $name,
      $lastName,
      $address,
      $phoneNumber
    );
    echo $result;
    break;

  case 'PUT':
    $id = $_GET['id'];
    $name = $_GET['name'];
    $lastName = $_GET['lastName'];
    $address = $_GET['address'];
    $phoneNumber = $_GET['phoneNumber'];

    $result = $studentService->updateStudent(
      $id,
      $name,
      $lastName,
      $address,
      $phoneNumber
    );
    echo $result;
    break;

  case 'DELETE':
    $id = $_GET['id'];
    $result = $studentService->deleteStudent($id);
    echo $result;
    break;

  default:
    echo 'METHOD NOT IMPLEMENTED';
    break;
}