<?php
class DatabaseDriver {
    protected $_pdo;
    function __construct() {
        $this->_pdo = $this->getPDO();
    }
    public function getPDO() {
        $config = parse_ini_file('config/config.ini', true);
        $host = $config['database']['host'];
        $user = $config['database']['user'];
        $password = $config['database']['password'];
        $dbname = $config['database']['dbname'];
        $dsn = "mysql:host=$host;dbname=$dbname";
        $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $pdo = new PDO($dsn, $user, $password, $opt);
        return $pdo;
    }
}