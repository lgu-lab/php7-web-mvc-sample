<?php
require_once 'entities/Car.php';


echo "test1.php </br>" ;

echo "--- SET 'foo' in SESSION </br>" ;

session_start();
$_SESSION['foo'] = "FOO" ;

echo " 'foo' : " . $_SESSION['foo'] . "</br>";


echo "--- SET ARRAY 'x' in SESSION </br>" ;
$_SESSION['x'] = [] ;
array_push($_SESSION['x'], 'a1');
array_push($_SESSION['x'], 'a2');


echo "--- SET ARRAY 'c' in SESSION </br>" ;
$_SESSION['c'] = [] ;

$car1 = new Car('a', 'b', 'c', 'd', 'e', 'f');
echo " 'car1' : " . $car1 . "</br>";
array_push($_SESSION['c'], clone $car1);
echo " 'count ' : " . count($_SESSION['c']) . "</br>";



$car2 = new Car('a2', 'b2', 'c2', 'd2', 'e2', 'f2');
echo " 'car2' : " . $car2 . "</br>";
array_push($_SESSION['c'], clone $car2);
echo " 'count ' : " . count($_SESSION['c']) . "</br>";

echo "--- DONE. </br>" ;

?>