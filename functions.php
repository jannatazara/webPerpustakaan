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
function registrasi ($data) { 
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



?>
