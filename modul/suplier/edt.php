<?php
include_once "../../koneksi.php"; // Pastikan path ke file koneksi.php benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $suplier_id = $_POST['suplier_id'];
    $nama_suplier = $_POST['nama_suplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $query = "UPDATE tbl__suplier SET nama_suplier='$nama_suplier', alamat='$alamat', telepon='$telepon', email='$email' WHERE suplier_id='$suplier_id'";

    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data suplier berhasil diperbarui.'); window.location.href='../../dashboard.php?modul=suplier';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
