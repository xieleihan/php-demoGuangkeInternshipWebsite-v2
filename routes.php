<?php
$router->addGet('/','HomeController@index');
// $router->addGet('/listings','controllers/listings/index.php');
// $router->addGet('/listings/create','controllers/listings/create.php');
// $router->addGet('/listing','controllers/listings/show.php');

$router->addGet('/listings','ListingController@index');
$router->addGet('/listings/create','ListingController@create');
$router->addGet('/listings/{id}','ListingController@show');
$router->addPost('/listings','ListingController@store');