<?php

namespace Renting\Db;


use PDO;
use PDOException;

abstract class Sql {

  public $hostname = "localhost";
  public $username = "root";
  public $dbname = "tavoiture";
  public $password = "simplon974";
  protected $connection;


  public function __construct()
  {
    $this->getConnection();
  }

   public function getConnection()
       {
         try {
             $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->dbname",
                 $this->username,
                 $this->password);
             $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch (PDOException $e) {
             echo $e->getMessage();
         }

         return $this->connection;
       }






}

 ?>
