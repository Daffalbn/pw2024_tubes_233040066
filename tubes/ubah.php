<?php 
require 'functions.php';

    // ambil data di url
    $id = $_GET["id"];
    
    // query data mahasiswa berdasarkan id
    $msk = query("SELECT * FROM musik WHERE id = $id")[0];
  

    // cek apakah tombol submit sudah di tekan atau belum 
if (isset ($_POST["submit"]) ) {
  

    // cek apakah data berhasil di ubah atau tidak 
  if (ubah($_POST) > 0 ) {
    echo "
        <script>
          alert('Data berhasil diubah!');
          document.location.href = 'login.php';
        </script>   
    ";
  } else {
    echo "
        <script>
           alert('Data gagal diubah!');
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
    <title>Ubah Daftar Festival</title>
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
  <body class="bg-dark text-white"> 
 <div class="container col-6">

    <h1>Ubah Daftar Festival</h1>




  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $msk["id"]; ?>">
    <input type="hidden" name="gambarLama" value="<?= $msk["gambar"]; ?>">
  <div class="mb-3">
    <label for="festival" class="form-label">Festival</label> 
    <input type="text" class="form-control" id="Festival" name='festival';
     required value="<?= $msk["festival"]; ?>">
 </div>
 <div>
    <label for="gambar" class="form-label">Gambar</label> <br>
    <img src="img/<?= $msk['gambar']; ?>" width="65"> <br>
    <input type="file" class="form-control" id="gambar" name='gambar';
</div>
  <div class="mb-3">
    <label for="tempat" class="form-label">Tempat</label> 
    <input type="text" class="form-control" id="tempat" name='tempat';
     required value="<?= $msk["tempat"]; ?>">
  </div>
  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label> 
    <input type="text" class="form-control" id="tanggal" name='tanggal'; 
     required value="<?= $msk["tanggal"]; ?>">
  </div>
  <div class="mb-3">
    <label for="htm" class="form-label">HTM</label> 
    <input type="text" class="form-control" id="htm" name='htm';
     required value="<?= $msk["HTM"]; ?>">
  </div>
  

  </form> 
  <div class="d-flex justify-content-center mb-3">
  <button  type="submit" name="submit" class="btn btn-primary">Ubah Daftar!</button>
  </div>
 </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>