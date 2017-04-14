<?php
namespace Renting\Controllers;
use Renting\Models\User;
use Symfony\Component\HttpFoundation\Request;



class UserController {

  public function login($email,$password){

    $user = new User();
    $user_session = $user->getEmail($email);

    if ($user_session == false) {
      echo "Identifiant incorrect";
    }
    if ($user_session['password'] != $password) {
        echo "Mot de passe incorrect";
    }

  
  }

}
 ?>
