<?
class View
{
    public $content;
    public $result;
    public $description;
    public $keywords;
    public $title;
    public $model;
    public $action;

    public function __construct($model, $action)
    {
        $this->model = $model;
        $this->action = $action;
    }

    public function getDescription()
    {
        echo "<meta name='description' content='" . $this->description . "'>";
    }

    public function getKeywords()
    {
        echo "<meta name='keywords' content='" . $this->keywords . "'>";
    }

    public function getTitle()
    {
        echo "<title>" . $this->title . "</title>";
    }

    public function body(){

    }

    public function bodyEnd()
    {

    }

    public function header()
    {

    }

    public function headerEnd()
    {

    }

    public function render($layout, $data = false)
    {
        ob_start();

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/app/view/" . $this->model . "/" . $this->action . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/app/view/" . $this->model . "/" . $this->action . ".php";
        }else{
            die('Не найден вид контроллера');
        }

        $this->content = ob_get_contents();

        ob_end_clean();

        ob_start();

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/app/layout/" . $layout . ".php")){
            require_once $_SERVER['DOCUMENT_ROOT'] . "/php/app/layout/" . $layout . ".php";
        }else{
            die('Не найден шаблон');
        }

        $this->result = ob_get_contents();

        ob_end_clean();

        echo $this->result;
    }
}