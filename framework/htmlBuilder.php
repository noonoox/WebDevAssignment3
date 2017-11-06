<?php 
class htmlBuilder {
    public $document;
    function __construct() {
       // todo
   }
}
class domObject {
    private $name;
    private $
    private $attributes;
    public $children;
    function toString() {
        if($name != "textnode") {
            $string = "<" . $name;
            foreach ($attributes as $key => $value) {
                $string .= " $key=\"$value\"";
            }
            $string .= ">";
        } else {
            $string  
        }
    }
}
?>
