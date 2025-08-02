<?php

// Koneksi Ke database
$conn = mysqli_connect ("localhost", "root", "", "jannatazara_uas");


function query($query){ 
    global $conn;
    $result = mysqli_query ($conn, $query);
    $rows =[];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah1($data) { 
    global $conn;
    $nis = $data ["nis"];
    $nama = $data ["nama"];
    $email = $data ["email"];
    $jurusan = $data ["jurusan"];
    // upload gambar
    $gambar = upload(); 
    if (!$gambar) {
        return false;
    }
//query insert data
$query = "INSERT INTO tbl_siswa values('','$nis', '$nama', '$email', '$jurusan', '$gambar')";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);
}

function upload () {
    $namafile=$_FILES['gambar']['name'];
    $ukuranfile=$_FILES['gambar']['size'];
    $error=$_FILES['gambar']['error'];
    $tempName=$_FILES['gambar']['tmp_name'];

    // Periksa apakah ada gambar yang diupload 
    if ($error === 4){
    echo "<script>
        alert ('Silahkan Pilih Gambar Terlebih dahulu...!')

    </script> "; 
    return false;
    }

// Cek Apakah data yg diupload adalah gambar
    $ekstensi_Gambar_valid = ['jpg','jpeg','png'];
    $ekstensi_Gambar = explode('.',$namafile);
    $ekstensi_Gambar = strtolower(end($ekstensi_Gambar));
    if (!in_array($ekstensi_Gambar,$ekstensi_Gambar_valid)) { 
        echo "<script>
            alert ('Data yang anda Upload Bukan Gambar...!');

        </script>"; 
        return false;
    }
// Cek Apakah Gambar ukuran sizenya terlalu besar 
    if ($ukuranfile > 1000000) {
    echo "<script>
        alert ('Size Ukuran Gambar Terlalu Besar...!')
    </script> "; 
    return false;
}

// Jika validasi gambar berhasil

    
    //Jika Validasi gambar berhasil
    //generate gambar baru
        $anama_gambar_baru = uniqid();
        $anama_gambar_baru .= '.';
        $anama_gambar_baru .= $ekstensi_Gambar;

    move_uploaded_file($tempName, 'img/'. $namafile);
    return $namafile;

}



function tambah2($data) {
    global $conn;
    $kode_buku = $data ["kode_buku"];
    $judul_buku = $data ["judul_buku"];
    $pengarang = $data ["pengarang"];
    $penerbit = $data ["penerbit"];
        
    

//query insert data
$query = "INSERT INTO tbl_buku values('','$kode_buku', '$judul_buku', '$pengarang', '$penerbit')";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);

}

function tambah3($data) {
    global $conn;
    $nis = $data ["nis"];
    $tgl_pinjam = $data ["tgl_pinjam"];
    $kode_buku = $data ["kode_buku"];
    

//query insert data
$query = "INSERT INTO tbl_pinjam values('','$nis', '$tgl_pinjam', '$kode_buku')";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);

}

function tambah4($data) {
    global $conn;
    $nis = $data ["nis"];
    $tgl_kembali = $data ["tgl_kembali"];
    $kode_buku = $data ["kode_buku"];
    $keterangan = $data ["keterangan"];

//query insert data
$query = "INSERT INTO tbl_kembali values('','$nis', '$tgl_kembali', '$kode_buku', '$keterangan')";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);

}

