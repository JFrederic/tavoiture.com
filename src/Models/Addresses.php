<?php

namespace Renting\Models;
use Renting\Db\Sql;
use PDO;

class Addresses extends Sql {

  public $street;
  public $zipcode;
  public $city;

  public function getStreet()
  {
    $sql = 'SELECT street FROM Addresses';
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $this->street = $stmt->fetchAll();

    return $this->street;

  }
  public function getZipcode()
  {
    $sql = 'SELECT zipcode FROM Addresses';
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $this->zipcode = $stmt->fetchAll();

    return $this->zipcode;

  }
  public function getCity()
  {
    $sql = 'SELECT city FROM Addresses';
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $this->city = $stmt->fetchAll();

    return $this->city;

  }

  public function getAddresseById($id)
  {
    $sql = 'SELECT *
            FROM Addresses A
            JOIN Vehicle V
            ON A.addresses_id = V.id_addresses
            WHERE id_addresses = :id
            ';



}


  public function addAddresse($addresse)
  {

    $sql = 'INSERT INTO Addresses (
      street,
      city,
      zipcode,
      country
    )
      VALUES (
        :street,
        :city,
        :zipcode,
        :country
      )
    ';

    $arguments = array(
      ':street' => $addresse['street'],
      ':city' => $addresse['city'],
      ':zipcode' => $addresse['zipcode'],
      ':country' => $addresse['country']
    );

    $stmt = $this->connection->prepare($sql);
    $stmt->execute($this->connection->prepare($sql));

  }

}

 ?>
