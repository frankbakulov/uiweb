<?
class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = "Main";
        $action_name = "Index";
        $model = "main";
        $action = "index";

        $routes = explode("/", $_SERVER["REQUEST_URI"]);

        // получаем имя контроллера
        if(isset($routes[1]) && !empty($routes[1]))
        {
            //роутинг для красивых урлов
            /*if($routes[1] == ''){

            }*/





            $controller_name = $routes[1];
            $model = $controller_name;
            $controller_name = ucfirst($controller_name);
        }

        // получаем имя экшена
        if(isset($routes[2]) && !empty($routes[2]))
        {
            $action_name = $routes[2];
            $action = $action_name;
            //режем слова по '-'
            $action_words = explode('-', $action_name);

            //проверяем сколько слов
            if(count($action_words) > 1){
                $action_name = '';
                foreach($action_words as $action_word){
                    $action_name .= ucwords($action_word);
                }
            }else{
                $action = $action_name;
                $action_name = ucwords($action_name);
            }
        }

        //проверяем есть ли третий параметр
        if(isset($routes[3]))
        {
            $id = $routes[3];
        }

        // добавляем префиксы
        $model_name = $controller_name;
        $controller_name = $controller_name . "Controller";
        $action_name = "action" . $action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = $model_name . ".php";
        $model_path = $_SERVER['DOCUMENT_ROOT'] . "/php/app/model/" . $model_file;

        if(file_exists($model_path))
        {
            require_once "/php/app/model/" . $model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = $controller_name . ".php";
        $controller_path = $_SERVER['DOCUMENT_ROOT'] . "/php/app/controller/" . $controller_file;

        if(file_exists($controller_path)){
            require_once $controller_path;
        }else{
            //(new Redirect())->ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name($model, $action);
        $action = $action_name;

        if(method_exists($controller, $action)){
            // вызываем действие контроллера
            if(isset($id)){
                $controller->$action($id);
            }else{
                $controller->$action();
            }
        }else{
            //(new Redirect())->ErrorPage404();
        }

    }
}