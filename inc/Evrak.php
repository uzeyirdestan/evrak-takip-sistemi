
<?php

/**
        Database class
        *@author        : Uzeyir Destan
        *@git           : https://github.com/uzeyirdestan/evrak-takip-sistemi
        *@version       : 0.1

*/
require_once("Database.php");
 class Evrak{
 	private $evrak_id;
 	private $evrak_ismi;
 	private $evrak_tarihi;
 	private $evrak_turu;
 	private $evrak_yolu;
 	private $kategori;
 	private $db;
 	public function __construct(){
 		$this->db = new Database();
 		$this->kategori="";
	 	}
	public function getAllEvrak(){
		$sql = "Select *  FROM evrak;";
		$result = $this->db->fetchClass($sql);	
		return json_encode($result);	}
	public function getEvrak($id){
		$sql = "Select * from evrak where evrak_id ='".$id." ';";		
		$result = $this->db->fetchClass($sql);	
		return json_encode($result);
	}
	public function getEvrakByTag($tag){
		$sql = "Select * from evrak where kategori = '".trim($tag)." ';";		
		$result = $this->db->fetchClass($sql);	
		return json_encode($result);
	}
	public function getGidenEvrak($user_id){
		$sql = "SELECT * FROM evrak WHERE evrak_turu = 'GIDEN' AND evrak_id NOT IN (SELECT evrak_id FROM soft_delete WHERE user_id ='".$user_id." ' ) ;";
		$result = $this->db->fetchClass($sql);
		return json_encode($result);
	}
	public function getGelenEvrak($user_id){
		$sql = "SELECT * FROM evrak WHERE evrak_turu = 'GELEN' AND evrak_id NOT IN (SELECT evrak_id FROM soft_delete WHERE user_id ='".$user_id." ' ) ;";
		$result = $this->db->fetchClass($sql);
		return json_encode($result);
	}
	public function setKategori($evrak_id,$kategori){
		$sql = "UPDATE evrak SET kategori = '".$kategori."' WHERE evrak_id = ".$evrak_id.";";
		$result = $this->db->make_query($sql);
		if ($result == "1"){
			echo "Kategori güncellendi";
		}
		else{
			echo "Hata meydana geldi";
		}
	}
	public function softDeleteEvrak($user_id,$evrak_id){
		$sql = "INSERT INTO soft_delete (evrak_id,user_id) VALUES ('".$evrak_id."','".$user_id."');";
		$result = $this->db->make_query($sql);
		if($result==1){
			echo "Başarıyla Silindi";
		}
		else{
			echo "Hata meydana geldi";
		}
	}

	public function setEvrakIsmi($isim){
		$this->evrak_ismi=$isim;
	}
	public function setEvrakKategori($kategori){
		$this->kategori=$kategori;
	}
	public function setEvrakTarihi($tarih){
		$this->evrak_tarihi=$tarih;
	}
	public function setEvrakYolu($yol){
		$this->evrak_yolu=$yol;
	}
	public function setEvrakTuru($tur){
		$this->evrak_turu=$tur;
	}
	
	public function createEvrak(){
		$sql = "INSERT INTO evrak (evrak_ismi,evrak_tarihi,evrak_yolu,evrak_turu,kategori) VALUES ('".$this->evrak_ismi."','".$this->evrak_tarihi."','".$this->evrak_yolu."','".$this->evrak_turu."','".$this->kategori."');";
		if($this->db->make_query($sql) == 1){
			echo "Dosya başarıyla eklendi";
		}
		else{
			echo "Dosya ekleme başarısız";
		}
	}
 }



?>
