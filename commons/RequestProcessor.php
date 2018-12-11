<?php
require_once 'commons/Logger.php';
require_once 'commons/Action.php';

class RequestProcessor {

    private $controller;
    
    public function __construct($controller) {
	    $this->controller = $controller;
    }
    
    public function processRequest() {
        
        $action = 'list' ; // Default value 
        if ( isset($_GET[Action::PARAMNAME]) ) {
            $action = $_GET[Action::PARAMNAME] ;
        }
        
        switch ($action) {
            
            case Action::LIST :
                $this->controller->list($this->getRequestData());
                break;
            case Action::FORM_CREATE :
                $this->controller->formForCreate($this->getRequestData());
                break;
            case Action::FORM_UPDATE :
                $this->controller->formForUpdate($this->getRequestData());
                break;
            
            case Action::CREATE :
                $this->do_create();
                break;
            case Action::UPDATE :
                $this->do_update();
                break;
            case Action::DELETE :
                $this->do_delete();
                break;
                
            default:
                //TODO handle_error();
                echo "<h1>ERROR : </h1>" ;
                echo "<h1>Invalid action : '" . $action . "' in parameter '" . Action::PARAMNAME . " </h1>" ;
                break;
        }
    }
    
    private function getRequestData() {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
            return $_POST ;
        }
        else {
            return $_GET ;
        }
    }
    
//     private function do_list() { // GET expected
//         $this->controller->list($this->getRequestData());
//     }
    
//     private function do_formForCreate() { // GET expected
//         $this->controller->formForCreate($this->getRequestData());
//     }
    
//     private function formForUpdate() { // GET expected
//         $this->controller->formForUpdate($this->getRequestData());
//     }
    
    private function do_create() { // POST expected
        $this->controller->create($this->getRequestData());
    }
    
    private function do_update() { // POST expected
        $this->controller->update($this->getRequestData());
    }
    
    private function do_delete() { // GET or POST 
        // Merge GET and POST data 
        //$this->controller->delete( array_merge($_GET, $_POST) );
        $this->controller->delete( $this->getRequestData() );
    }
}
?>