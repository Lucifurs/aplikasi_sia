<?php
include_once "../../koneksi.php";// Pastikan path ke file koneksi.php benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['pengguna_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $jabatan = $level == 'admin' ? 'Administrator' : 'User';
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    // Escape the password to prevent SQL injection or errors
    $password = mysqli_real_escape_string($konek, $password);
    $query = "UPDATE tbl_pengguna SET
        username = '$username',
        password = '$password',
        nama_lengkap = '$nama_lengkap',
        email = '$email',
        jabatan = '$jabatan',
        hak_akses = '$level' WHERE user_id=$user_id";

     if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pengguna berhasil diperbarui.'); window.location.href='../../dashboard.php?modul=pengguna';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}


