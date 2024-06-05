<?php 
require 'functions.php';

    // cek apakah tombol sumbit sudah di tekan atau belum 
if ( isset ($_POST["submit"]) ) {

    

    // cek apakah data berhasil di tambahkan atau tidak 
  if (tambah($_POST) > 0 ) {
    echo "
        <script>
          alert('Data berhasil ditambahkan!');
          document.location.href = 'login.php';
        </script>
    ";
  } else {
    echo "
        <script>
           alert('Data gagal ditambahkan!');
          document.location.href = 'login.php';
       </script>
";
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Daftar Festival</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        min-height: 100vh;
        background-image: url(./img/bghitam.jpeg);
        background-position: center;
        background-size: cover;
      }
    </style>
  </head>
  <body> 
 <div class="container col-6">

    <h1>Tambah Daftar Festival</h1>

    
  <form action="" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
    <label for="festival" class="form-label">Festival</label> 
    <input type="text" class="form-control" id="festival" name='festival'; required
   </div>
        
          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label> 
            <input type="file" class="form-control" id="gambar" name='gambar'; required
        </div>
  </div>
  <div class="mb-3">
    <label for="tempat" class="form-label">Tempat</label> 
    <input type="text" class="form-control" id="tempat" name='tempat'; required
  </div>
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label> 
    <input type="text" class="form-control" id="tanggal" name='tanggal';required
  </div>
  <div class="mb-3">
    <label for="htm" class="form-label">HTM</label> 
    <input type="text" class="form-control" id="htm" name='htm';required
  </div>
  

  </form> <br>
  <div class="d-flex justify-content-center mb-3">
  <button type="submit" name="submit"  class="btn btn-primary">Tambah Daftar!</button>
  </div>
 </div>




    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>