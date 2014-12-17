<?
class Query extends Db
{
    /**
     * @param $field_names
     * @param $field_values
     *
        //работа с БД

        //три типа вывода массива
        //fetch
        //PDO::FETCH_NUM
        //PDO::FETCH_ASSOC
        //PDO::FETCH_BOTH

        //fetchAll
        //PDO::FETCH_COLUMN
        //PDO::FETCH_CLASS
        //PDO::FETCH_GROUP
        //PDO::FETCH_UNIQUE
        //PDO::FETCH_PROPS_LATE

        //fetchColumn

        //select по ID по массиву ID или по значению
     *
     **/
    public $table_name;

    private $sql_begin = "";
    private $sql_continue = "";
    private $sql_end = "";
    private $sql_order = "";
    private $sql_limit = "";

    private $sql;
    private $bind = [];
    //PDO statement
    private $stmt;

    private $result;
    private $result_ids;

    public function select()
    {
        $this->sql_begin = "SELECT * FROM `" . $this->table_name . "` ";

        return $this;
    }

    public function where($field_values, $field_names = false)
    {
        $field_names  = $field_names != false ? $field_names : "id";

        if(is_array($field_values)){
            $count = count($field_values);

            if($count == 1){
                foreach($field_values as $k => $v){
                    $this->sql_end = "WHERE " . $field_names . " = :" . $field_names . " ";
                    $this->bind += [":" . $field_names => $v];
                }
            }else{
                $i = 1;
                foreach($field_values as $k => $v){
                    if($i == 1){
                        $this->sql_end = "WHERE " . $field_names . " = :" . $field_names . $i . " ";
                    }else if($i == $count){
                        $this->sql_end .= " OR " . $field_names . " = :" . $field_names . $i . " ";
                    }else{
                        $this->sql_end .= " OR " . $field_names . " = :" . $field_names . $i . " ";
                    }
                    $this->bind += [":" . $field_names . $i => $v];
                    $i++;
                }

            }
        }else{
            $this->sql_end = "WHERE " . $field_names . " = :" . $field_names . ";";
            $this->bind += [":" . $field_names => $field_values];
        }
        return $this;
    }


    /**
     * @param $field_names
     * @param $field_values
     */

    public function delete()
    {
        $this->sql_begin = "DELETE FROM `" . $this->table_name . "` ";
        return $this;
    }

    /**
     * @param $values - object
     */

    public function insert()
    {
        $values = get_object_vars($this);
        $column_names = $this->getColumnNames($this->table_name);

        //print_r($this->getColumnNames($this->table_name));

        //проверка есть ли такое поле в таблице
        foreach($values as $k => $v){
            if(in_array($k, $column_names)){
                $prepare_field_values[$k] = $v;
            }
        }

        $this->sql_begin = "INSERT INTO `" . $this->table_name . "` ";
        $this->sql_continue = "VALUES ";

        if(is_array($prepare_field_values)){
            $count = count($prepare_field_values);

            if($count == 1){
                foreach($prepare_field_values as $k => $v){
                    $this->sql_begin .= "(" . $k . ") ";
                    $this->sql_continue .= "(:" . $k . ");";
                    $this->bind += [":" . $k  => $v];
                }
            }else{
                $i = 1;
                foreach($prepare_field_values as $k => $v){
                    if($i == 1){
                        $this->sql_begin .= "(" . $k . ", ";
                        $this->sql_continue .= "(:" . $k . $i . ", ";
                    }else if($i == $count){
                        $this->sql_begin .= $k . ") ";
                        $this->sql_continue .= ":" . $k . $i . ");";
                    }else{
                        $this->sql_begin .= $k . ", ";
                        $this->sql_continue .= ":" . $k . $i . ", ";
                    }
                    $this->bind += [":" . $k . $i => $v];
                    $i++;
                }
            }
        }
        return $this;
    }

    /**
     * @param $field_names
     * @param $field_values
     */

