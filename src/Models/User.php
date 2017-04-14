<?php
namespace Renting\Models;
use Renting\Db\Sql;
use PDO;

class User extends Sql {


  public function getEmail($email)
  {
    $sql = 'SELECT email , password
            FROM User
            WHERE email = :email
            ';
    $arguments = array(
      'email' => $email,
    );
    $stmt = $this->connection->prepare($sql);
    $stmt->execute($arguments);
    $email = $stmt->fetch(PDO::FETCH_ASSOC);

    return $email;
  }
}

 ?>
