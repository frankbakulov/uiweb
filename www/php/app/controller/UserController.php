<?

class UserController extends Controller
{
    public $layout = "inner";

    public function actionIndex()
    {
        $user = new User();
        $users = $user->findAll();
        $this->render($this->layout, $users);
    }

    public function actionView($id)
    {
        $user = new User();
        $user = $user->findById($id);
        $this->render($this->layout, $user);
    }

    public function actionRegister()
    {
        $this->view->render($this->layout);
    }

    public function actionLogin()
    {
        if(Auth::isAuth()){
            $this->redirect->redirect();
        }else{
            $this->render($this->layout);
        }
    }

    public function actionLogout()
    {
        Auth::logout();
        $this->redirect();
    }
}