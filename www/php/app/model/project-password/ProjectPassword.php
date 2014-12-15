<?
class ProjectPassword extends Model
{
    public $name;
    public $url;
    public $description;
    public $login;
    public $password;

    //связанные параметры
    public $project_id;

    public function save($id = false)
    {
        $this->validate();

        $this->beforeSave();

        if ($this->id) {
            $saved = $this->update()->where($this->id)->execute();
        } else {
            $saved = $this->insert()->execute(true);

            //пишем связанную запись
            $this->afterSave();
        }

        return ['result' => 'success', 'fields' => $this];
    }


    public function validate()
    {
        $this->project_id = trim($_REQUEST['project_id']);
        $this->id = trim($_REQUEST['id']);
        $this->name = trim($_REQUEST['name']);
        $this->url = trim($_REQUEST['url']);
        $this->description = trim($_REQUEST['description']);
        $this->login = trim($_REQUEST['login']);
        $this->password = trim($_REQUEST['password']);
    }

    public function afterSave()
    {
        $projects_password = new ProjectsPassword();
        $projects_password->project_id = $this->project_id;
        $projects_password->password_id = $this->id;
        $projects_password->save();
    }


}