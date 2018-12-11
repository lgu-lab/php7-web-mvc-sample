<?php

require_once 'commons/Logger.php';
require_once 'commons/AbstractDao.php';
require_once 'entities/Car.php';

/**
 * D.A.O. for entity 'Car'
 * 
 * @author Telosys Code Generator
 *
 */
class CarDao extends AbstractDao
{
    /**
     * Constructor
     */
    public function __construct() {
        Logger::LOG("CarDao: __construct()");
        parent::__construct('carMemoryPersist');
    }
    
    //----------------------------------------------------------------------------------------
    
    private function log($msg) {
        Logger::LOG("CarDao: " . $msg);
    }
    
    /**
     * @param $id
     * @return string
     */
    private function buildIdString($id) {
    // private function buildIdString($id, $aa, $bb) {
        return "" . $id ;
        //return "". $id . "|" . $aa . "|" . $bb ;
    }
    
    //----------------------------------------------------------------------------------------
    
    /**
     * Abstract implementation
     * {@inheritDoc}
     * @see AbstractDao::buildIdStringFromEntity()
     */
    protected function buildIdStringFromEntity($car) {
        return $this->buildIdString($car->getId());
        // return $this->buildIdString($car->getId(), $car->getXxx());
    }
    
    //----------------------------------------------------------------------------------------
    
    /**
     * Returns true if the given entity exists 
     * @param Car $car
     * @return boolean
     */
    public function exists(Car $car) {
        $this->log("exists()");
        return $this->existsInSession($car);
    }
    
    /**
     * Returns an array containing all the entities 
     * @return array
     */
    public function findAll() {
        $this->log("findAll()");
        return $this->findAllInSession();
    }

    /**
     * Get one entity by Id
     * @param $id
     * @return string
     */
    public function findById($id) {
        $this->log("findById()");
        return $this->findByIdInSession( $this->buildIdString($id) );
    }

    /**
     * Creates the given entity if it doesn't exist
     * @param Car $car
     * @return boolean true if created, false if already exist
     */
    public function create(Car $car) {
        $this->log("create()");
        return $this->createInSession($car);
    }
    
    /**
     * Updates the given entity 
     * @param Car $car
     * @return boolean true if found and updated, false if not found
     */
    public function update(Car $car) {
        $this->log("update()");
        return $this->updateInSession($car);
    }

    /**
     * Deletes the entity associated with the given id 
     * @param $id
     * @return boolean true if found and deleted, false if not found
     */
    public function delete($id) {
        $this->log("delete()");
        return $this->deleteInSession( $this->buildIdString($id) ) ; 
    }
    
}
