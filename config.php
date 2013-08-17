<?php
Class dbConfig extends PDO {

	protected $dbConfig = array();

    protected function createConfig() {
        $this->dbConfig['host'] = 'localhost';
        $this->dbConfig['username'] = 'root';
        $this->dbConfig['password'] = '';
        $this->dbConfig['dbname'] = 'lake_cms';
    }

}
?>
