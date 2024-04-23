<?php

include ('connection.php');

class StudentService
{

  private $conn;

  public function __construct()
  {
    $object = new Connection();
    $this->conn = $object->connect();
  }

  public function getAllStudents()
  {
    try {
      $sql = "SELECT * FROM students";
      $result = $this->conn->prepare($sql);
      $result->execute();
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
      return json_encode($data);
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }
  public function updateStudent($id, $name, $lastName, $address, $phoneNumber)
  {
    try {

      if (empty($id) || empty($name) || empty($lastName) || empty($address) || empty($phoneNumber)) {
        return json_encode(array("error" => "Campos incompletos"));
      }

      $sql = "UPDATE students SET id = :id , name = :name, lastName = :lastName, address = :address, phoneNumber = :phoneNumber WHERE id = :id";
      $result = $this->conn->prepare($sql);
      $result->bindParam(':id', $id);
      $result->bindParam(':name', $name);
      $result->bindParam(':lastName', $lastName);
      $result->bindParam(':address', $address);
      $result->bindParam(':phoneNumber', $phoneNumber);
      $result->execute();

      if ($result->rowCount() == 0) {
        return json_encode(array('error' => 'Error al actualizar el estudiante'));
      }

      return json_encode(array('success' => 'Se ha actualizad el estudiante'));
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }
  public function createStudent($id, $name, $lastName, $address, $phoneNumber)
  {
    if (empty($id) || empty($name) || empty($lastName) || empty($address) || empty($phoneNumber)) {
      return json_encode(array("error" => "Campos incompletos"));
    }

    try {
      $sql = "INSERT INTO students (id, name, lastName, address, phoneNumber) VALUES (:id, :name, :lastName, :address, :phoneNumber)";
      $result = $this->conn->prepare($sql);
      $result->bindParam(':id', $id);
      $result->bindParam(':name', $name);
      $result->bindParam(':lastName', $lastName);
      $result->bindParam(':address', $address);
      $result->bindParam(':phoneNumber', $phoneNumber);
      $result->execute();
      if ($result->rowCount() == 0) {
        return json_encode(array('error' => 'Error al crear el estudiante'));
      }

      return json_encode(array('success' => 'Se ha creado el estudiante'));
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }
  public function deleteStudent($id)
  {
    if (empty($id)) {
      return json_encode(array('error' => 'Cedula no ingresada'));
    }

    try {
      $sql = "DELETE FROM students WHERE id = :id";
      $result = $this->conn->prepare($sql);
      $result->bindParam(":id", $id);
      $result->execute();

      if ($result->rowCount() == 0) {
        return json_encode(array("error" => "No se ha podido eliminar el estudiante"));
      }

      return json_encode(array("success"=> "Estudiante eliminado"));
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }

}