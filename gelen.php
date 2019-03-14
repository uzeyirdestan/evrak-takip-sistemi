<?php
require_once('inc/auto_include.php');
require_once('inc/Evrak.php');
$evrak = new Evrak();
if(isset($_POST["userid"]) && isset($_POST["evrakid"])){
    return $evrak->softDeleteEvrak($_POST["userid"],$_POST["evrakid"]);
}
if(isset($_POST["evrakno"]) && isset($_POST["kategori"])){
    return $evrak->setKategori($_POST["evrakno"],$_POST["kategori"]);
}
?>
<h1>Giden Evraklar</h1>
<table id="evraklar" class="table ">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Evrak Id</th>
            <th>Evrak İsmi</th>
            <th>Evrak Tarihi</th>
            <th>Evrak</th>
            <th>Kategori</th> 
            <th>Kategori</th> 
            <th>Kategori</th> 

        </tr>
    </thead>
    <tbody>
        <?php
        $json_response = $evrak->getGelenEvrak($user->user_id);
        $response = json_decode($json_response);
        //var_dump($response);
        $counter=1;
        foreach($response as $result){
            echo "<tr><td>".$counter++."</td><td>".$result->{"evrak_id"}."</td><td>".$result->{"evrak_ismi"}."</td>";
            echo "<td>".$result->{"evrak_tarihi"}."</td><td><a  href='".$result->{"evrak_yolu"}."' > Evrak Görüntüle </a></td><td>".$result->{"kategori"}."</td>";
            echo "<td><a class='btn btn-danger' href='#' onclick='deleteEvrak(this);' data-evrakid='".$result->{"evrak_id"}."' data-userid='".$user->user_id."'>SİL</a></td><td><a data-evrakid='".$result->{"evrak_id"}."' data-userid='".$user->user_id."' href='#' onclick='kategoriEkle(this);'>Kategori Ekle</a></td>";
        }
        ?>

    </tbody>
</table>
<input type="hidden" id="evrakno">
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Kategori Ekleyiniz</h4>
        </div>
        <div class="modal-body">
        <label for="kategori"> Kategori adı giriniz:</label>
          <input type="text" name="kategori" id="kategori">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success mr-auto" id="kaydet">Kaydet</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
        </div>
      </div>
      
    </div>
  </div>
<script>
$(document).ready( function () {
    $('#evraklar').DataTable();
} );
var deleteEvrak = function(el){
    var userid = el.dataset.userid;
    var evrakid = el.dataset.evrakid;
    var xhr = new XMLHttpRequest();
    var params = "userid="+userid+"&evrakid="+evrakid;
    xhr.open("POST","giden.php");
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() { 
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            alert(xhr.response);
            location.reload();
            }
    }
    xhr.send(params);
};
var kategoriEkle = function(el){
    document.getElementById("evrakno").value=el.dataset.evrakid;
    $("#myModal").modal();
};
$("#kaydet").click(function(){
    $("#myModal").modal("hide");
    var xhr = new XMLHttpRequest();
    var params = "evrakno="+$("#evrakno").val()+"&kategori="+$("#kategori").val();
    xhr.open("POST","giden.php");
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() { 
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            alert(xhr.response);
            location.reload();
            }
    }
    xhr.send(params);
});
</script>