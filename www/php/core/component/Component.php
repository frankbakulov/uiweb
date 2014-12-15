<?
class Component
{
    static public function render($folder, $view, $data = false)
    {
        ob_start();

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/php/app/component/" . $folder . "/" . $view . ".php")){
            require $_SERVER['DOCUMENT_ROOT'] . "/php/app/component/" . $folder . "/" . $view . ".php";
        }else{
            die('Не найден вид компонента');
        }

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }
}