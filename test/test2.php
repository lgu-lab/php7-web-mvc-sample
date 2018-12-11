<?php
echo "test2.php </br>" ;

echo "--- Try to get 'foo' from SESSION ....</br>" ;

session_start();

echo " 'foo' = " . $_SESSION['foo'] . "</br>";

echo "--- ---</br>" ;

echo " print_r SESSION[x] </br>";
print_r($_SESSION['x']);
echo " </br>";

echo " var_dump SESSION[x] </br>";
var_dump($_SESSION['x']);
echo " </br>";

echo "--- ---</br>" ;

echo " print_r SESSION[c] </br>";
print_r($_SESSION['c']);
echo " </br>";

echo " var_dump SESSION[c] </br>";
var_dump($_SESSION['c']);
echo " </br>";

?>