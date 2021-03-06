<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //prepare statment
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function getResults()
    {
        $this->execute();

        return  $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //GEt single record
    public function single()
    {
        $this->execute();

        return  $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // get row count
    public function rowCount()
    {
        return  $this->stmt->rowCount();
    }
}
