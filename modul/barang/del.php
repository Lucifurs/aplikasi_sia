<?php
include_once "../../koneksi.php";

// Mendapatkan ID barang dari query string
$barang_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Mengecek apakah ID barang valid
if ($barang_id > 0) {
    // Membuat query SQL untuk menghapus barang
    $query = "DELETE FROM tbl_barang WHERE barang_id = $barang_id";

    // Menjalankan query
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data barang berhasil dihapus.'); window.location.href='../../dashboard.php?modul=barang';</script>";
    } else {
        echo "Error: " . mysqli_error($konek);
    }
} else {
    echo "<script>alert('ID barang tidak valid.'); window.location.href='../../dashboard.php?modul=barang';</script>";
}


