<?
class MainController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "main";
        $this->view->description = "UIweb.ru осуществляет разработку веб-сайтов с использованием современных CMS и фреймворков";
        $this->view->keywords = "разработка сайты php javascript html";
        $this->view->title = "UIweb - разработка веб-сайтов";

        $this->view->render($this->layout);
    }

    public function actionContacts()
    {
        $this->layout = "inner";
        $this->view->description = "UIweb.ru контакты";
        $this->view->keywords = "разработка сайты php javascript";
        $this->view->title = "UIweb - контакты";

        $this->view->render($this->layout);
    }

    public function actionServices()
    {
        $this->layout = "inner";
        $this->view->description = "UIweb.ru услуги";
        $this->view->keywords = "парсер сайт cms bitrix umi wordpress";
        $this->view->title = "UIweb - контакты";

        $this->view->render($this->layout);
    }

    public function actionTypography()
    {
        $this->layout = "typography";
        $this->view->description = "UIweb.ru типографика";
        $this->view->keywords = "типографика";
        $this->view->title = "UIweb - типографика";

        $this->view->render($this->layout);
    }
}