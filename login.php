<?php
include ("inc/User.php");
if(isset($_SESSION["user_id"])){
	header("Location:index.php");
}
if(isset($_POST["username"]) && isset($_POST["password"])){
	$user = new User();
	if($user->login($_POST["username"],$_POST["password"]) == "success"){
		header("Location:index.php");
	}
	else{
		$fail="Kullanıcı adı veya şifre yanlış.";
	}
}
?>
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Uzeyir Destan">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
<body>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-heading">
			<h2 class="text-center">Login</h2>
			<?php
				if(isset($fail)){
					echo "<h2 class='text-center' style='color:red'>".$fail."</h2>";
				}
			?>
		</div>
		<div class="modal-body">
			<form method="POST" role="form">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-user"></span>
						</span>
						<input type="text" class="form-control" placeholder="User Name" name="username"/>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-lock"></span>
						</span>
						<input type="password" class="form-control" placeholder="Password" name="password" />
					</div>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-success btn-lg">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>



