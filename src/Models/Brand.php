<?php
namespace Renting\Models;

use Renting\Db\Sql;
use PDO;


class Brand extends Sql{

  public function getBrandByModel()
  {

    $sql = 'SELECT name as marque
            FROM Brand B
            JOIN Model M
            ON B.model_id = M.id_model
            ';
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $brand = $stmt->fetchAll();
  }
}

 ?>
