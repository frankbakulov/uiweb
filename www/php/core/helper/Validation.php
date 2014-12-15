<?php

//написать URL multicheckbox unique
class Validation
{
    public $errorArray = array();

    public function validateEmpty($value, $keyname, $error_message = 'Введите же что-нибудь')
    {
        if(empty($value)){
            $this->errorArray[$keyname] = $error_message;
        }
    }

    public function validatePattern($value, $keyname, $pattern, $error_message = 'Допускаются только символы латинского алфавита и цифры')
    {
        if(!preg_match($pattern, $value)){
            $this->errorArray[$keyname] = $error_message;
        }
    }

    public function validateLength($value, $keyname, $length, $error_message = 'Не более 32 символов')
    {
        if(strlen($value) > $length){
            $this->errorArray[$keyname] = $error_message;
        }
    }

    public function validateUnique($value, $keyname, $field, $current_value = false, $error_message = 'Данное значение не уникально')
    {

    }

    public function validateEmailPattern($value, $keyname, $error_message = 'Адрес электронной почты не соотвествует формату')
    {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
            $this->errorArray[$keyname] = $error_message;
        }
    }

    public function validateIP4Pattern($value, $keyname, $error_message = 'IP адрес не соответствует формату')
    {
        if(!filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
            $this->errorArray[$keyname] = $error_message;
        }
    }

    public function validateIP6Pattern($value, $keyname, $error_message = 'IP адрес не соответствует формату')
    {
        if(!filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
            $this->errorArray[$keyname] = $error_message;
        }
    }

    public function validateCompare($value1, $value2, $keyname1, $keyname2, $error_message = 'Введенные пароли не совпадают')
    {
        if($_REQUEST[$keyname1] != $_REQUEST[$keyname2]){
            $this->errorArray[$keyname1] = $error_message;
            $this->errorArray[$keyname2] = $error_message;
        }
    }

    function validateCheckbox($value, $keyname, $error_message = 'Необходимо ознакомиться с условиями оферты')
    {
        if($_REQUEST[$keyname] != $value){
            $this->errorArray[$keyname] = $error_message;
        }
    }

    //если self будет true, то будет проверка на сравнение с текущим именем пользователя
    //убрать повторяющиеся строки
    /*public function validateName($keyname, $current_name)
    {
        $name = strip_tags(trim($_REQUEST[$keyname]));

        $this->validateEmpty($name, $keyname);
        $this->validatePattern($name, $keyname, '#^[0-9a-zA-Z_ ]+$#', 'Не допускаются набранные символы');
        $this->validateLength($name, $keyname, 32);
        $this->validateUnique($name, $keyname, '_name', $current_name, 'Пользователь с таким логином уже зарегистрирован');
    }

    function validateEmail($keyname, $current_email)
    {
        $email = strip_tags(trim($_REQUEST[$keyname]));

        $this->validateUnique($email, $keyname, 'email', $current_email, 'Пользователь с такой электронной почтой уже существует');
        $this->validateLength($email, $keyname, 32);
        $this->validateEmailPattern($email, $keyname);
        $this->validateEmpty($email, $keyname);
    }*/

    /*function validatePhone($keyphone, $current_phone)
    {
        $phone = strip_tags(trim($_REQUEST[$keyphone]));

        $this->validateUnique($phone, $keyphone, 'phone_preferred', $current_phone, 'Пользователь с таким телефоном уже существует');
        $this->validatePattern($phone, $keyphone, '#^\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$#', 'Телефон не соответствует формату. Пример: +7-964-789-01-25');
        $this->validateEmpty($phone, $keyphone);
    }*/

    /*function validatePassword($keyname1, $keyname2)
    {
        $password = strip_tags(trim($_REQUEST[$keyname1]));
        $password_repeat = strip_tags(trim($_REQUEST[$keyname2]));

        $this->validateEmpty($password, $keyname1, 'Пожалуйста, введите пароль');
        $this->validateCompare($password, $password_repeat, $keyname1, $keyname2);
    }*/


    /*function validateRegistration($keyname, $keyemail, $keypassword, $keypassword_repeat, $checkbox)
    {
        $this->validateName($keyname);
        $this->validateEmail($keyemail);
        $this->validatePassword($keypassword, $keypassword_repeat);
        //$this->validateCheckbox($checkbox);

        return $this->errorArray;
    }*/

    /*function validateUpdateProfile($keyname, $keyemail, $keyphone)
    {
        $this->validateName($keyname, $user->_name);
        $this->validateEmail($keyemail, $user->email);
        $this->validatePhone($keyphone, $user->phone_preferred);

        return $this->errorArray;
    }

    function validateEmailAndPhone($keyemail, $keyphone)
    {
        $this->validateEmail($keyemail, $user->email);
        $this->validatePhone($keyphone, $user->phone_preferred);

        return $this->errorArray;
    }*/

}