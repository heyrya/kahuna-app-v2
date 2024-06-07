<?php
namespace app\kahuna\client\model;

use \PDO;
use \PDOException;

class DBConnect
{
    private static $singleton = null;
    private $dbh;


    private function __construct()
    {
        $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/.env');
        try{
            $this->dbh = new PDO(
                "mysql:host=localhost;dbname=kahuna_db",
                $env['DB_User'],
                $env['DB_Pass'],
                array(PDO::ATTR_PERSISTENT => true)
            );
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        self::$singleton = self::$singleton ?? new DBConnect();
        return self::$singleton;
    }

    public function getConnection()
    {
        return $this->dbh;
    }
}