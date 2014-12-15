<?
class Auth
{
    //функция проверки авторизованности
    static function isAuth()
    {
        session_start();

        //проверяем сессию
        if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
            return true;
        //проверяем куку
        }else if(isset($_COOKIE['auth'])){
            //режем куку
            $data = explode(':', $_COOKIE['auth']);

            //получаем логин
            $username = $data[0];
            //получаем hash
            $cookie_hash = $data[1];

            //получаем пользователя
            $user = new User();
            $user = $user->findByUsername($username);

            //получем hash пользователя
            $password_hash = $user->password;
            $cookie_hash_user = sha1($user->auth_key . ':' . $_SERVER['REMOTE_ADDR'] . ':' . $user->last_login_datetime . ':' . $password_hash);

            //проверям есть ли такой пользователь и совпадаeт ли hash
            if($user && $cookie_hash == $cookie_hash_user){
                //логиним пользователя по куке
                static::loginByName($user->username);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    static function login($username, $password)
    {
        session_start();
        $user = new User();
        $password_hash = sha1($password);

        //текущая дата
        $current_time = date('Y-m-d H:i:s', time());

        //ищем пользователя по логину и паролю
        $user = $user->findUser($username, $password_hash);

        //проверка нашёлся ли пользователь
        if($user){
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = $user->username;


            //устанавливаем куку
            $auth_key = uniqid();
            setcookie('auth', $user->username . ':' . sha1($auth_key . ':' . $_SERVER['REMOTE_ADDR'] . ':' . $current_time . ':' . $password_hash), time() + 60*60*60*24, "/");

            //записываем данные в пользователя для дальнейшей авторизации по куке
            $user->last_login_datetime = $current_time;
            $user->auth_key = $auth_key;
            $user->save();

            return $user->id;
        }else{
            $_SESSION['auth'] = 0;
            return false;
        }
    }

    static function loginByName($username)
    {
        session_start();
        $user = new User();

        //текущая дата
        $current_time = date('Y-m-d H:i:s', time());

        //ищем пользователя по логину
        $user = $user->findByUsername($username);

        //проверка нашёлся ли пользователь
        if($user){
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = $user->username;

            //записываем данные в пользователя для дальнейшей авторизации по куке
            $auth_key = uniqid();
            setcookie('auth', $user->username . ':' . sha1($auth_key . ':' . $_SERVER['REMOTE_ADDR'] . ':' . $current_time . ':' . $user->password), time() + 60*60*24, "/");

            //записываем данные в пользователя для дальнейшей авторизации по куке
            $user->last_login_datetime = $current_time;
            $user->auth_key = $auth_key;
            $user->save();

            return $user->id;
        }else{
            $_SESSION['auth'] = 0;
            return false;
        }
    }

    static function logout()
    {
        session_start();
        setcookie('auth', null, 0, "/");
        session_destroy();
    }

    static function getUserField($field)
    {
        if(static::isAuth()){
            $user = new User();
            $result = $user->findByUsername($_SESSION['username'])->$field;

            return $result;
        }else{
            return false;
        }
    }
}