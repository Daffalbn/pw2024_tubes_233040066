<?php
require 'functions.php';

$musik = query("SELECT * FROM musik WHERE kategori_id=2");

// tombol cari diklik
if (isset($_POST["cari"])) {
    $musik = cari($_POST["keyword"]);
}

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Festival Musik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/jkt.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body> 
       <!-- navbar -->
       <nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top" style="background-color: #10140c;">
        <div class="container">
            <a class="navbar-brand" href="login.php">FM2023</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kota</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="bandung.php">Bandung</a></li>
                            <li><a class="dropdown-item" href="jakarta.php">Jakarta</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#admin">Admin</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

           
      
<!-- jumbotron -->
<section class="jumbotron" id="home">
        <div class="jumbotrongrup">
            <h1>FM JAKARTA 2023</h1>
            <p class="lead">Informasi data acara bermuatan festival musik 2023</p>
        </div>
</section>




<section class="row justify-content-center m-5">
<div class="col-9">
<form action="" method="post" class="mb-2">
    <input class="text" type="search" placeholder="Search" name="keyword" autofocus autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="cari">Search..</a></button>
</form>
<br>
<div id="container">
 <table class="table table-dark">
<thead>
        <tr>
        <th scope="col">No.</th>
        <th scope="col">Festival</th>    
        <th scope="col">Gambar</th>
        <th scope="col">Tempat</th>
        <th scope="col">Tanggal</th>
        <th scope="col">HTM</th>
    
        
        </tr>
 </thead>


      <tbody>
      <?php $i= 1; ?>
        <?php foreach ($musik as $msk) : ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $msk["festival"]; ?></td>
            <td><img src="img/<?= $msk["gambar"]; ?>" width="130"></td>
            <td><?= $msk["tempat"]; ?></td>
            <td><?= $msk["tanggal"]; ?></td>
            <td><?= $msk["HTM"]; ?></td>
          
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    </div>
    </section>

    <script>
        feather.replace();
    </script>


    <script src="js/script4.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>