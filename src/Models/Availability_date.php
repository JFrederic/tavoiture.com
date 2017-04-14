<?php
namespace Renting\Models;

use Renting\Db\Sql;
use PDO;

class Availability_date extends Sql {

  public function getAvailabilityDate()
  {
    $sql = 'SELECT *
            FROM Availability_date A
            JOIN Vehicle V
            ON A.vehicle_id = V.id_vehicle
            ';
    $stmt= $this->connection->prepare($sql);
    $stmt->execute();
    $availabilty_date = $stmt->fetchAll();
    return $availabilty_date;
  }
}
