<?php
include_once "../../koneksi.php";
$pengguna = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pengguna > 0) {
    $query = "DELETE FROM tbl_pengguna WHERE user_id = $pengguna";
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pengguna berhasil dihapus.'); window.location.href='../../dashboard.php?modul=pengguna';</script>";
    } else {
        echo "Error: " . mysqli_error($konek);
    }
} else {
    echo "<script>alert('ID Pengguna tidak valid.'); window.location.href='../../dashboard.php?modul=pengguna';</script>";
}
?>