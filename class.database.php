<?php

require_once 'config.php';

Class Database extends dbConfig {
	
	protected $connection;
	
	function __construct() {
	
		parent::createConfig();
		try{
			$dsn = 'mysql:host=' . $this->dbConfig['host'] . ';dbname=' . $this->dbConfig['dbname'];
			$this->connection = new PDO($dsn, $this->dbConfig['username'], $this->dbConfig['password']);
            $this->connection->query("SET NAMES utf8");
            $this->connection->query("SET CHARACTER SET utf8");
            $this->connection->query("SET COLLATION_CONNECTION = 'utf8_turkish_ci");
			return true;
		}catch(PDOException $error){
			$errorMesage = 'Hata : Veritabanı bağlantısı kurulamadı !<br>Hata Mesajı =>'.$error->getMessage();
			return $errorMesage;
		}
    }
	
	public function selectOr($table, $array = null) {
		if($array == null){
			$sql = "SELECT * FROM ".$table;
		}else{			
			$columns = array_keys($array);
			$values = array_values($array);
			$sqlString = "";
			for($i=0;$i<count($columns);$i++){
				if($i==count($columns)-1){
					$sqlString .= $columns[$i]." = '".$values[$i]."' ";
				}else{
					$sqlString .= $columns[$i]." = '".$values[$i]."' or ";
				}
			}
			$sql = "SELECT * FROM ".$table." WHERE ".$sqlString;
		}
        $select = $this->connection->query($sql);
        if ($select) {
            $row = $select->fetchAll();
            return $row;
        } else {
            return false;
        }
	}
	
	public function selectAnd($table, $array = null) {
	
		if($array == null){
			$sql = "SELECT * FROM ".$table;
		}else{			
			$columns = array_keys($array);
			$values = array_values($array);
			$sqlString = "";
			for($i=0;$i<count($columns);$i++){
				if($i==count($columns)-1){
					$sqlString .= $columns[$i]." = '".$values[$i]."' ";
				}else{
					$sqlString .= $columns[$i]." = '".$values[$i]."' and ";
				}
			}
			$sql = "SELECT * FROM ".$table." WHERE ".$sqlString;
		}
        $select = $this->connection->query($sql);
        if ($select) {
            $row = $select->fetchAll();
            return $row;
        } else {
            return false;
        }	
	}
	
	public function selectOrLimit($table, $array = null, $limit, $start = null) {
		if($start == null){
			$limitStr = "LIMIT ".$limit;
		}else{
			$limitStr = "LIMIT ".$start.", ".$limit;
		}
		if($array == null){
			$sql = "SELECT * FROM ".$table." ".$limitStr;
		}else{	
			$columns = array_keys($array);
			$values = array_values($array);
			$sqlString = "";
			for($i=0;$i<count($columns);$i++){
				if($i==count($columns)-1){
					$sqlString .= $columns[$i]." = '".$values[$i]."' ";
				}else{
					$sqlString .= $columns[$i]." = '".$values[$i]."' or ";
				}
			}
			$sql = "SELECT * FROM ".$table." WHERE ".$sqlString." ".$limitStr;
		}
        $select = $this->connection->query($sql);
        if ($select) {
            $row = $select->fetchAll();
            return $row;
        } else {
            return false;
        }
	}
	
	public function selectAndLimit($table, $array = null, $limit, $start = null) {
		if($start == null){
			$limitStr = "LIMIT ".$limit;
		}else{
			$limitStr = "LIMIT ".$start.", ".$limit;
		}
		if($array == null){
			$sql = "SELECT * FROM ".$table." ".$limitStr;
		}else{
			$columns = array_keys($array);
			$values = array_values($array);
			$sqlString = "";
			for($i=0;$i<count($columns);$i++){
				if($i==count($columns)-1){
					$sqlString .= $columns[$i]." = '".$values[$i]."' ";
				}else{
					$sqlString .= $columns[$i]." = '".$values[$i]."' and ";
				}
			}
			$sql = "SELECT * FROM ".$table." WHERE ".$sqlString." ".$limitStr;
		}
        $select = $this->connection->query($sql);
        if ($select) {
            $row = $select->fetchAll();
            return $row;
        } else {
            return false;
        }
	}
	
	public function insert($table, $array) {
		
		$columns = implode(", ", array_keys($array));
		$values  = implode("',' ", array_values($array));
		
		$sql = "INSERT INTO ".$table."(".$columns.") VALUES ('".$values."')";
		$insert = $this->connection->query($sql);
        if ($insert) {
            return $this->connection->lastInsertId($table);
        } else {
            return false;
        }
	}
	
	public function update($table, $id, $array) {
	
		$columns = array_keys($array);
		$values = array_values($array);
		$sqlString = "";
		for($i=0;$i<count($columns);$i++){
			if($i==count($columns)-1){
				$sqlString .= $columns[$i]." = '".$values[$i]."' ";
			}else{
				$sqlString .= $columns[$i]." = '".$values[$i]."', ";
			}
		}
		$sql = "UPDATE ".$table." SET ".$sqlString." WHERE id=" . $id;

		$update = $this->connection->query($sql);
		
        if ($update) {
            return true;
        } else {
            return false;
        }
	}
	
	public function delete($table, $id) {
		
		$sql = 'DELETE FROM ' . $table . ' WHERE id=' . $id;
		
        $delete = $this->connection->exec($sql);
		
        if ($delete) {
            return true;
        } else {
            return false;
        }
	}
	
	public function query($sql) {
	
		$query = $this->connection->query($sql);
		
        if ($query) {
            return $query;
        } else {
            return false;
        }
	}
	
	public function count($table, $array = null) {
		if($array == null){
			$sql = "SELECT count(*) from " . $table;
		}else{
			
			$columns = array_keys($array);
			$values = array_values($array);
			$sqlString = "";
			for($i=0;$i<count($columns);$i++){
				if($i==count($columns)-1){
					$sqlString .= $columns[$i]." = '".$values[$i]."' ";
				}else{
					$sqlString .= $columns[$i]." = '".$values[$i]."' and ";
				}
			}
		
			$sql = "SELECT count(*) from " . $table. " WHERE ". $sqlString;
		}
        $count = $this->connection->prepare($sql);
        $count->execute();
        return $count->fetchColumn();
	}
		
	function __destruct() {
	
        $this->connection = null;
    }
}

?>
