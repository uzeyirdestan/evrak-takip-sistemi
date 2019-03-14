<?php

/**
	User class
	*@author	: Uzeyir Destan
	*@git		: https://github.com/uzeyirdestan/evrak-takip-sistemi
	*@version	: 0.1

*/
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("Database.php");
class User{
	public $user_id;
	public $username;
	public $is_logged_in = false;
	private $db;
	public function __construct(){
		$this->db= new Database();
		if(!$this->db->is_connected()) {
			echo "<br> Database bağlantı hatası meydana geldi. </br>";
		}
	}
	public function getUserFromId($id){
		$result = $this->db->make_single_query("Select * from users where user_id='".$id."';");
		$this->username=$result["username"];
		$this->user_id=$id;
	}
	public function login($username,$password){
		$result = $this->db->make_single_query("Select * from users where username='".$username."';");
		if ($password == $result["password"]){
			$this->user_id = $result["user_id"];
			$this->username = $result["username"];
			$this->is_logged_in = true;
			$_SESSION["user_id"]=$result["user_id"];
		return "Başarılı";
		}
		else{
		return	"Hata"; 
		}
	}
	public function logout(){
		unset($_SESSION["user_id"]);
		session_destroy();
	}
}
?>
