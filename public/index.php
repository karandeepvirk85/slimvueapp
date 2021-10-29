<?php
// Allow ALL

// Include DB
require ('../src/db.php');
header("Access-Control-Allow-Origin:*");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
// Get App Object
$app = new \Slim\App;

$app->get('/api/accounts', function (Request $request, Response $response, array $args) {
    // Fetch All Account
    try{
        $db = new DataBase();
        $dbObject = $db->connectDB();
        $sth = $dbObject->prepare("SELECT * from accounts");
        $sth->execute();
        $arrData = $sth->fetchAll();
        echo json_encode($arrData);
    
    }catch(PDOException $e){
        echo '{
            "error":{
                "text":'.$e->getMassage().'
            }
        }';
    }
});

$app->get('/api/account/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    // Fetch Single Account
    try{
        $db = new DataBase();
        $dbObject = $db->connectDB();
        $sth = $dbObject->prepare("SELECT * from accounts WHERE id = ".$id);
        $sth->execute();
        $arrData = $sth->fetchAll();
        echo json_encode($arrData);
    
    }catch(PDOException $e){
        echo '{
            "error":{
                "text":'.$e->getMassage().'
            }
        }';
    }
});

// Post Request
$app->post('/api/account/add', function (Request $request, Response $response, array $args) {
    var_dump('HELLO WORLD!');
    // var_dump($request->getParsedBody());
    $name       = $request->getParam('name');
    $email      = $request->getParam('email');
    $password   = $request->getParam('password');
    $username   = $request->getParam('username');

    
    try{
        $db = new DataBase();
        
        $dbObject = $db->connectDB();
        
        $sth = $dbObject->prepare("INSERT INTO accounts ('name','email','password','user_name') VALUES (:name,:email,:password,:username)");
        
        $rs = $sth->execute(array(
            ":name" => $name,
            ":email"=> $email,
            ":password"=> $password,
            ":username"=> $username
        ));

    }catch(PDOException $e){
        echo '{
            "error":{
                "text":'.$e->getMassage().'
            }
        }';
    }
});
// Run APP
$app->run();
?>