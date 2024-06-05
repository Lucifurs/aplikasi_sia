<?php
include_once "koneksi.php"; // Pastikan path ke file koneksi.php benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_suplier = $_POST['nama_suplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    // Cek apakah ini edit atau tambah baru
    if (isset($_POST['suplier_id']) && $_POST['suplier_id'] != '') {
        // Ini adalah operasi edit
        $suplier_id = $_POST['suplier_id'];
        $query = "UPDATE tbl__suplier SET nama_suplier='$nama_suplier', alamat='$alamat', telepon='$telepon', email='$email' WHERE suplier_id='$suplier_id'";
    } else {
        // Ini adalah operasi tambah baru
        $query = "INSERT INTO tbl__suplier (nama_suplier, alamat, telepon, email) VALUES ('$nama_suplier', '$alamat', '$telepon', '$email')";
    }

    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data suplier berhasil disimpan.'); window.location.href='./dashboard.php?modul=suplier';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>

<div class="card mb-3">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="nama_suplier" class="form-label">Nama suplier</label>
                    <input type="text" class="form-control" name="nama_suplier">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
                </row>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="telp" class="form-label">Telp</label>
                        <input type="text" class="form-control" name="telp">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-end">
                        <button class="btn btn-secondary" type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Data Suplier</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Suplier</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th><i class="bi bi-gear-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($konek, "SELECT suplier_id, nama_suplier, alamat, telepon, email FROM tbl__suplier");
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?= $row["suplier_id"] ?></td>
                                    <td><?= $row["nama_suplier"] ?></td>
                                    <td><?= $row["alamat"] ?></td>
                                    <td><?= $row["telepon"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td>
                                        <a href="#editSuplier" class="text-decoration-none" data-bs-toggle="modal" data-bs-id="<?= $row["suplier_id"] ?>" data-bs-name="<?= $row["nama_suplier"] ?>" data-bs-address="<?= $row["alamat"] ?>" data-bs-phone="<?= $row["telepon"] ?>" data-bs-email="<?= $row["email"] ?>">
                                            <i class="bi bi-pencil-square text-success"></i>
                                        </a>
                                        <a href="./modul/suplier/del.php?id=<?= $row['suplier_id'] ?>" class="text-decoration-none">
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
</div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="editSuplier" tabindex="-1" aria-labelledby="editSuplierLabel" aria-hidden="true">
    <form action="./modul/suplier/edt.php" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editSuplierLabel">Edit Suplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="suplier_id" id="suplier_id">
                    <div class="mb-3">
                        <label for="nama_suplier" class="form-label">Nama suplier</label>
                        <input type="text" class="form-control" name="nama_suplier" id="nama_suplier">
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
    var editModal = document.getElementById('editSuplier');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-bs-id');
        var name = button.getAttribute('data-bs-name');
        var address = button.getAttribute('data-bs-address');
        var phone = button.getAttribute('data-bs-phone');
        var email = button.getAttribute('data-bs-email');

        var modalTitle = editModal.querySelector('.modal-title');
        var idInput = editModal.querySelector('#suplier_id');
        var nameInput = editModal.querySelector('#nama_suplier');
        var addressInput = editModal.querySelector('#alamat');
        var phoneInput = editModal.querySelector('#telepon');
        var emailInput = editModal.querySelector('#email');

        modalTitle.textContent = 'Edit Suplier';
        idInput.value = id;
        nameInput.value = name;
        addressInput.value = address;
        phoneInput.value = phone;
        emailInput.value = email;
    });
});
</script>

