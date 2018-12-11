<?php
// PHP Car Entity Class
class Car //implements JsonSerializable
{
    private $id; // int
     private $name; // string
     private $year; // short
     private $price; // float
     private $brand; // ref Brand 
     private $driver; // ref Driver
         
     /**
      * Constructor
      */
     public function __construct() {
         $this->id = "";
         $this->name = "";
         $this->year = "";
         $this->price = "";
         $this->brand = "";
         $this->driver = "";
     }
     
//     public function __construct( $id, $name, $year, $price, $brand, $driver ) {
//     	$this->id = $id;
//     	$this->name = $name;
//     	$this->year = $year;
//     	$this->price = $price;
//     	$this->brand = $brand;
//     	$this->driver = $driver;
//      }

//      /**
//       * Pseudo constructor 
//       * @return Car
//       */
//      public static function newVoid() {
//          return new Car();
//      }
     
//      /**
//       * Pseudo constructor with parameters 
//       * @return Car
//       */
//      public static function newInit($id, $name, $year, $price, $brand, $driver ) {
//          $o = new Car();
//          $o->id = $id;
//          $o->name = $name;
//          $o->year = $year;
//          $o->price = $price;
//          $o->brand = $brand;
//          $o->driver = $driver;
//          return $o;
//      }
     
     public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }


    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }


    public function getYear() {
        return $this->year;
    }
    public function setYear($year) {
        $this->year = $year;
    }


    public function getPrice() {
        return $this->price;
    }
    public function setPrice($price) {
        $this->price = $price;
    }


    public function getBrand()
    {
        return $this->brand;
    }
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }


    public function getDriver()
    {
        return $this->driver;
    }
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    public function __toString(){
        $result = '';
        $result .= ' id:' . $this->id ;
        $result .= ' name:' . $this->name;
        // TODO : etc
        return $result;
    }
    
// 	public function jsonSerialize()
//     {
//         return
//             [
// 				'id' => $this->getId(), 'name' => $this->getName(), 'year' => $this->getYear(), 'price' => $this->getPrice(), 'brand' => $this->getBrand(), 'driver' => $this->getDriver()
//             ];
//     }
}