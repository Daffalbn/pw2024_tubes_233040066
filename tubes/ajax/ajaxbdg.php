<?php
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM musik WHERE
           festival LIKE '%$keyword%' OR
            tempat LIKE '%$keyword%' OR
            tanggal LIKE '%$keyword%' OR
            htm LIKE '%$keyword%' AND
            kategori_id=1
";
$musik = query($query);


?>

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
            <td><img src="img/<?= $msk["gambar"]; ?>" width="70px"></td>
            <td><?= $msk["tempat"]; ?></td>
            <td><?= $msk["tanggal"]; ?></td>
            <td><?= $msk["HTM"]; ?></td>
          
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>



