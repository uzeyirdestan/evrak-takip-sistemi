<!-- <form method="POST" enctype="multipart/form-data" action="upload.php" id="myform"> -->
  <div class="form-group">
    <label for="filename">Dosya İsmi</label>
    <input type="text" class="form-control" id="filename" name="filename" placeholder="Dosya İsmi">
  </div>
   <div class="form-group">
    <label for="filename">Evrak Türü</label>
    <select class="custom-select" name="type" id="type">
    <option selected value="GIDEN">Giden Evrak</option>
    <option value="GELEN">Gelen Evrak</option>
  </select>
  </div>
  <div class="form-group">
    <label for="date">Tarih</label>
    <input type="date" class="form-control" id="date" name="date" placeholder="Tarih">
  </div>
  <div class="form-group">
    <label for="kategori">Kategori</label>
    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori">
  </div>
  <div class="form-group">
    <label for="file">File input</label>
    <input type="file" id="file" name="file">
  </div>
  <button type="submit" class="btn btn-default btn-success btn-lg" id="submit">Gönder</button>
<!--</form> -->
    
  <script type="text/javascript">
    $("#submit").click(function(){
      var allowedtypes = ["jpg","png","jpeg","pdf","tiff"];
      var filename = $("#file").val();
      var type= $("#type").val();
      var ext = filename.toLowerCase().split(".");
      if(allowedtypes.includes(ext[ext.length-1])){
        if($("#filename").val()!="" ){
          if($("#date").val()!=""){
            var form = new FormData();
            form.append("filename",$("#filename").val());
            form.append("date",$("#date").val());
            form.append("type",type);
            form.append("kategori",$("#kategori").val());
            form.append("file",document.getElementById("file").files[0]);
            console.log(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST","upload.php");
            
            xhr.onreadystatechange = function() { // Call a function when the state changes.
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert(xhr.response);
                location.reload();
                  }
            }
            xhr.send(form);
          }
          else{
            alert("Tarih boş olamaz");
            return false;
          }
        }
        else{
          alert("Dosya adı boş olamaz");
          return false;
        }
      }
      else{
        if(filename ==""){
          alert("Dosya seçilmemiş durumda lütfen dosya seçiniz");
          return false;
        }
        else{
         alert("Yanlış dosya formatı");
          return false;
        }
      }
    });
  </script>