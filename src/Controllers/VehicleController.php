<?php
namespace Renting\Controllers;
use Renting\Models\Vehicle;
use Renting\Models\Brand;
use Symfony\Component\HttpFoundation\Request;




class VehicleController {


  public function IndexAction()
    {

      $vehicle = new Vehicle();
      $vehicles = $vehicle->getAllVehicle();

      return $vehicles;

    }

  public function getVehicle($idvehicle)
    {

      $newvehicle = new Vehicle();
      $vehicle = $newvehicle->getVehicleById($idvehicle);

      // $newbrand = new Brand();
      // $brand = $newbrand->getBrandByModel();

      return $vehicle;
    }

  public function create($vehicle)
  {

    $newvehicle = new Vehicle();

    return $newvehicle->addVehicle($vehicle);
  }

}


 ?>
