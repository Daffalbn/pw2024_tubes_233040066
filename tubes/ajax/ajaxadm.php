<?php
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM musik WHERE
           festival LIKE '%$keyword%' OR
            tempat LIKE '%$keyword%' OR
            tanggal LIKE '%$keyword%' OR
            htm LIKE '%$keyword%'
          
";
$musik = query($query);


?>

<table class="table table-striped table-hover table-dark" id="tabel">
<thead>
        <tr>
        <th scope="col">No.</th>
        <th scope="col">Festival</th>    
        <th scope="col">Gambar</th>
        <th scope="col">Tempat</th>
        <th scope="col">Tanggal</th>
        <th scope="col">HTM</th>
        <th scope="col">Action</th>
    
        
        </tr>
 </thead>


      <tbody>
      <?php $i = $awalData + 1; ?>
        <?php foreach ($musik as $msk) : ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $msk["festival"]; ?></td>
            <td><img src="img/<?= $msk["gambar"]; ?>" width="70px"></td>
            <td><?= $msk["tempat"]; ?></td>
            <td><?= $msk["tanggal"]; ?></td>
            <td><?= $msk["HTM"]; ?></td>
            

            <td>
              <a href="ubah.php?id=<?= $msk["id"]; ?>" class="badge text-bg-secondary text-decoration-none">Edit</a>
              <a href="hapus.php?id=<?= $msk["id"]; ?>" class="badge text-bg-danger text-decoration-none" onclick="return confirm ('Lanjutkan?');">Delete</a>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>



