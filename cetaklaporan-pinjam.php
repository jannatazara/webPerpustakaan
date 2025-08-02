<?php
//memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm', 'A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan 
$pdf->SetFont('Arial','B',12);
// mencetak string
$pdf->Cell(125,7,'SEKOLAH MENENGAH ATAS MANDALA',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(125,7,'LAPORAN PEMINJAMAN BUKU PUSTAKA MANDALA',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,'NIS',1,0);
$pdf->Cell(40,6,'TANGGAL PINJAM',1,0);
$pdf->Cell(40,6,'KODE BUKU',1,1);

$pdf->SetFont('Arial','',10);

require 'functions.php';
$siswa = mysqli_query($conn, "select * from tbl_pinjam");
while ($row = mysqli_fetch_array($siswa)) {

    $pdf->Cell(30,6,$row['nis'],1,0);
    $pdf->Cell(40,6,$row['tgl_pinjam'],1,0);
    $pdf->Cell(40,6,$row['kode_buku'],1,1);
    
    //$pdf->Cell(25,6,$row['tanggal_lahir'],1,1);
}

$pdf->Output();
?>

