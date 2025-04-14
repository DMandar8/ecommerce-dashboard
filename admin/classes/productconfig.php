<?php
class ProductConfig
{
    private $host, $pass, $dbName;
    public $connect;

    function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbName = "ecommerce";
        $this->connect = mysqli_connect($this->host, $this->user, $this->pass, $this->dbName);
    }

    function __destruct()
    {
        if ($this->connect) {
            mysqli_close($this->connect);
        }
    }
}
?>
