<?php
require_once 'commons/AbstractHref.php';

/**
 * HREF for entity 'Car'
 * 
 * @author Telosys Code Generator
 *
 */
class CarHref extends AbstractHref {
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct("/car.php");
    }
    
    /**
     * Builds the query string with ID parts
     * @param object $car
     * @return string
     */
    protected function hrefKeyParam($car) {
        return "&" . "id=" . $car->getId() ;
    }
    
}

?>