<?
class Model extends Query
{
    public $id;

    public function __construct()
    {
        $this->table_name = $this->getTable();
        $this->validation = new Validation();
        parent::__construct();
    }

    public function getTable()
    {
        return Inflector::tableize(get_class($this));
    }

    /**
     * @param $id
     * @return array|string
     */
    public function findById($id)
    {
        return $this->select()->where($id)->execute();
    }

    /**
     * @param $field_value
     * @param $field_name
     * @return array|string
     */
    public function findByField($field_value, $field_name = false)
    {
        $field_name = $field_name != false ? $field_name : "id";
        return $this->select()->where($field_value, $field_name)->execute();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->select()->execute()->all();
    }

    public function findOwn()
    {
        return $this->select()->where(Auth::getUserField('id'), 'user_id')->execute();
    }


    /**
     * @param bool $id
     * @return $this
     */
    public function save($id = false)
    {
        $this->validate();

        $this->beforeSave();

        if ($this->id) {
            $saved = $this->update()->where($this->id)->execute();
        } else {
            $saved = $this->insert()->execute(true);
        }

        $this->afterSave();

        return $saved;
    }

    /**
     * @param $id
     */
    public function deleteById($id)
    {
        $this->delete()->where($id)->execute();
    }

    /**
     *
     */
    public function beforeSave()
    {

    }

    public function afterSave()
    {

    }

    /**
     *
     */
    public function validate()
    {

    }
}