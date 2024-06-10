<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('new user successfully added');
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
      body {
        min-height: 100vh;
        background-image: url(./img/bgbg.jpg);
        background-size: cover;
      }
    </style>

<body class="bg-dark"> 
<div class="container col-6 text-white">
    <div class="regis">
     <h1 class="text-center">Sign Up</h1>
      <form  action="" method="post">
      <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="mb-3">
      <label for="password2" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="password2" name="password2">
      </div>
      <div class="d-flex justify-content-center mb-3">
      <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
      </div>
      <div class="text-center">
      <p>Already have an account? <a href="login.php">Login</a></p>
     </div>
   </form>
  </div>
 </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>