<?php
session_start();

//(jika tidak ada session login, maka kembalikan user ke halaman login)
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//pagination
//konfigurasi
$jumlahDataPerHal = 10;
$jumlahData = count(query("SELECT * FROM musik"));
$jumlahHal = ceil($jumlahData / $jumlahDataPerHal);
$halAktif = (isset($_GET["halaman"])) ? $_GET["halaman"]
    : 1;
$awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;


$musik = query("SELECT * FROM musik LIMIT $awalData, $jumlahDataPerHal");
$musik = query("SELECT * FROM musik");

// tombol cari ditekan
if(isset($_POST["cari"])) {
    $musik = cari($_POST["keyword"]);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark text-white"> 

<h1>Daftar Festival 2023</h1>
<div>
  <a href="tambah.php" class="btn btn-primary me-3" role="button">Add Festival</a>
  <a href="logout.php" class="btn btn-danger" role="button">Log out</a>
  </div>
<br>

<form action="" method="post">
    
<section class="row justify-content-center m-5">
<div class="col-9">
    <input type="text" name="keyword" size="25" autofocus 
    placeholder="Search.." autocomplete="off">
    <button type="submit" name="cari">Search!</button>

</form>

<table class="table table-dark">
      <thead>
        <tr>
        <th>No.</th>
        <th>Festival</th>    
        <th>Gambar</th>
        <th>Tempat</th>
        <th>Tanggal</th>
        <th>HTM</th>
        <th>Action</th>
        </tr>
      </thead>


      <tbody>
      <?php $i= 1; ?>
        <?php foreach ($musik as $msk) : ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $msk["festival"]; ?></td>
            <td><img src="img/<?= $msk["gambar"]; ?>" width="130"></td>
            <td><?= $msk["tempat"]; ?></td>
            <td><?= $msk["tanggal"]; ?></td>
            <td><?= $msk["HTM"]; ?></td>
            <td>
              <a href="ubah.php?id=<?= $msk["id"]; ?>" class="badge text-bg-secondary text-decoration-none">Edit</a>
              <a href="hapus.php?id=<?= $msk["id"]; ?>" class="badge text-bg-danger text-decoration-none" onclick="return confirm('Lanjutkan?');">Delete</a>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    </section>



    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <?php if ($halAktif > 1) : ?>
                    <a class="page-link" href="?halaman=<?= $halAktif - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php endif; ?>
            </li>

            <?php for ($i = 1; $i <= $jumlahHal; $i++) : ?>
                <?php if ($i == $halAktif) : ?>
                    <li class="page-item active"> <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                <?php else : ?>
                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <li class="page-item">
                <?php if ($halAktif < $jumlahHal) : ?>
                    <a class="page-link" href="?halaman=<?= $halAktif + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>