<?php
include_once "../../koneksi.php";// Pastikan path ke file koneksi.php benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pelanggan_id = $_POST['pelanggan_id'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $query = "UPDATE tbl_pelanggan SET nama_pelanggan='$nama_pelanggan', alamat='$alamat', telepon='$telepon', email='$email' WHERE pelanggan_id='$pelanggan_id'";

    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pelanggan berhasil diperbarui.'); window.location.href='../../dashboard.php?modul=pelanggan';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>
```
</rewritten_file><|eot_id|>

