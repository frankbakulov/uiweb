<?
class Redirect
{
    //написать проверку на протокол обращения
    public $host;

    public function __construct()
    {
        $this->host = "http://" . $_SERVER["HTTP_HOST"];
    }

    public function redirect($url = "")
    {
        //header('Status: 200 Ok');
        header("Location:" . $this->host . $url);
        exit();
    }

    public function auth()
    {
        header("Location:" . $this->host . "/user/login/");
        exit();
    }

    public function ErrorPage404()
    {
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        header("Location:" . $this->host . "/php/error/404");
        exit();
    }


}