<?php
require 'koneksi.php';
$input = file_get_contents('php://input');
$data = json_decode($input, true);
//terima data dari mobile
$nama = trim($data['nama']);
$lokasi = trim($data['lokasi']);
http_response_code(201);
if ($nama != '' and $lokasi != '') {
    $query = mysqli_query($koneksi, "insert into pelanggaran(nama,lokasi) values('$nama','$lokasi')");
    $pesan = true;
} else {
    $pesan = false;
}
echo json_encode($pesan);
echo mysqli_error($koneksi);