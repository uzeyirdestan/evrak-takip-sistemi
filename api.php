<?php
require("inc/Evrak.php");
$evrak = new Evrak();
if (isset($_GET["action"])) {
	if($_GET["action"]=="evrak"){
		if(isset($_GET["id"])){
			$result = $evrak->getEvrak($_GET["id"]);
			if($result=="[]"){
				print("Sonuç bulunamadı");
			}
			else{
				print($result);
			}
		}
		else{
			print("Hatalı giriş yaptınız");
		}
	}
	else if ($_GET["action"]=="evraklar"){
		if (isset($_GET["tag"])){
			$result = $evrak->getEvrakByTag($_GET["tag"]);
			if($result=="[]"){
				print("Sonuç bulunamadı");
			}
			else{
				print($result);
			}
		}
		else{
			print("Hatalı giriş yaptınız");
		}
	}
	else{
			print("Hatalı giriş yaptınız");
	}
}

?>

