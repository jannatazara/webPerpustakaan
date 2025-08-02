<?php
//simpan file dengan nama hapus.php
require 'functions.php';

$Id = $_GET ["Id"];
if (hapus2($Id) > 0 ) {
    echo"
    <script>
     alert('Data Berhasil dihapus...!');
     Document.location.href='tables-buku.php';
</script>

";

} else {

// echo "Data Gagal Disimpan!!"; //tanpa java script
// echo "<br>";
// echo mysqli_error ($conn);

//Menggunakan pesan java script
echo"
<script>
alert('Data Gagal ditambahkan...!');
Document.location.href='tables-buku.php';
</script>

";

}

?>


