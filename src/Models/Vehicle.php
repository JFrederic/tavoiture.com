<?php

namespace Renting\Models;
use Renting\Db\Sql;
use PDO;
use PDOException;


class Vehicle extends Sql {


  public function getAllVehicle()
  {

    $sql = 'SELECT * ,M.name as modele, B.name as marque
            FROM Vehicle V
            JOIN Model M
            ON V.model_id = M.id_model
            JOIN Brand B
            ON M.brand_id = B.id_brand';
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $vehicles;
  }

  public function getVehicleById($id)
    {
        $sql = 'SELECT * , M.name as modele , B.name as marque 
                FROM Vehicle V
                JOIN Model M
                ON V.model_id = M.id_model
                JOIN Brand B
                ON M.brand_id = B.id_brand
                JOIN Addresses A
                ON V.addresses_id = A.id_addresses
                JOIN Type T
                ON V.type_id = T.id_type
                JOIN User U
                ON V.user_id = U.id_user
                WHERE id_vehicle = :id';
        $arguments = array(
            ':id' => $id,
        );

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($arguments);
        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
        return $vehicle;
    }

    public function getVehicleByUser()
    {
      $sql = 'SELECT *
              FROM Vehicle V
              JOIN User U
              ON V.user_id = U.id_user
              WHERE user_id = U.id_user
              ';
      $stmt = $this->connection->prepare($sql);
      $stmt->execute($arguments);
      $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
      return $vehicle;
    }


  public function addVehicle($vehicle)
    {

        $sql = "INSERT INTO Vehicle (
                      `power`,
                      fuel,
                      places_number,
                      maintenance,
                      color,
                      price,
                      image,
                      available,
                      addresses_id,
                      model_id,
                      type_id,
                      user_id
                  )
                  VALUES (
                      :power,
                      :fuel,
                      :places_number,
                      :maintenance,
                      :color,
                      :price,
                      :image,
                      :available,
                      :addresses_id,
                      :model_id,
                      :type_id,
                      :user_id
                  )";
            $arguments = array(
                ':power' => $vehicle['power'],
                ':fuel' => $vehicle['fuel'],
                ':places_number' => $vehicle['places_number'],
                ':maintenance' => $vehicle['maintenance'],
                ':color' => $vehicle['color'],
                ':price' => $vehicle['price'],
                ':image' => $vehicle['image'],
                ':available' => $vehicle['available'],
                ':addresses_id' => $vehicle['addresses_id'],
                ':model_id' => $vehicle['model_id'],
                ':type_id' => $vehicle['type_id'],
                ':user_id' => $vehicle['user_id'],
            );
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($arguments);

        }


}

 ?>
