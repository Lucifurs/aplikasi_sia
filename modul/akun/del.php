<?php
include_once "../../koneksi.php";

$id_akun = $_GET['id'];

$sql = "DELETE FROM tbl_akun WHERE akun_id='$id_akun'";
$result = mysqli_query($konek, $sql);

if ($result) {
    echo "<script type='text/javascript'>
            window.location.href='../../dashboard.php?modul=akun';
          </script>";
} else {
    echo "Gagal menghapus data barang";
}
?>
