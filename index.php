<?php 
include("header.php"); 
?>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Evrak Takip Sistemi - ETS</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="?logout=1">Çıkış Yap</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if($user->username=="admin"){
            echo '<li class="nav-item">
               <a class="nav-link" href="?content=user"> 
                <span data-feather="file"></span> Kullanıcılar 
              </a>
              <ul class="submenu-user">
                <li class="nav-item"><a class="nav-link" href="?content=user">Kullanıcıları Listele</a></li>
                <li class="nav-item"><a class="nav-link" href="?content=user_add">Kullanıcı Ekle</a></li>
              </ul>
            </li>' ;
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="?content=giden">
              Giden Evrak
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?content=gelen">
              Gelen Evrak
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?content=evrak_ekle">
              Evrak Ekle
            </a>
          </li>
        </ul>
      </div>
    </nav>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-top:100px">
	<?php 
  if( isset($_GET["content"]) ){
		switch($_GET["content"]){
			case "user" :
        include("user.php");
        break;
      case "user_add" :
        include("user_add.php");
        break;
			case "gelen": 
				include("gelen.php");
				break;
      case "giden": 
				include("giden.php");
				break;
      case "evrak_ekle": 
        include("evrak_ekle.php");
        break;
			default : 
				echo "Evrak Takip Sistemine hoş geldiniz";
		}
  }
  else{
        echo "Evrak Takip Sistemine hoş geldiniz";
  }
	?>
</main>
</body>
</html>
