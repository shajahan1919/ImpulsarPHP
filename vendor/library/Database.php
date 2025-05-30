<?php

	/*
		Library : Database Lite
		Description	: To work with SQLite Database
		Author		: Shajahan Basha Syed

	*/

	require_once __DIR__.DIRECTORY_SEPARATOR.'.'.DIRECTORY_SEPARATOR.'table.php';


	class Database{
		private $conn;
		private $dbhost;
		private $dbuser;
		private $dbpass;
		private $dbname;

		public function __Construct($host,$user,$pass,$name){
			$this->dbhost = $host;
			$this->dbuser = $user;
			$this ->dbpass = $pass;
			$this->dbname = $name;
			$this->conn = $this->connection();
			return $this->conn;
		}

		public function connection(){
			$status = mysql_connect($this->dbhost,$this->dbuser,$this ->dbpass);
			return $status;
		}
		
		public function table($tablename){
			$statement = new table($tablename,$this,$this->conn);
			return $statement;
		}
		
		public function opendb(){
			$status = mysql_select_db($this->dbname);
			return $status;
		}

		public function getInsertId(){
			return mysql_insert_id();
		}
		public function error(){
			return mysql_error();
		}
		
		function getInsertStatement($tablename,$data=array()){
			$size = count($data);
			if($tablename==''){
				die('table name is missing.');
				return false;
			} else if($size==0){
				die('table data is missing.');
				return false;
			} else{ 
				$col = array();
				$values = "";
				foreach($data as $key=>$val){
					$col[] = $key;
					if($values==""){
						$values .= "'$val'";
					} else{
						$values .= ",'$val'";
					}
				}
				
				$coldata = implode(',',$col);
				$statement = "INSERT INTO $tablename ($coldata) VALUES($values)";
				return $statement;
			}
		}
		
		
		function insert($tablename,$data=array()){
			
			$statement = $this->getInsertStatement($tablename,$data);
			return $this->run($statement);
			
		}
		
		function getUpdateStatement($tablename,$data=array(),$condition=''){
			$size = count($data);
			if($tablename==''){
				die('table name is missing.');
				return false;
			} else if($size==0){
				die('table data is missing.');
				return false;
			} else{
				$coldata = '';
				foreach($data as $key=>$val){
					if($coldata==""){
						$coldata .= "$key='$val'";
					} else{
						$coldata .= ", $key='$val'";
					}
				}
				
				if($condition==''){
					$statement = "UPDATE $tablename SET $coldata";
				} else{
					$statement = "UPDATE $tablename SET $coldata WHERE $condition";
				}
				
				return $statement; 
			}		
		}
		
		function update($tablename,$data=array(),$condition=''){
			
			$statement = $this->getUpdateStatement($tablename,$data,$condition);
			return $this->run($statement);
				
		}

		public function run($query){
			$status = mysql_query($query);
			return $status;
		}

		public function fetch($querystatus){
			$resultset = mysql_fetch_array($querystatus,MYSQLI_ASSOC);
			return $resultset;
		}

		public function countData($querystatus){
			return mysql_num_rows($querystatus);
		}


		public function countFields($querystatus){
			return mysqli_num_fields($querystatus);
		}

		public function fieldDetails($querystatus,$i){
			$field = array();

			$fieldobj = mysqli_fetch_field($querystatus, $i);

			$field['name'] = $fieldobj->name;
			$field['table'] = $fieldobj->table;
			$field['max_length'] = $fieldobj->max_length;
			$field['not_null'] = $fieldobj->not_null;
			$field['primary_key'] = $fieldobj->primary_key;
			$field['unique_key'] = $fieldobj->unique_key;
			$field['multiple_key'] = $fieldobj->multiple_key;
			$field['numeric'] = $fieldobj->numeric;
			$field['blob'] = $fieldobj->blob;
			$field['type'] = $fieldobj->type;
			$field['unsigned'] = $fieldobj->unsigned;
			$field['zerofill'] = $fieldobj->zerofill;

			return $field;
		}

		public function fieldName($querystatus,$i){
			return mysql_field_name($querystatus, $i);
		}

		public function escapeString($unescapedString){
			return mysql_real_escape_string($unescapedString);
		}

		public function __destruct(){
			if($this->conn){
				mysql_close($this->conn);
			}
		}

	}
?>
