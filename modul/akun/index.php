<?php

include_once "koneksi.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $acc_name =  $_REQUEST['nama_akun'];
    $acc_type =  $_REQUEST['jenis_akun'];
    $saldo_type =  $_REQUEST['type_saldo'];

    $query = "INSERT INTO tbl_akun (akun_id, nama_akun, jenis_akun, saldo_awal, tipe_saldo) 
                      VALUES ('', '$acc_name', '$acc_type', 0, '$saldo_type')";

    if (mysqli_query($konek, $query)) {
        echo "<script type='text/javascript'>
        window.location.href='./dashboard.php?modul=akun';
        </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}else{

}
?>

<div class="card mb-3">
    <div class="card-body">
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-md-4">
                <input type="text" class="form-control" name="id_akun" id="id_akun" hidden value="">
                    <label class="form-label" for="nama_akun">Nama akun</label> <input type="text"
                        class="form-control" name="nama_akun"> </div>
                <div class="col-md-4">
                    <label class="form-label" for="jenis_akun">Jenis akun</label>
                    <input type="text" class="form-control" name="jenis_akun">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="type_saldo">Type saldo</label>
                    <select class="form-select" name="type_saldo">
                        <option value="debit">Debit</option>
                        <option value="kredit">Kredit</option>
                    </select>
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
        <h3>Data Akun</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Akun</th>
                        <th>Jenis Akun</th>
                        <th>Type Saldo</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($konek, "SELECT akun_id, nama_akun, jenis_akun, tipe_saldo FROM tbl_akun");
                if ($result) {
                    while ($tampil = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?= $tampil["akun_id"] ?></td>
                            <td><?= $tampil["nama_akun"] ?></td>
                            <td><?= $tampil["jenis_akun"] ?></td>
                            <td><?= $tampil["tipe_saldo"] ?></td>
                            <td>
                                <a href="#editAkun" class="text-decoration-none" data-bs-toggle="modal" data-bs-id-acc="<?= $tampil["akun_id"] ?>" data-bs-name="<?= $tampil["nama_akun"] ?>" data-bs-type="<?= $tampil["jenis_akun"] ?>" data-bs-balance="<?= $tampil["tipe_saldo"] ?>">
                                    <i class="bi bi-pencil-square text-success"></i>
                                </a>
                                <a href="./modul/akun/del.php?id=<?= $tampil['akun_id'] ?>" class="text-decoration-none">
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

<?php
tampilModal();

function tampilModal() {
?>
    <!-- Modal -->
    <div class="modal fade" id="editAkun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="./modul/akun/edt.php" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Akun</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="nama_akun">Nama akun</label>
                            <input type="text" class="form-control" name="id_akun" id="id_akun" hidden>
                            <input type="text" class="form-control" name="nama_akun2" id="acc_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jenis_akun">Jenis akun</label>
                            <input type="text" class="form-control" name="jenis_akun2" id="acc_type">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="type_saldo">Type saldo</label>
                            <select class="form-select" name="type_saldo2" id="acc_balance">
                                <option value="debit">Debit</option>
                                <option value="kredit">Kredit</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const editAkunModal = document.getElementById('editAkun');
            if (editAkunModal) {
                editAkunModal.addEventListener('show.bs.modal', (event) => {
                    const button = event.relatedTarget;
                    const idAcc = button.getAttribute('data-bs-id-acc');
                    const name = button.getAttribute('data-bs-name');
                    const type = button.getAttribute('data-bs-type');
                    const balance = button.getAttribute('data-bs-balance');
                    
                    const modalTitle = editAkunModal.querySelector('.modal-title');
                    const accIDInput = editAkunModal.querySelector('#id_akun');
                    const accNameInput = editAkunModal.querySelector('#acc_name');
                    const accTypeInput = editAkunModal.querySelector('#acc_type');
                    const accBalanceSelect = editAkunModal.querySelector('#acc_balance');

                    modalTitle.textContent = `Edit Data Akun ID ${idAcc}`;
                    accIDInput.value = idAcc;
                    accNameInput.value = name;
                    accTypeInput.value = type;
                    accBalanceSelect.value = balance.toLowerCase();
                });
            }
        });
    </script>
<?php
}
?>
