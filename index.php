<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
include("tools/DBConnection.php");
include ("tools/RequestMethods.php");
include("model/Film.php");
include("dao/FilmDao.php");
include ("dao/FilmRepository.php");
include("service/FilmService.php");
include("controller/FilmController.php");
include ("exception/DuplicateValueException.php");
include ("exception/EmptyFieldException.php");
include ("exception/NotFoundException.php");
error_reporting(E_ERROR | E_PARSE);

$parameter = $_REQUEST;
$method = $_SERVER['REQUEST_METHOD'];


$filmController = new FilmController();
$jsonBody = json_decode(file_get_contents('php://input'));
 $filmController->switcher($method,$parameter,$jsonBody);
