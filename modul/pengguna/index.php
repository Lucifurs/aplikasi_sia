<?php
include_once "koneksi.php"; // Pastikan path ke file koneksi.php benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $jabatan = $level == 'admin' ? 'Administrator' : 'User';
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    // Escape the password to prevent SQL injection or errors
    $password = mysqli_real_escape_string($konek, $password);
    $query = "INSERT INTO tbl_pengguna (
        username,
        password,
        nama_lengkap,
        email,
        jabatan,
        hak_akses
        ) VALUES (
            '$username',
            '$password',
            '$nama_lengkap',
            '$email',
            '$jabatan',
            '$level'
        )";
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pengguna berhasil disimpan.'); window.location.href='./dashboard.php?modul=pengguna';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="mb-2 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-2 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" class="form-select">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col text-end">
                    <button class="btn btn-secondary" type="reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <h3>Data Pengguna</h3>
            </div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Email</th>
                            <th><i class="bi bi-gear-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($konek, "SELECT user_id ,username, hak_akses, email, nama_lengkap FROM tbl_pengguna");
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?= $row["user_id"] ?></td>
                                    <td><?= $row["username"] ?></td>
                                    <td><?= $row["hak_akses"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td>
                                        <a href="#editPengguna" class="text-decoration-none" data-bs-toggle="modal" data-bs-id="<?= $row["user_id"] ?>" data-bs-username="<?= $row["username"] ?>" data-bs-email="<?= $row["email"] ?>" data-bs-level="<?= $row["hak_akses"] ?>" data-bs-nama="<?= $row["nama_lengkap"] ?>">
                                            <i class="bi bi-pencil-square text-success"></i>
                                        </a>
                                        <a href="./modul/pengguna/del.php?id=<?= $row['user_id'] ?>" class="text-decoration-none">
                                            <i class="bi bi-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="editPengguna" tabindex="-1" aria-labelledby="editPenggunaLabel" aria-hidden="true">
    <form action="./modul/pengguna/edt.php" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editPelangganLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pengguna_id" id="pengguna_id">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="email" class="form-control" name="nama_lengkap" id="nama_lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select name="level" class="form-select">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var editModal = document.getElementById('editPengguna');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-bs-id');
        var username = button.getAttribute('data-bs-username');
        var nama_lengkap = button.getAttribute('data-bs-nama');
        var email = button.getAttribute('data-bs-email');

        var modalTitle = editModal.querySelector('.modal-title');
        var idInput = editModal.querySelector('#pengguna_id');
        var usernameInput = editModal.querySelector('#username');
        var nameInput = editModal.querySelector('#nama_lengkap');
        var emailInput = editModal.querySelector('#email');

        modalTitle.textContent = 'Edit Pengguna';
        idInput.value = id;
        usernameInput.value = username;
        nameInput.value = nama_lengkap;
        emailInput.value = email;
    });
});
</script>