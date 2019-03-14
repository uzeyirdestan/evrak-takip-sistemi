<?php
require_once('inc/auto_include.php');
if ($user->username!="admin"){
	echo "Yönetici değilsiniz.Bu ekranı görmeye yetkiniz bulunmamakta.";
	return;
}
$um = new UserManagement();
if (isset($_GET["delete"])){
	$um->delete_user($_GET["delete"]);
	return "User deleted";
	//header('Location: index.php?content=user');
	//return;
}

//include_once("header.php");
?>
<h1>Kullanıcı Yönetim Ekranı </h1>
<table id="users" class="table ">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Kullanıcı Id</th>
            <th>Kullanıcı</th>
            <th>Sil</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $response = $um->getAllUsers();
        $counter=1;
        foreach($response as $result){
        echo "<tr><td>".$counter++."</td><td>".$result["user_id"]."</td><td>".$result["username"]."</td>";
	//echo '<td><a class="btn btn-danger" href="user.php?delete=' . $result["username"] .'"  >Delete </a></td>';
	echo "<td><a class='btn btn-danger' href='#' onclick='action(this);' data-action='delete' data-uservalue='".$result["username"]."' >SİL</a></td></tr>";
	}
        ?>
    </tbody>
</table>
<script>
$(document).ready( function () {
    $('#users').DataTable();
} );

var action = function(el){
	var action = el.dataset.action;
	var xhr = new XMLHttpRequest();
	xhr.open("GET","user.php?delete="+el.dataset.uservalue);
	xhr.onreadystatechange = function() { // Call a function when the state changes.
	    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
			alert(xhr.response);
			location.reload();
    		}
	}
	xhr.send();
}
</script>
<?php

//include("footer.php");

?>