    public function update()
    {
        if(is_object($this)){
            $values = get_object_vars($this);
            $column_names = $this->getColumnNames($this->table_name);

            //проверка есть ли такое поле в таблице
            foreach($values as $k => $v){
                if(in_array($k, $column_names)){
                    $prepare_field_values[$k] = $v;
                }
            }
        }

        $this->sql_begin = "UPDATE `" . $this->table_name . "` ";
        $this->sql_continue = "SET ";

        if(is_array($prepare_field_values)){

            $count = count($prepare_field_values);

            if($count == 1){
                foreach($prepare_field_values as $k => $v){
                    $this->sql_continue = $k . " = :" . $k . " ";
                    $this->bind += [":" . $k => $v];
                }
            }else{
                $i = 1;
                foreach($prepare_field_values as $k => $v){
                    if($i == 1){
                        $this->sql_continue .= $k . " = :" . $k . $i . ", ";
                    }else if($i == $count){
                        $this->sql_continue .= $k . " = :" . $k . $i . " ";
                    }else{
                        $this->sql_continue .= $k . " = :" . $k . $i . ", ";
                    }
                    $this->bind += [":" . $k . $i => $v];
                    $i++;
                }
            }
        }
        return $this;
    }

    public function sql($sql = false)
    {
        //если возвращает хотя бы одну строку то true
        if($sql){
            $this->sql_begin = $sql;
        }else{
            $this->sql_begin = $this->sql;
        }
        return $this;
    }

    /*public function getFields($class_name){
        $stmt = $this->getPDO()->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        //связать значения со свойствами класса
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $class_name);
    }*/

    //получаем
    public function getColumnNames(){

        $stmt = $this->getPDO()->prepare("SHOW COLUMNS FROM `" . $this->table_name . "`");
        $stmt->execute();

        foreach($stmt->fetchAll() as $field) {
            $field_names[] = $field[0];
        }
        return $field_names;
    }

    public function execute($set_last_insert_id = false)
    {
        $this->sql = $this->sql_begin . $this->sql_continue . $this->sql_end . $this->sql_order;
        $this->stmt = $this->getPDO()->prepare($this->sql);


        //ловим ошибки
        if(!$this->stmt->execute($this->bind))
        {
            $err = $this->stmt->errorInfo();

            if (isset($err[1]))
            {
                // 1054 - Unknown column
                // 1064 - Syntax error
                // 1062 - Duplicate entry
                // 1048 - mot Null
                // 1046 - table does not exist
                // 1265 - Data truncated
                //if ($err[1] == 1062 || $err[1] ==  1048 || $err[1] ==  1265){
                echo $err[2];
                //}
            }
        }

        if($set_last_insert_id){
            $this->id = $this->getlastInsertId();
        }

        return $this;
    }

    /**
     * @return array|string
     */
    public function one()
    {
        $result = [];
        $objects = $this->stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));

        foreach($objects as $key => $object){
            $result[$object->id] = $object;
        }

        if(!empty($result)){
            if(is_array($result)){
                $model = array_shift($result);
            }
            if(is_object($model)){
                $obj_name = get_class($this);
                $result = new $obj_name();
                $values = get_object_vars($model);
                foreach($values as $k => $v){
                    $result->$k = $v;
                }
            }
            $this->result = $result;
            return $this;
        }else{
            $this->result = false;
            return $this;
        }
    }

    public function all()
    {
        $result = [];
        $objects = $this->stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));
        foreach($objects as $key => $object){
            $result[$object->id] = $object;
        }

        if(!empty($result)){
            $this->result = $result;
            return $this;
        }else{
            $this->result = false;
            return $this;
        }
    }

    public function orderByField($field_name, $sort = "ASC")
    {
        $this->sql_order = " ORDER BY " . $field_name . " " . $sort;
        return $this;
    }

    public function limit($first_number, $last_number)
    {
        $this->sql_limit = "LIMIT " . $first_number . " , " . $last_number;
        return $this;
    }

    public function getId()
    {
        if(is_array($this->result)){
            $result_ids = [];
            foreach($this->result as $k => $v){
                $result_ids[] = $v->id;
            }
            $this->result_ids = $result_ids;
            return $this->result_ids;
        }else{
            return false;
        }
    }

    public function getField($field)
    {
        if(is_array($this->result)){
            $fields = [];
            foreach($this->result as $k => $v){
                $fields[] = $v->$field;
            }
            return $fields;
        }else{
            return false;
        }
    }

    public function getResult()
    {
        return $this->result;
    }


    public function getlastInsertId()
    {
        $last_inserted_id = $this->getPDO()->lastInsertId();
        return $last_inserted_id;
    }

}