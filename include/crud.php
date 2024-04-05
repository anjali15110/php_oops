<?php
	
	class Crud
	{
		private $host = 'localhost';
		private $username = 'root';
		private $pass = '';
		private $db = 'oops';
		
		public $conn;
		
		public function __construct()
		{
			$this->conn = mysqli_connect($this->host, $this->username, $this->pass, $this->db);
			if(!$this->conn){
				echo 'Error:' .mysqli_connect_error();
				die();
			}
		}
	
	}
		
		class Create extends Crud
		{	
			public function insertdata($data)
			{
				
				// Prepare keys and values for query
				$keys = implode(',', array_keys($data));
				$values = "'" . implode("','", array_values($data)) . "'";

				$sql = "insert into crud ($keys) values ($values)";
				$query = mysqli_query($this->conn, $sql);
				if($query == 1)
				{
					return true;
				}else{
					return false;
				}
			}
		}
		
		class Show extends Crud
		{	
			public function showdata($table)
			{
				$sql = "select * from $table";
				$query = mysqli_query($this->conn, $sql);
				return $query;
			}
		}
		
		class Edit extends Crud
		{	
			public function editdata($table,$id)
			{
				$sql = "select * from $table where id = $id";
				$query = mysqli_query($this->conn, $sql);
				return $query;
			}
		}
		
		class Update extends Crud
		{	
			public function updatedata($table,$data,$id)
			{
				$updates = [];
				foreach ($data as $key => $value)
				{
					$updates[] = "$key = '$value'";
				}
				$join = implode(", ", $updates);
				$sql = "update $table set $join where id = $id";
				// return $sql;
				// die();
				$query = mysqli_query($this->conn, $sql);
				return $query;
			}
		}
		
		class Deleted extends Crud
		{	
			public function deleteddata($table,$id)
			{
				$sql = "delete from $table where id = $id";
				$query = mysqli_query($this->conn, $sql);
				return $query;
			}
		}
	
	
	
?>