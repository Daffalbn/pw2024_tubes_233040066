<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040066");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ) {
     $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $conn;
    
   $festival = htmlspecialchars($data["festival"]);
   $tempat = htmlspecialchars($data["tempat"]);
   $tanggal = htmlspecialchars($data["tanggal"]);
   $htm= htmlspecialchars($data["htm"]);
   $kategori_id = htmlspecialchars($data["kategori_id"]);

   //upload gambar
   $gambar = upload();
   if( !$gambar ){
    return false;

   }


$query = "INSERT INTO musik
            VALUES
(NULL,  '$gambar',  '$tempat', '$festival', '$tanggal', '$htm', '$kategori_id')

";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}


function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name']; 

    // cek apakah tidak ada gambar yang di upload
    if ($error === 4){
        echo "<script>
        alert('select the image!');
        </script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        alert('what you upload is not an image!');
        </script>";
        return false;

    }

    //cek jika ukuran gambar terlalu besar 
    if($ukuranFile > 2000000) {
        echo "<script>
        alert('image size is too large!');
        </script>";
        return false;

    }

    //lolos pengecekan, gambar siap di upload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

    return $namaFileBaru;



}

 
function hapus($id) {
    global $conn; 
    mysqli_query($conn, "DELETE FROM musik WHERE id = $id");
    return mysqli_affected_rows($conn);
}




function ubah($data) {
    global $conn;
    $id = $data["id"];
    $festival = htmlspecialchars($data["festival"]);
    $tempat = htmlspecialchars($data["tempat"]);
    $kategori_id = htmlspecialchars($data["kategori_id"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $htm = htmlspecialchars($data["htm"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak 
    if($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
       $gambar = upload();
    }
 
 
 $query = "UPDATE musik SET
            gambar = '$gambar',
            festival = '$festival',
            tempat = '$tempat',
            kategori_id = '$kategori_id',
            tanggal = '$tanggal',
            HTM = '$htm'
            WHERE id = $id
            ";
 
 mysqli_query($conn, $query); 
 return mysqli_affected_rows($conn);


}


function cari($keyword) {
    $query ="SELECT * FROM musik
              WHERE
    festival LIKE '%$keyword%' OR
    tempat LIKE '%$keyword%' OR
    tanggal LIKE '%$keyword%' OR
    htm LIKE '%$keyword%' 
  
    ";
    return query($query);
}




function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username='$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                 alert('username is already registered');
                 </script>";
        return false;
    }

    //cek konfirmasi pw
    if ($password !== $password2) {
        echo "<script>
                alert('Confirm password is incorrect');
                </script>";
        return false;
    }

    //enkripsi pw
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan userbaru ke db
    mysqli_query($conn, "INSERT INTO user VALUES(NULL,'$username', '$password')");

    return mysqli_affected_rows($conn);
}

//pagination
//konfigurasi
$jumlahDataPerHal = 5;
$jumlahData = count(query("SELECT * FROM musik"));
$jumlahHal = ceil($jumlahData / $jumlahDataPerHal);
$halAktif = (isset($_GET["halaman"])) ? $_GET["halaman"]
    : 1;
$awalData = ($jumlahDataPerHal * $halAktif) - $jumlahDataPerHal;












?>