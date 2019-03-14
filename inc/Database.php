<?php

/**
	Database class
	*@author	: Uzeyir Destan
	*@git		: https://github.com/uzeyirdestan/evrak-takip-sistemi
	*@version	: 0.1

*/

class Database{
	private $db;
	private $query;
	private $isConnected = false;

	public function __construct($host="localhost",$username="project",$password="Kocaeli41.",$database="Proje"){
		$prefix = "mysql:host=".$host.";dbname=".$database.";";
		try{
			$this->db = new PDO($prefix,$username,$password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
			$this->isConnected = true;
//			echo "Connected \n";
		}
		catch (PDOException $e){
			echo "Database bağlantısı yapılamadı.";
			echo $e->getMessage();
		}
	}
	public function make_query($query){
		$request_type = strtolower(explode(" ", $query)[0]);
		$result = $this->db->query($query);
		if ($request_type == "select" || $request_type == "show" ){
			return $result->fetchAll();
		}
		else if ($request_type == "update" || $request_type == "delete" || $request_type == "insert"){
			return $result->rowCount();
		}
	}
	 public function make_single_query($query){
                $request_type = strtolower(explode(" ", $query)[0]);
                $result = $this->db->query($query);
                if ($request_type == "select" || $request_type == "show" ){
                        return $result->fetch();
                }
                else if ($request_type == "update" || $request_type == "delete" || $request_type == "insert"){
                        return $result->rowCount();
                }
    }

    public function fetchClass($query){
    		$pQuery = $this->db->prepare($query);
    		$pQuery->execute();
    		return  $pQuery->fetchAll(PDO::FETCH_CLASS);
    }
	public function get_row_count($query){
		$result = $this->db->query($query);
                return $result->rowCount();
	}
	public function is_connected(){
		return $this->isConnected;
	}
}

?>
