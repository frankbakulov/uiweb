<?
class Decorator
{
    private $obj;

    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    function __call($method_name, $args){
        //echo 'Calling method ',$method_name,'<br />';
        //return call_user_func_array(array($this->obj, $method_name), $args);
    }
}