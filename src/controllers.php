<?php
namespace Renting;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));


$app->get('/', function () use ($app) {
    $vehicle = new Controllers\VehicleController();
    $vehicles = $vehicle->IndexAction();
    return $app['twig']->render('home.html.twig', array(
      'vehicles' => $vehicles,
    ));
})
->bind('homepage');

$app->match('/login',function(Request $request) use ($app){


  if ($request->isMethod("post")) {
    # code...

  $email = $request->get('email');
  $password = $request->get('password');



  $user = new Controllers\UserController;
  $user->login($email,$password);

  }
  return $app['twig']->render('login.html.twig');
});




$app->get('/vehicle/{idvehicle}',function($idvehicle) use($app){

  $newvehicle = new Controllers\VehicleController();
  $vehicle = $newvehicle->getVehicle($idvehicle);

  return $app['twig']->render('askrent.html.twig',array(
    'vehicle' => $vehicle,
  ));
})
->bind('vehicle');

$app->get('/list/vehicle',function() use($app) {


  $newvehicle = new Controllers\VehicleController();
  $vehicles = $newvehicle->IndexAction();

  return $app['twig']->render('vehicles_list.html.twig',array(
    'vehicles' => $vehicles,
  ));

})->bind('vehicle_list');



$app->match('/add/vehicle',function(Request $request) use($app) {

  if ($request->isMethod("post")) {

    // $street = $request->get('street');
    // $city = $request->get('city');
    // $zipcode = $request->get('zipcode');
    // $country = $request->get('country');
    //
    //
    // $addresse = [
    //   'street' => $street,
    //   'city' => $city,
    //   'zipcode' => $zipcode,
    //   'country' => $country
    // ];
    //
    // $newaddresse = new Controllers\AddresseController();
    // $newaddresse->createAddresse($addresse);

    $model = $request->get('model');
    $type = $request->get('type');
    $places_number = $request->get('places_number');
    $fuel = $request->get('fuel');
    $power = $request->get('power');
    $color = $request->get('color');
    $maintenance = $request->get('maintenance');
    $price = $request->get('price');

    $vehicle = [
      // "brand" => $brand,
      "power" => $power,
      "fuel" => $fuel,
      "places_number" => $places_number,
      "maintenance" => $maintenance,
      "color" => $color,
      "price" => $price,
      "type" => $type,
      "image" => 'images/Lamborghini-Aventador-Main.jpg',
      "available" => 1,
      "addresses_id" => 1,
      "model_id" => 1,
      "type_id" => 1,
      "user_id" => 1
    ];

    $newvehicle = new Controllers\VehicleController();
    $newvehicle->create($vehicle);
  }
  return $app['twig']->render('rent.html.twig');
})->bind('add_vehicle');




$app->match('/rent/vehicle',function(Request $request) use($app){

  if ($request->isMethod("post")) {
    $start_date = $request->get('start_date');
    $end_date = $request->get('end_date');
    $user_id = $request->get('user_id');
    $vehicle_id = $request->get('vehicle_id');
    $statut_id = $request->get('statut_id');
  }
  $rent = [
    'start_date' => $start_date,
    'end_date' => $end_date,
    'user_id' => 1,
    'vehicle_id' => 1,
    'statut_id' => 1,
  ];
  $newrenting = new Controllers\RentingController();
  $newrenting->create($rent);

  return $app['twig']->render('askrent.html.twig');
});




$app->get('/list/rent', function () use ($app) {
    $renting = new Controllers\RentingController();

    $rent = $renting->getRentingList();
    return $app['twig']->render('renting_asked.html.twig', array(
      'rent' => $rent,
    ));
})
->bind('asked_renting');



$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
