<?php
include_once "../../koneksi.php";
$suplier_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($suplier_id > 0) {
    $query = "DELETE FROM tbl__suplier WHERE suplier_id = $suplier_id";
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data suplier berhasil dihapus.'); window.location.href='../../dashboard.php?modul=suplier';</script>";
    } else {
        echo "Error: " . mysqli_error($konek);
    }
} else {
    echo "<script>alert('ID suplier tidak valid.'); window.location.href='../../dashboard.php?modul=suplier';</script>";
}

