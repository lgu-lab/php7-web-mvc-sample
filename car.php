<?php

//
// Car entity entry point for HTTP request
//

require_once 'controller/CarController.php';
require_once 'commons/RequestProcessor.php';


$requestProcessor = new RequestProcessor(new CarController()); 

$requestProcessor->processRequest();

?>