<?

abstract class Controller
{
    public $layout = "main";
    public $view;
    public $model;
    public $action;

    public function __construct($model, $action)
    {
        $this->view = new View($model, $action);
        $this->redirect = new Redirect();
    }

    public function actionIndex()
    {

    }

    public function actionView($id)
    {

    }

    public function actionDelete($id)
    {

    }

    public function actionCreate()
    {

    }

    public function actionUpdate($id)
    {

    }

    /**
     *
     */
    public function render($layout, $data = false)
    {
        $this->view->render($layout, $data);
    }

    public function redirect($path = '')
    {
        $this->redirect->redirect($path);
    }
}