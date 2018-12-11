<?php
abstract class AbstractHref {
    
    private $entryPoint = "" ;
    
    /**
     * Constructor
     */
    public function __construct($phpFile) {
        $this->entryPoint = $phpFile ;
    }
    
    protected function HREF($action) {
        return $this->entryPoint .  "?" . Action::PARAMNAME . "=" . $action ;
    }
    
    
    abstract protected function hrefKeyParam($entity) ;
    
    //-----------------------------------------------------------
    
    public function list() {
        return $this->HREF(Action::LIST) ;
    }
    
    public function formForUpdate($car) {
        return $this->HREF(Action::FORM_UPDATE) . $this->hrefKeyParam($car) ;
    }
    
    public function formForCreate() {
        return $this->HREF(Action::FORM_CREATE) ;
    }
    
    //-----------------------------------------------------------
    
    public function delete($car) {
        return $this->HREF(Action::DELETE) . $this->hrefKeyParam($car) ;
    }
    
    public function createCurrent() {
        return $this->HREF(Action::CREATE) ;
    }
    
    public function deleteCurrent() {
        return $this->HREF(Action::DELETE) ;
    }
    
    public function updateCurrent() {
        return $this->HREF(Action::UPDATE) ;
    }
    
}

?>