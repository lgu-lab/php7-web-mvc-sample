<?php
/**
 * Abstract controller
 * 
 * @author Telosys Code Generator
 *
 */
abstract class AbstractController
{
    private $href = "" ;
    
    /**
     * Constructor
     */
    public function __construct($href) {
        $this->href = $href ;
    }
    
    /**
     * Returns the HREF associated with the entity
     * @return object
     */
    protected function getHREF() {
        return $this->href ;
    }
    
    /**
     * Prints the given message(s) in the HTML page and stop the current request processing
     * @param string $msg
     * @param string $msg2
     * @param string $msg3
     */
    protected function error($msg, $msg2="", $msg3="") {
        require 'view/commons/error.php';
        die("End of error processing.");
    }

    /**
     * Checks the given string : must be defined, not void and valid integer
     * @param string $v
     * @param string $name
     * @return string|NULL
     */
    protected function checkInteger($v, $name) {
        // isset : check if defined and not null
        if ( ! isset($v) )       return "'" . $name ."' is undefined or null ";
        if ( strlen($v) == 0 )   return "'" . $name ."' is void " ;
        if ( ! ctype_digit($v) ) return "'" . $name ."' is not an integer : '" . $v . "'" ;
        return null ;
    }
    
    /**
     * Checks the given string : must be defined and not void
     * @param string $v
     * @param string $name
     * @return string|NULL
     */
    protected function checkString($v, $name) {
        // isset : check if defined and not null
        if ( ! isset($v) )       return "'" . $name ."' is undefined or null" ;
        if ( strlen($v) == 0 )   return "'" . $name ."' is void" ;
        return null ;
    }
    
    //--------------------------------------------------------------------------------------------
    // Abstract methods 
    //--------------------------------------------------------------------------------------------
    
    /**
     * Renders a page containing a list of entities
     * @param array $requestData
     */
    abstract public function list($requestData);
    
    /**
     * Renders a void form to create a new entity
     */
    abstract public function formForCreate();
    
    /**
     * Renders a form to update an entity
     * @param array $requestData
     */
    abstract public function formForUpdate($requestData) ;
    
    
    /**
     * Processes the http request to create a new entity (POST expected)
     * @param array $requestData
     */
    abstract public function create($requestData) ;
    
    /**
     * Processes the http request to updqte an entity (POST expected)
     * @param array $requestData
     */
    abstract public function update($requestData);
    
    /**
     * Processes the http request to delete an entity (GET or POST)
     * @param array $requestData
     */
    abstract public function delete($requestData);

}
?>