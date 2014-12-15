<?

class FormFeedback extends Model
{
    public $name;
    public $email;
    public $phone;
    public $topic;
    public $text;
    public $created;

    public function save($id = false)
    {
        $this->validate();
        if(count($this->validation->errorArray)){
            return ['result' => 'error', 'errors' => $this->validation->errorArray];
        }else{
            $this->beforeSave();

            $this->insert($this->getTable())->execute();
            return ['result' => 'success'];
        }
    }

    public function beforeSave()
    {
        $topic_values = ['website', 'apps', 'seo'];

        foreach($this->topic as $k => $v){
            $this->topic[$k] = str_replace($v, array_search($v, $topic_values), $v);
        }
        $this->topic = implode(",", $this->topic);
        $this->created = date('Y-m-d H:i:s', time());
    }

    public function validate()
    {
        $this->name = trim($_REQUEST['name']);
        $this->email = trim($_REQUEST['email']);
        $this->phone = trim($_REQUEST['phone']);
        $this->topic = $_REQUEST['topic'];
        $this->text = trim($_REQUEST['text']);

        //имя
        $this->validation->validateEmpty($this->name, 'name', "Напишите, как к вам можно обращаться");

        //почта
        $this->validation->validateEmailPattern($this->email, 'email', "Адрес электронной почты не соответствует формату");
        $this->validation->validateEmpty($this->email, 'email', "Напишите адрес электронной почты и мы напишем вам");

        //телефон
        //$this->validation->validatePattern($this->phone, 'phone', '#^\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$#', 'Телефон не соответствует формату.');
        $this->validation->validateEmpty($this->phone, 'phone', "Напишите номер телефона и мы мы позвоним вам");

        //тема
        $this->validation->validateEmpty($this->topic, 'topic[]', "Выберите тему вопроса");

        //текст
        $this->validation->validateEmpty($this->text, 'text', "Расскажите нам о своём проекте");
    }
}