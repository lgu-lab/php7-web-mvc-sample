<?php
echo "Hello from do.php </br>" ;

echo "--- </br>" ;

$method = $_SERVER['REQUEST_METHOD'];
echo "REQUEST_METHOD : " . $method . "</br>";

echo "--- </br>" ;
$pathinfo = $_SERVER['PATH_INFO'];
echo "PATH_INFO : " . $pathinfo . "</br>";

echo "--- </br>" ;
$do = $_GET['_do_'];
echo "_do_ : " . $do . "</br>";

echo "--- </br>" ;
$action = $_GET['_action_'];
echo "_action_ : " . $action . "</br>";


?>