<?php
include_once "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    $query = "UPDATE tbl_barang SET nama_barang='$nama_barang', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' WHERE barang_id='$id_barang'";

    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='../../dashboard.php?modul=barang';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($konek);
    }
}
?>