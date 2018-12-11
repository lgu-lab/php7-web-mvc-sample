<?php
class Logger {
    
    public static $ON = true ; // Logger state ON/OFF
    
    public static function LOG($message, $data=NULL) {
        if ( Logger::$ON ) {
            $output = "";
            if ( $data != NULL ) {
                if ( is_array( $data ) ) {
                    $output = "data (array) : " . implode( ',', $data);
                }
                else {
                    $output = "data : " . $data;
                }
            }
            echo "<script>console.log( 'LOG : " . $message . $output . "' );</script>" . PHP_EOL ;
        }
    }
    
    //  var_dump($cars);
    //  print_r($arrayInSession);
    
}
?>