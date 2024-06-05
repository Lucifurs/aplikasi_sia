<?php
include_once "../../koneksi.php";
$pelanggan_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pelanggan_id > 0) {
    $query = "DELETE FROM tbl_pelanggan WHERE pelanggan_id = $pelanggan_id";
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pelanggan berhasil dihapus.'); window.location.href='../../dashboard.php?modul=pelanggan';</script>";
    } else {
        echo "Error: " . mysqli_error($konek);
    }
} else {
    echo "<script>alert('ID pelanggan tidak valid.'); window.location.href='../../dashboard.php?modul=pelanggan';</script>";
}
?>