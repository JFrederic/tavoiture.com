<?php
namespace Renting\Controllers;
use Renting\Models\Renting;
use Symfony\Component\HttpFoundation\Request;

class RentingController {


  public function getRenting($idrenting)
  {
    $newrenting = new Renting();
    $renting = $newrenting->getRentingById($idrenting);

    return $renting;
  }

  public function getRentingList()
  {
    $newrenting = new Renting();
    $renting = $newrenting->getAllRenting();

    return $renting;
  }

  public function create($rent)
  {

    $renting = new Renting();
    $renting_ask = $renting->addRenting($rent);

    return $renting_ask;

  }
}
