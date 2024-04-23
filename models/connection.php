<?php

class Connection
{

  private $SERVER_NAME;
  private $DATABASE_NAME;
  private $USER;
  private $DB_PASSWORD;
  private $OPTIONS;

  private static $connection;
  public function __construct()
  {
    $this->SERVER_NAME = "localhost";
    $this->DATABASE_NAME = "soa";
    $this->USER = "root";
    $this->DB_PASSWORD = "";
    $this->OPTIONS = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
  }

  public static function connect()
  {
    if (!isset(self::$connection)) {
      $connection = new Connection();
      try {
        self::$connection = new PDO("mysql:host=" . $connection->SERVER_NAME . ";dbname=" . $connection->DATABASE_NAME, $connection->USER, $connection->DB_PASSWORD, $connection->OPTIONS );
      } catch (Exception $e) {
        die(json_encode(array($e->getMessage())));
      }
    }
    return self::$connection;
  }
}
