<?php
class Message {
    
    const UNDEF  = "?";
    const OK     = "OK";
    const WARN   = "W";
    const ERR    = "E";
    
//     public static function CLASS( $type ) {
        
//         switch ( $type ) {
            
//             case Message::OK :
//                 return "alert alert-success" ;
                
//             case Message::WARN :
//                 return "alert alert-warning" ;
                
//             case Message::ERR :
//                 return "alert alert-danger" ;
                
//             default:
//                 return "alert alert-dark" ;
//         }
//     }
    
    private $text = "" ;
    private $type = "" ;
    
    /**
     * Constructor
     */
    public function __construct($text, $type=Message::UNDEF) {
        $this->text = $text ;
        $this->type = $type ;
    }
    
    public function text() {
        return $this->text;
    }
    
    public function __toString() {
        return $this->text;
    }
    
    /**
     * Returns the CSS class for 'Bootstrap' alert messages
     * @return string
     */
    public function css() {
    
        switch ( $this->type ) {
            
            case Message::OK :
                return "alert alert-success" ;
                
            case Message::WARN :
                return "alert alert-warning" ;
                
            case Message::ERR :
                return "alert alert-danger" ;
                
            default:
                return "alert alert-dark" ;
        }
    }
}

?>