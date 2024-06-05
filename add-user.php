<?php
    include_once "koneksi.php";
    $password = password_hash('123', PASSWORD_BCRYPT);
    // Escape the password to prevent SQL injection or errors
    $password = mysqli_real_escape_string($koneksi, $password);

    $query = "INSERT INTO tbl_pengguna (
        username,
        password,
        nama_lengkap,
        email,
        jabatan,
        hak_akses
        ) VALUES (
            'admin',
            '$password',
            'Administrator Web',
            'admin@gmail.com',
            'Administrator',
            'admin'
        )";

    if ($koneksi->query($query)) {
        echo "Data user berhasil di tambah";
    } else {
        // Menampilkan error SQL jika query gagal
        echo "Data user gagal di tambah: " . $koneksi->error;
    }

    mysqli_close($koneksi);
?>