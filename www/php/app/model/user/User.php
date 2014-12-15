<?
class User extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $auth_key;
    public $permission;
    public $status;
    public $last_login_datetime;
    public $created;
    public $modified;

    public function findByUsername($username)
    {
        return $this->findByField($username, 'username')->one()->getResult();
    }

    public function findUser($username, $password)
    {
        //написать защищённый запрос
        return $this->sql("SELECT * FROM `users` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "' ")->execute()->one()->getResult();
    }

    public function register()
    {
        $this->validateRegister();

        $this->permission = 0;
        $this->status = 0;
        $this->created = date('Y-m-d H:i:s', time());
        $this->password = sha1($this->password);

        if(count($this->validation->errorArray)){
            return ['result' => 'error', 'errors' => $this->validation->errorArray];
        }else{
            //нельзя сохранять через save
            $this->insert($this->getTable())->execute(true);
            Auth::loginByName($this->username);
            return ['result' => 'success'];
        }
    }

    public function login()
    {
        $this->validateLogin();

        if(count($this->validation->errorArray)){
            return ['result' => 'error', 'errors' => $this->validation->errorArray];
        }else{
            if(Auth::login($this->username, $this->password)){
                return ['result' => 'success'];
            }else{
                return ['result' => 'error', 'errors' => ['auth' => 'Неверная комбинация логина и пароля']];
            }
        }
    }


    public function beforeSave()
    {

    }

    public function validateRegister()
    {
        $this->username = trim($_REQUEST['username']);
        $this->email = trim($_REQUEST['email']);
        $this->password = trim($_REQUEST['password']);
        $this->password_repeat = trim($_REQUEST['password_repeat']);

        //имя
        $this->validation->validateUnique($this->username, 'username', "Придумайте логин");
        $this->validation->validateLength($this->username, 'username', 50, "Придумайте логин");
        $this->validation->validateEmpty($this->username, 'username', "Придумайте логин");

        //email
        $this->validation->validateEmailPattern($this->email, 'email', "Придумайте логин");

        //password
        $this->validation->validateCompare($this->password, $this->password_repeat, 'password', 'password_repeat');
        $this->validation->validateEmpty($this->password, 'password', "Придумайте пароль");
    }

    public function validateLogin()
    {
        $this->username = trim($_REQUEST['username']);
        $this->password = trim($_REQUEST['password']);

        $this->validation->validateEmpty($this->username, 'username', "Введите логин");
        $this->validation->validateEmpty($this->password, 'password', "Введите пароль");
    }
}