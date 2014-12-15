<?
class Project extends Model
{
    public $name;

    public function beforeSave()
    {
        if(empty($this->created)){
            $this->created = date('Y-m-d H:i:s', time());
        }else{
            $this->modified = date('Y-m-d H:i:s', time());
        }
    }
}