function tambah5($data) {
    global $conn;

    
    $username = strtolower (stripcslashes($data["username"]));
    $password = mysqli_real_escape_string ($conn, $data["password"]);
    $password2= mysqli_real_escape_string ($conn, $data["password2"]);

//cek user sudaf terdaftar atau belum
$result = mysqli_query($conn, "SELECT username FROM tbl_user where username
='$username'");

if (mysqli_fetch_assoc($result)) { 
    echo "<script>
    alert ('username sudah terdaftar..!!');
    </script>"; 
    return false;
}


    // periksa konfirmasi password baru 
    if ( $password !== $password2) {
    echo "<script>
            alert ('Konfirmasi Password tidak sama');
    </script>"; 
    return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // $password = md5($password);
    // var_dump($password);die; //untuk melihathasil dari md5

    //Tambah user baru

    mysqli_query($conn, "INSERT INTO tbl_user 
VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
    }




function hapus1 ($Id){ 
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_siswa WHERE Id = $Id"); 
    return mysqli_affected_rows($conn);
}
function hapus2 ($Id){ 
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_buku WHERE Id = $Id"); 
    return mysqli_affected_rows($conn);
}
function hapus3 ($Id){ 
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_pinjam WHERE Id = $Id"); 
    return mysqli_affected_rows($conn);
}
function hapus4 ($Id){ 
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_kembali WHERE Id = $Id"); 
    return mysqli_affected_rows($conn);
}
function hapus5 ($Id){ 
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_user WHERE Id = $Id"); 
    return mysqli_affected_rows($conn);
}


function ubah1($data) { 
    global $conn;
    $Id = $data["Id"];

    $nis = $data ["nis"];
    $nama = $data ["nama"];
    $email = $data ["email"];
    $jurusan = $data ["jurusan"];
    $gambar_lama= $data ["gambar_lama"];

    //periksa apakah gambar baru udah dipilih atau tidak 
    if ($_FILES['gambar']['error']=== 4 ){
        $gambar = $gambar_lama;
    }else {
        $gambar = upload();
    }

//query Update data
$query = "UPDATE tbl_siswa set
            nis='$nis',
            nama='$nama', 
            email='$email', 
            jurusan='$jurusan',
            gambar='$gambar'
            WHERE Id = $Id 
            ";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);

}

function ubah2($data) { 
    global $conn;
    $Id = $data["Id"];

    $kode_buku = $data ["kode_buku"];
    $judul_buku = $data ["judul_buku"];
    $pengarang = $data ["pengarang"];
    $penerbit = $data ["penerbit"];
    

    //query Update data
    $query = "UPDATE tbl_buku set
                kode_buku='$kode_buku',
                judul_buku='$judul_buku', 
                pengarang='$pengarang', 
                penerbit='$penerbit'
                WHERE Id = $Id 
                ";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);
}

function ubah3($data) { 
    global $conn;
    $Id = $data["Id"];

    $nis = $data ["nis"];
    $tgl_pinjam = $data ["tgl_pinjam"];
    $kode_buku = $data ["kode_buku"];
    

    //query Update data
    $query = "UPDATE tbl_pinjam set
                nis='$nis',
                tgl_pinjam='$tgl_pinjam', 
                kode_buku='$kode_buku' 
                WHERE Id = $Id 
                ";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);
}

function ubah4($data) { 
    global $conn;
    $Id = $data["Id"];

    $nis = $data ["nis"];
    $tgl_kembali = $data ["tgl_kembali"];
    $kode_buku = $data ["kode_buku"];
    $keterangan =$data ["keterangan"];
    

    //query Update data
    $query = "UPDATE tbl_kembali set
                nis='$nis',
                tgl_kembali='$tgl_kembali', 
                kode_buku='$kode_buku',
                keterangan='$keterangan' 
                WHERE Id = $Id 
                ";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);
}

function ubah5($data) { 
    global $conn;
    $Id = $data["Id"];

    $username = strtolower (stripcslashes($data["username"]));
    $password = mysqli_real_escape_string ($conn, $data["password"]);
    $password2= mysqli_real_escape_string ($conn, $data["password2"]);

   
    
    
        // periksa konfirmasi password baru 
        if ( $password !== $password2) {
        echo "<script>
                alert ('Konfirmasi Password tidak sama');
        </script>"; 
        return false;
        }
    
        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // $password = md5($password);
        // var_dump($password);die; //untuk melihathasil dari md5
    

    //query Update data
    $query = "UPDATE tbl_user set
                username='$username',
                password='$password'
                WHERE Id = $Id 
                ";
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);
}

function cari1($keyword) {

$query = "SELECT * FROM tbl_siswa
            WHERE
            nama LIKE '%$keyword%' OR 
            email LIKE '%$keyword%' OR 
            jurusan LIKE '%$keyword%' ";
return query($query);

}

function cari2($keyword) {

    $query = "SELECT * FROM tbl_buku
                WHERE
                kode_buku LIKE '%$keyword%' OR 
                judul_buku LIKE '%$keyword%' OR
                pengarang LIKE '%$keyword%' OR 
                penerbit LIKE '%$keyword%' ";
    return query($query);
    
}

function cari3($keyword) {

    $query = "SELECT * FROM tbl_pinjam
                WHERE
                nis LIKE '%$keyword%' OR 
                tgl_pinjam LIKE '%$keyword%' OR
                kode_buku LIKE '%$keyword%' ";
    return query($query);
    
}

function cari4($keyword) {

    $query = "SELECT * FROM tbl_kembali
                WHERE
                nis LIKE '%$keyword%' OR 
                tgl_kembali LIKE '%$keyword%' OR
                kode_buku LIKE '%$keyword%' OR
                keterangan LIKE '%$keyword%' ";
    return query($query);
    
}

function cari5($keyword) {

    $query = "SELECT * FROM tbl_user
                WHERE
                username LIKE '%$keyword%' ";
    return query($query);
    
}



function registrasi ($data) { 
    global $conn;

    $username = strtolower (stripcslashes($data["username"]));
    $password = mysqli_real_escape_string ($conn, $data["password"]);
    $password2= mysqli_real_escape_string ($conn, $data["password2"]);

//cek user sudah terdaftar atau belum
$result = mysqli_query($conn, "SELECT username FROM tbl_user where username
='$username'");

if (mysqli_fetch_assoc($result)) { 
    echo "<script>
    alert ('username sudah terdaftar..!!');
    </script>"; 
    return false;
}


    // periksa konfirmasi password baru 
    if ( $password !== $password2) {
    echo "<script>
            alert ('Konfirmasi Password tidak sama');
    </script>"; 
    return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // $password = md5($password);
    // var_dump($password);die; //untuk melihathasil dari md5

    //Tambah user baru

    mysqli_query($conn, "INSERT INTO tbl_user 
VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
    }



?>
