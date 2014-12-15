<?
class AjaxController extends Controller
{
    public $layout = "ajax";

    public function actionFormRegister()
    {
        $this->view->render($this->layout);
    }

    public function actionFormLogin()
    {
        $this->view->render($this->layout);
    }

    public function actionFormFeedback()
    {
        $this->view->render($this->layout);
    }

    public function actionProjectPassword()
    {
        $this->view->render($this->layout);
    }
}