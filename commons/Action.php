<?php
class Action {
    
    //private static $PARAMNAME = "_action_";
    const PARAMNAME = "_action_";
    
    const LIST        = "list";
    const FORM_UPDATE = "form_update";
    const FORM_CREATE = "form_create";
    const CREATE      = "create";
    const UPDATE      = "update";
    const DELETE      = "delete";
    
    public static function HREF($entityName, $action) {
        if ( ! isset ($action) ) {
            throw new Exception("Action::HREF() parameter is null");
        }
        return $entityName . ".php?" . Action::PARAMNAME . "=" . $action ;
    }
}

?>