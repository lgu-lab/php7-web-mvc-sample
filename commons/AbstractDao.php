<?php

require_once 'commons/Logger.php';

abstract class AbstractDao
{
    private $LISTNAME = "xxx" ;
    
    /**
     * Constructor
     * @param string $listName
     */
    public function __construct($listName) {
        $this->LISTNAME = $listName ;
        session_start();
        if( ! isset($_SESSION[$this->LISTNAME]) ) {
            $_SESSION[$this->LISTNAME] = [];
        }
    }

    //----------------------------------------------------------------------------------------
    
    /**
     * Builds a unique ID stored in a string
     * @param object $entity
     */
    abstract protected function buildIdStringFromEntity($entity) ;
    
    //----------------------------------------------------------------------------------------

    private function addEntry($entity) {
        Logger::LOG("AbstractDao: addEntry(entity)");
        array_push($_SESSION[$this->LISTNAME], clone $entity); 
    }
    private function removeEntry($key) {
        Logger::LOG("AbstractDao: removeEntry(" . $key . ")");
        unset($_SESSION[$this->LISTNAME][$key]);
    }
    private function replaceEntry($key, $entity) {
        Logger::LOG("AbstractDao: replaceEntry(" . $key . ", entity)");
        $_SESSION[$this->LISTNAME][$key] = clone $entity ;
    }
    
    /**
     * Returns all entities
     * @return array
     */
    protected function findAllInSession() {
        Logger::LOG("AbstractDao: getAllInSession()");
        return $_SESSION[$this->LISTNAME];
    }
    
    /**
     * Tries to find the given entity
     * @param object $entity
     * @return object|NULL
     */
    protected function findInSession($entity) {
        Logger::LOG("AbstractDao: findInSession(" . $entity . ")");
        return $this->findByIdInSession( $this->buildIdStringFromEntity($entity) ) ;
    }
    
    /**
     * Tries to find the entity for the given ID
     * @param string $idString
     * @return object|NULL
     */
    protected function findByIdInSession(string $idString) {
        Logger::LOG("AbstractDao: findByIdInSession(" . $idString .")");
        foreach( $_SESSION[$this->LISTNAME] as $entry ) {
            if ( $this->buildIdStringFromEntity($entry) === $idString ) {
                return $entry ;
            }
        }
        return null ;
    }
    
    /**
     * Returns TRUE if the given entity exists
     * @param object $entity
     * @return boolean
     */
    protected function existsInSession($entity) {
        Logger::LOG("AbstractDao: existsInSession(" . $entity . ")");
        return $this->findInSession($entity) != null ? true : false ;
    }
    
    /**
     * Creates the given entity if it doesn't exist
     * @param object $entity
     * @return boolean TRUE if not found and created, FALSE if already exists
     */
    protected function createInSession($entity) {
        Logger::LOG("AbstractDao: createInSession(" . $entity .")" );
        if ( $this->existsInSession($entity) ) {
            // Already exists
            return false ;
        }
        else {
            // Doesn't exist : create it
            $this->addEntry( $entity);
            return true ;
        }
    }
    
    /**
     * Deletes the entity associated with the given ID string 
     * @param string $idString
     * @return boolean TRUE if found and deleted, FALSE if not found
     */
    protected function deleteInSession(string $idString) {
        Logger::LOG("AbstractDao: deleteInSession(" . $idString .")");
        foreach( $_SESSION[$this->LISTNAME] as $key => $entry ){
            if ( $this->buildIdStringFromEntity($entry) === $idString ) {
                // Found : remove from array
                $this->removeEntry($key);
                return true ;
            }
        }
        return false ;
    }
    
    /**
     * Updates the given entity if it exists
     * @param object $entity
     * @return boolean TRUE if found and updated, FALSE if not found
     */
    protected function updateInSession($entity) {
        Logger::LOG("AbstractDao: updateInSession(" . $entity .")" );
        $idString = $this->buildIdStringFromEntity($entity) ;
        foreach( $_SESSION[$this->LISTNAME] as $key => $entry ){
            if ( $this->buildIdStringFromEntity($entry) === $idString ) {
                // Found : replace in array
                $this->replaceEntry($key, $entity);
                return true ;
            }
        }
        return false ;
    }
    
}
