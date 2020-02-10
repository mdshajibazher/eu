<?php
	$fielpath = realpath(dirname(__FILE__));

	include_once $fielpath.'/../lib/database.php';
	include_once $fielpath.'/../helpers/format.php';

	class Students{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}

    public function getTotalStudents(){
        	$query = "SELECT * FROM students_table";
			$result = $this->db->select($query);
			return $result;
    }


    



	}

?> 