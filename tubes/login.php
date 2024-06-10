<?php
session_start();
require 'functions.php';

$musik = query("SELECT * FROM musik");

//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id=$id ");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: admin.php");
    exit;
}


if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

    //cek username
    if (mysqli_num_rows($result) === 1) {

        //cek pw
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: admin.php");
            exit;
        }
    }

    $error = true;
}

//tombol cari diklik
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
    <link rel="stylesheet" href="./css/login.css">
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
            <h1>FESTIVAL MUSIK 2023</h1>
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
     
     

        

    <div class="login" id="admin">
        <div class="card border-light mb-3 mt-5" style="width: 25rem; background-color:black; color:white;">
            <div class="card-body p-4 mb-3">
                <h1 class="text-center mb-5">Log In</h1>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p>❌ incorrect username or password</p>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i data-feather="user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i data-feather="lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <button type="submit" class="btn btn-primary " name="login">Log in</button>
                    </div>
                    <div class="registerlink text-center">
                        <p>Don't have an account? <a href="registrasi.php">Sign up here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>


    <script src="js/script2.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>