<?
class ProjectController extends Controller
{
    public $layout = "inner";

    public function actionIndex()
    {
        if(Auth::isAuth()){
            $users_project = new UsersProject();
            $users_projects = $users_project->findOwn()->all()->getId();

            if(is_array($users_projects)){
                $project = new Project();
                $projects = $project->findById($users_projects)->all()->getResult();

                $model['projects'] = $projects;
                $this->view->render($this->layout, $model);
            }
        }else{
            $this->redirect->auth();
        }
    }

    public function actionView($id)
    {
        if(Auth::isAuth()){
            $project = new Project();
            $project = $project->findById($id)->one()->getResult();

            $this->view->title = $project->name;
            $this->view->keywords = $project->name;
            $this->view->description = $project->name;

            $projects_passwords = new ProjectsPassword();
            $projects_passwords = $projects_passwords->findByField($id, 'project_id')->all()->getField('password_id');

            $project_passwords = new ProjectPassword();
            $project_passwords = $project_passwords->findById($projects_passwords)->all()->getResult();

            $model['project'] = $project;
            $model['project_passwords'] = $project_passwords;

            $this->view->render($this->layout, $model);
        }else{
            $this->redirect->auth();
        }
    }

    public function actionAdd()
    {

    }

    public function actionUpdate()
    {

    }

    public function actionDelete()
    {

    }

}