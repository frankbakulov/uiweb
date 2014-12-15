<?
class Autoloader {
    public static $loader;

    public static function init()
    {
        if(self::$loader == NULL){
            self::$loader = new self();
        }

        return self::$loader;
    }

    public function __construct()
    {
        spl_autoload_register([$this,'core']);
        spl_autoload_register([$this,'coreDb']);
        spl_autoload_register([$this,'coreModel']);
        spl_autoload_register([$this,'coreView']);
        spl_autoload_register([$this,'coreController']);
        spl_autoload_register([$this,'coreHelper']);
        spl_autoload_register([$this,'coreComponent']);

        spl_autoload_register([$this,'appModel']);
        spl_autoload_register([$this,'appController']);
        spl_autoload_register([$this,'appForm']);
    }

    public function getFolder($class)
    {
        return Inflector::underscore($class);
    }

    public function core($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/core/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/core/" . $class . ".php";
        }
    }

    public function coreDb($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/core/db/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/core/db/" . $class . ".php";
        }
    }

    public function coreModel($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/core/model/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/core/model/" . $class . ".php";
        }
    }

    public function coreView($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/core/view/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/core/view/" . $class . ".php";
        }
    }

    public function coreController($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/core/controller/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/core/controller/" . $class . ".php";
        }
    }

    public function coreHelper($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/core/helper/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/core/helper/" . $class . ".php";
        }
    }

    public function coreComponent($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/core/component/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/core/component/" . $class . ".php";
        }
    }

    public function appModel($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/app/model/" . Inflector::underscore($class) ."/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/app/model/" . Inflector::underscore($class) ."/" . $class . ".php";
        }
    }

    public function appController($class)
    {
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/app/controller/" . $class . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/app/controller/" . $class . ".php";
        }
    }

    public function appForm($class)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/app/model/form/" . $class . ".php")) {
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/app/model/form/" . $class . ".php";
        }
    }
}