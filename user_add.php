<?php
require_once('inc/auto_include.php');
if ($user->username!="admin"){
	echo "Yönetici değilsiniz.Bu ekranı görmeye yetkiniz bulunmamakta.";
	return;
}
$um = new UserManagement();
if (isset($_POST["user"]) && isset($_POST["password"])){
	$um->add_user($_POST["user"],$_POST["password"]);
	return "Kullanıcı oluşturuldu.";
}
?>
<div class="container">
  <!--  <form class="form-horizontal" role="form" method="POST" action="user_add.php" id="formAddUser" > -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Yeni Kullanıcı Oluştur</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Kullanıcı Adı</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text" name="user" class="form-control" id="name"
                               placeholder="Kullanıcı Adı" required autofocus>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Parola</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Parola" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Parolayı Onayla</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem">
                            <i class="fa fa-repeat"></i>
                        </div>
                        <input type="password" name="password-confirmation" class="form-control"
                               id="password-confirm" placeholder="Parolayı Onayla" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success" onclick="send();"><i class="fa fa-user-plus"></i> Kayıt</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
var send = function(){
	var user = document.getElementById("name").value;
	var pass = document.getElementById("password").value;
	var pass2 = document.getElementById("password-confirm").value;
	if (pass != pass2){
		alert("Parolalar uyuşmamakta");
	}
	else{
		var xhr = new XMLHttpRequest();
		var params = "user="+user+"&password="+pass;
		xhr.open("POST","user_add.php");
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function() { 
	    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
			alert(xhr.responseText);
			location.reload();
    		}
	}
		xhr.send(params);
	}
}

</script>