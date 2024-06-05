<?php
include_once "koneksi.php"; // Pastikan path ke file koneksi.php benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    // Cek apakah ini edit atau tambah baru
    if (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] != '') {
        // Ini adalah operasi edit
        $pelanggan_id = $_POST['pelanggan_id'];
        $query = "UPDATE tbl_pelanggan SET nama_pelanggan='$nama_pelanggan', alamat='$alamat', telepon='$telepon', email='$email' WHERE pelanggan_id='$pelanggan_id'";
    } else {
        // Ini adalah operasi tambah baru
        $query = "INSERT INTO tbl_pelanggan (nama_pelanggan, alamat, telepon, email) VALUES ('$nama_pelanggan', '$alamat', '$telepon', '$email')";
    }

    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pelanggan berhasil disimpan.'); window.location.href='./dashboard.php?modul=pelanggan';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>

<div class="card mb-3">
    <div class="card-body">
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama_pelanggan" class="form-label">Nama pelanggan</label>
                    <input type="text" class="form-control" name="nama_pelanggan">
                </div>
                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control" name="telepon">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
            <hr class="text-secondary">
            <div class="text-end">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3>Data Pelanggan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>
                            <i class="bi bi-gear-fill"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($konek, "SELECT pelanggan_id, nama_pelanggan, alamat, telepon, email FROM tbl_pelanggan");
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?= $row["pelanggan_id"] ?></td>
                                <td><?= $row["nama_pelanggan"] ?></td>
                                <td><?= $row["alamat"] ?></td>
                                <td><?= $row["telepon"] ?></td>
                                <td><?= $row["email"] ?></td>
                                <td>
                                    <a href="#editPelanggan" class="text-decoration-none" data-bs-toggle="modal" data-bs-id="<?= $row["pelanggan_id"] ?>" data-bs-name="<?= $row["nama_pelanggan"] ?>" data-bs-address="<?= $row["alamat"] ?>" data-bs-phone="<?= $row["telepon"] ?>" data-bs-email="<?= $row["email"] ?>">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </a>
                                    <a href="./modul/pelanggan/del.php?id=<?= $row['pelanggan_id'] ?>" class="text-decoration-none">
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
    </div>
</div>

<div class="modal fade" id="editPelanggan" tabindex="-1" aria-labelledby="editPelangganLabel" aria-hidden="true">
    <form action="./modul/pelanggan/edt.php" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editPelangganLabel">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pelanggan_id" id="pelanggan_id">
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="telepon">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
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
    var editModal = document.getElementById('editPelanggan');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-bs-id');
        var name = button.getAttribute('data-bs-name');
        var address = button.getAttribute('data-bs-address');
        var phone = button.getAttribute('data-bs-phone');
        var email = button.getAttribute('data-bs-email');

        var modalTitle = editModal.querySelector('.modal-title');
        var idInput = editModal.querySelector('#pelanggan_id');
        var nameInput = editModal.querySelector('#nama_pelanggan');
        var addressInput = editModal.querySelector('#alamat');
        var phoneInput = editModal.querySelector('#telepon');
        var emailInput = editModal.querySelector('#email');

        modalTitle.textContent = 'Edit Pelanggan';
        idInput.value = id;
        nameInput.value = name;
        addressInput.value = address;
        phoneInput.value = phone;
        emailInput.value = email;
    });
});
</script>