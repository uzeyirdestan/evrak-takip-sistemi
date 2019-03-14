<?php

/**
	User class
	*@author	: Uzeyir Destan
	*@git		: https://github.com/uzeyirdestan/evrak-takip-sistemi
	*@version	: 0.1

*/
if (isset($_GET['logout'])) {
	unset($_SESSION["user_id"]);
	session_destroy();
}
if (!isset($_SESSION['user_id'])) {
      	header('Location: login.php');
		exit;
}
require_once("Database.php");
class UserManagement{
	private $db;
	public function __construct(){
		$this->db = new Database();
	}
	public function getAllUsers(){
		$sql = "Select user_id, username FROM users;";
		return $this->db->make_query("$sql");
	}
	public function add_user($username,$password){
		if(!$this->isUsernameinUse($username)){
			$sql = "INSERT INTO users (username,password) VALUES ('".$username."','".$password."');";
			$result = $this->db->make_query($sql);
			if($result == 1){
				echo " İşlem başarılı ";
			}
		}
		else{
			echo "Kullanıcı adı kullanımda.";
		}
	}
	public function delete_user($username){
                if($this->isUsernameinUse($username)){
                        $sql = "DELETE FROM users where username = '".$username."';";
                        $result = $this->db->make_query($sql);
                        if($result == 1){
                                echo " İşlem başarılı ";
                        }
                }
                else{
                        echo "Kullanıcı adı bulunamadı";
                }
        }
	public function change_user_username($username_old,$username_new){
                if($this->isUsernameinUse($username_old)){
			if(!$this->isUsernameinUse($username_new)){
                       		$sql = "UPDATE users SET username ='".$username_new."' where username = '".$username_old."';";
                        	$result = $this->db->make_query($sql);
                        	if($result == 1){
                                	echo " İşlem başarılı ";
                	        }
                	}
			else{
				echo "Username in use, please select different one ";
			}
		}
                else{
                        echo "Kullanıcı adı bulunamadı";
                }
        }
	public function change_user_password($username,$password_new){
                if($this->isUsernameinUse($username)){
                        $sql = "UPDATE users SET password ='".$password_new."' where username = '".$username."';";
                        $result = $this->db->make_query($sql);
                        if($result == 1){
                                echo " İşlem başarılı ";
                        }
                }
                else{
                        echo "Kullanıcı adı bulunamadı";
                }
        }
	public function isUsernameinUse($username){
		if ($this->db->get_row_count("Select username from users where username = '".$username."';") == 1 ){
			return true ;
		}
		return false ;
	}
}
?>
