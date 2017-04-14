<?php
namespace Renting\Controllers;
use Renting\Models\Addresses;
use Symfony\Component\HttpFoundation\Request;


class AddresseController {

  public function createAddresse($addresse)
  {
    $newaddresse = new Addresses();


    return $newaddresse->addAddresse($addresse);
  }
}
