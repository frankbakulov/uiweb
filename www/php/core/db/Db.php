<?
class Db
{
    private $pdo;
    private $debug;

    public function __construct()
    {
        try{
            $this->pdo = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USERNAME, DB_PASSWORD);
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
        $this->debug = new Debuger();
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public function getDebug()
    {
        return $this->debug;
    }
}
