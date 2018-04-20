<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app=new \Slim\App;

//Obtener todos los clientes

$app->get("api/clientes",function(Request $request, Response $response){

});
?>