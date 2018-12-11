<?php
require_once 'commons/AbstractController.php';
require_once 'commons/Logger.php';
require_once 'commons/FormMode.php';
require_once 'commons/Message.php';

require_once 'entities/Car.php';
require_once 'dao/CarDao.php';
require_once 'controller/CarHref.php';

/**
 * Controller for entity 'Car'
 * 
 * @author Telosys Code Generator
 *
 */
class CarController extends AbstractController
{
    private $dao;

    /**
     * Constructor
     */
    public function __construct() {
        Logger::LOG("CarController: __construct()");
        parent::__construct(new CarHref());        
        $this->dao = new CarDao();
    }
    
    /**
     * Renders a UI LIST PAGE using the given objects
     * @param array  $list the list to be shown 
     * @param string $msg  the message to be printed
     */
    private function renderList($list, $msg) {
        if ( isset($msg) && isset($list) ) {
            // Variables exposed and usable in the view : $list, $msg, $href
            $href = $this->getHREF();
            require 'view/carList.php';
        }
        else {
            $this->error("renderList(..,..) : 'msg' and/or 'list'  undefined");
        }
    }
    
    /**
     * Renders a UI FORM PAGE in 'UPDATE' mode
     * @param object $car
     * @param string $msg
     */
    private function renderFormForUpdate($car, $msg) {
        // Variables exposed and usable in the view : $car, $msg, $href, $formMode
        $formMode = FormMode::UPDATE ;
        $href = $this->getHREF();
        require 'view/carForm.php';
    }
    
    /**
     * Renders a UI FORM PAGE in 'CREATE' mode
     * @param object $car
     * @param string $msg
     */
    private function renderFormForCreate($car, $msg) {
        // Variables exposed and usable in the view : $car, $msg, $href, $formMode
        $formMode = FormMode::CREATE ;
        $href = $this->getHREF();
        require 'view/carForm.php';
    }
    
    /**
     * Builds a new entity instance using the given request data
     * @param $requestData
     * @return Car
     */
    private function buildEntity($requestData) {
        $o = new Car();
        $o->setId( $requestData['id'] );
        $o->setName( $requestData['name'] );
        $o->setYear( $requestData['year'] );
        $o->setPrice( $requestData['price'] );
        $o->setBrand( $requestData['brand'] );
        $o->setDriver( $requestData['driver'] );
        return $o;
    }
    
    /**
     * Validates the entity's data
     * @param Car $car
     * @return string|NULL
     */
    private function validate(Car $car) {
        if ( $car->getId() == NULL ) return "Id is null" ;
        if ( ! ctype_digit ($car->getId() ) ) return "Id is not an integer" ;
        if ( ! ctype_digit ($car->getYear() ) ) return "Year is not an integer" ;
        return null ;
    }
    
    /**
     * Validates the request parameters composing the entity's key
     * @param array $requestData
     * @return string|NULL
     */
    private function validateKey($requestData) {
        Logger::LOG("CarController: validateKey()", $requestData);
        if ( ( $m = $this->checkInteger($requestData['id'], "id") ) != null ) return $m ;
        return null ;
    }
    
    //----------------------------------------------------------------------
    
    /**
     * {@inheritDoc}
     * @see AbstractController::list()
     */
    public function list($requestData) {
        Logger::LOG("CarController: list()", $requestData);
        $list = $this->dao->findAll();        
        Logger::LOG("CarController: list() DAO result : ", $list);
        $this->renderList($list, ""); // OK
    }
    
    /**
     * {@inheritDoc}
     * @see AbstractController::formForCreate()
     */
    public function formForCreate() {
        Logger::LOG("CarController: formForCreate()");
        $car = new Car();
        $this->renderFormForCreate($car, "");
    }
    
    /**
     * {@inheritDoc}
     * @see AbstractController::formForUpdate()
     */
    public function formForUpdate($requestData) {
        Logger::LOG("CarController: formForUpdate()", $requestData);
        $errMsg = $this->validateKey($requestData);
        if ( $errMsg == NULL ) {
            // Validation OK
            $car = $this->dao->findById($requestData['id']);
            if ( $car != null ) {
                // Found
                $this->renderFormForUpdate($car, ""); // OK, switch to 'update' form
            }
            else {
                // Unexpected error
                $this->error("Car not found !");
            }
        }
        else {
            // Unexpected error
            $this->error($errMsg);
        }
    }

    /**
     * {@inheritDoc}
     * @see AbstractController::create()
     */
    public function create($requestData) {
        Logger::LOG("CarController: create()", $requestData);
        $car = $this->buildEntity($requestData);
        $errMsg = $this->validate($car);
        if ( $errMsg == NULL ) {
            // Validation OK
            if ( $this->dao->create($car) ) {
                $msg = new Message( "Car '" . $car->getId() . "' created", Message::OK  );
            $this->renderFormForUpdate($car, $msg); // Switch to the 'update' form
            }
            else {
                $msg = new Message( "Car '" . $car->getId() . "' not created", Message::WARN );
                $this->renderFormForCreate($car, $msg); // Stay on the 'create' form
            }
        }
        else {
            $msg = new Message($errMsg, Message::ERR );
            $this->renderFormForCreate($car, $msg); // Stay on the 'create' form
        }
    }
    
    /**
     * {@inheritDoc}
     * @see AbstractController::update()
     */
    public function update($requestData) {
        Logger::LOG("CarController: update()", $requestData);
        $car = $this->buildEntity($requestData);
        $errMsg = $this->validate($car);
        if ( $errMsg == NULL ) {
            // Validation OK 
            if ( $this->dao->update($car) ) {
                $msg = new Message( "Car '" . $car->getId() . "' updated", Message::OK ) ;
            }
            else {
                $msg = new Message( "Car '" . $car->getId() . "' not found", Message::WARN ) ;
            }
        }
        else {
            $msg = new Message($errMsg, Message::ERR );
        }
        $this->renderFormForUpdate($car, $msg);
    }

    /**
     * {@inheritDoc}
     * @see AbstractController::delete()
     */
    public function delete($requestData) {
        Logger::LOG("CarController: delete()", $requestData);
        $id = $requestData['id'];
        if ( $this->dao->delete($id) ) {
            $msg = new Message("Car '" . $id . "' deleted", Message::OK ) ;
        }
        else {
            $msg = new Message("Car '" . $id . "' not found", Message::WARN ) ;
        }
        // Swith to list page
        $list = $this->dao->findAll();
        $this->renderList($list, $msg); 
    }

}
?>