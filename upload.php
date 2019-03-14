<?php
require_once("inc/Evrak.php");
if($_POST["filename"]=="" || $_POST["date"]=="" || $_POST["type"]==""){
	header("Location:index.php?content=document");
	exit;
}
   if(isset($_FILES['file'])){
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      $file_ext = explode('.',$file_name);
      $file_ext=strtolower(end($file_ext));
      $extensions= array("jpeg","jpg","png" ,"pdf", "tiff");
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="Lutfen geçerli bir format giriniz.";
      }
      if(empty($errors)==true){
      	$file_name=date("U").".".$file_ext;
         move_uploaded_file($file_tmp,"uploads/".$file_name);
         $evrak = new Evrak();
         $evrak->setEvrakYolu("uploads/".$file_name);
         $evrak->setEvrakIsmi(trim($_POST["filename"]));
         $evrak->setEvrakTarihi($_POST["date"]);
         $evrak->setEvrakTuru($_POST["type"]);
         $evrak->setEvrakKategori(trim($_POST["kategori"]));
         $evrak->createEvrak();         
         		 
      }
      else{
         print_r($errors);
      }
   }



?>