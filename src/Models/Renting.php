<?php
namespace Renting\Models;

use Renting\Db\Sql;
use PDO;

class Renting extends Sql {

  public function getRentingById($id)
  {
    $sql = 'SELECT *
            FROM Renting R
            JOIN Vehicle V
            ON R.vehicle_id = V.id_vehicle
            JOIN User U
            ON R.user_id = U.id_user
            WHERE id_renting = :id;
            ';
    $arguments= array(
      ':id' => $id,
    );
    $stmt = $this->connection->prepare($sql);
    $stmt->execute($arguments);
    $renting = $stmt->fetch(PDO::FETCH_ASSOC);
    return $renting;
  }

  public function getAllRenting()
  {

    $sql = 'SELECT * FROM Renting';
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $rentings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rentings;
  }

  public function addRenting($renting)
  {
    $sql = "INSERT INTO Renting (
      start_date,
      end_date,
      user_id,
      vehicle_id,
      statut_id
    )
    VALUES(
      :start_date,
      :end_date,
      :user_id,
      :vehicle_id,
      :statut_id,
    )";

    $arguments = array(
      ':start_date' => $renting['start_date'],
      ':end_date' => $renting['end_date'],
      ':user_id' => $renting['user_id'],
      ':statut_id' =>$renting['statut_id']
    );

    $stmt = $this->connection->prepare($sql);
    $stmt->execute($arguments);

  }

}
