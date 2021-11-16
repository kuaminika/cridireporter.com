<?php

// remove comments for dev mode
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/../K_Utilities/_requireAll.php";
require __DIR__."/../vendor/autoload.php";
//inspired from : https://developer.okta.com/blog/2019/03/08/simple-rest-api-php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );


$requestMethod = $_SERVER["REQUEST_METHOD"];



$configReader = \K_Utilities\KIgniter::Ignite();


$request =$_REQUEST;

if( !array_key_exists("context",$request))
{
    header("HTTP/1.1 404 Not Found");
   // echo "context missing";
    
   echo json_encode( $_SERVER);
   exit();
}
$requestParams = $request;
if($requestMethod == "POST")
{
    $json = file_get_contents('php://input');
   $json_decoded = ["jsonValue" =>json_decode($json)];
   
    $requestParams = array_merge($_POST,$json_decoded);
}
unset($requestParams["context"]);
unset($requestParams["requestAction"]);

// echo json_encode($request);

$controllerNamespace =   $configReader->getConfig("ControllerNamespcae");
$controllerName = $controllerNamespace. $request["context"]."Controller";

$controllerExists = class_exists($controllerName);
$actionGiven = isset($request["requestAction"]);
if(!$controllerExists)
{
   //todo : use the notfound controller before resorting to this
   echo $controllerName." not found";
    header("HTTP/1.1 404  Not Found");
    exit();
}
$setUpControllerName = "SetUp";
$setUpControllerCalled = strstr($controllerName,$setUpControllerName );

if($setUpControllerCalled)
{
    echo "set up controller is called ";
    echo $controllerName;
    die;
}


$createControllerParams = array( "context"       => $request["context"]
                                ,"configs"       => K_Utilities\ModuleConfigReader::getCurrentConfigs()
                                ,"requestAction" => $actionGiven ?$request["requestAction"]:"notFound"
                                ,"requestParams" => $requestParams
                                ,"requestMethod" => $requestMethod);
$contrrolerToolBox = call_user_func($controllerNamespace."ControllerToolBox::createNew",$createControllerParams);// \Controllers\ControllerToolBox::createNew($createControllerParams );
$controller = new $controllerName($contrrolerToolBox);

$controller->processRequest();

?>