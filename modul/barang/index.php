<?php
include_once "koneksi.php"; // Pastikan path ke file koneksi.php benar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_REQUEST['nama_barang'];
    $harga_beli = $_REQUEST['harga_beli'];
    $harga_jual = $_REQUEST['harga_jual'];
    $stok = $_REQUEST['stok'];

    $query = "INSERT INTO tbl_barang (barang_id, nama_barang, harga_beli, harga_jual, stok) 
              VALUES ('', '$nama_barang', '$harga_beli', '$harga_jual', '$stok')";

    if (mysqli_query($konek, $query)) {
        echo "<script type='text/javascript'>
        window.location.href='./dashboard.php?modul=barang';
        </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>

<div class="card mb-3">
    <div class="card-body">
        <form action="" method="post">
            <div class="row ">
                <div class=" mb-3 col-md-6">
                    <label for="nama_barang" class="form-label">Nama barang</label>
                    <input type="text" class="form-control" name="nama_barang">
                </div>
                <div class=" mb-3 col-md-6">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="number" class="form-control" name="harga_beli">
                </div>
            </div>
            <div class="row">
                <div class=" mb-3 col-md-6">
                    <label for="harga_jual" class="form-label">Harga jual</label>
                    <input type="number" class="form-control" name="harga_jual">
                </div>
                <div class=" mb-3 col-md-6">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" name="stok">
                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col text-end">
                    <button class="btn btn-secondary" type="reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3>Data Barang</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Barang</th>
                        <th>Harga beli</th>
                        <th>Harga jual</th>
                        <th>Stok</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($konek, "SELECT barang_id, nama_barang, harga_beli, harga_jual, stok FROM tbl_barang");
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?= $row["barang_id"] ?></td>
                                <td><?= $row["nama_barang"] ?></td>
                                <td>Rp. <?= number_format($row["harga_beli"], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($row["harga_jual"], 0, ',', '.') ?></td>
                                <td><?= $row["stok"] ?></td>
                                <td>
                                    <a href="#editBarang" class="text-decoration-none" data-bs-toggle="modal" data-bs-id="<?= $row["barang_id"] ?>" data-bs-name="<?= $row["nama_barang"] ?>" data-bs-buy="<?= $row["harga_beli"] ?>" data-bs-sell="<?= $row["harga_jual"] ?>" data-bs-stock="<?= $row["stok"] ?>">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </a>
                                    <a href="./modul/barang/del.php?id=<?= $row['barang_id'] ?>" class="text-decoration-none">
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

<!-- Modal -->
<div class="modal fade" id="editBarang" tabindex="-1" aria-labelledby="editBarangLabel" aria-hidden="true">
    <form action="./modul/barang/edt.php" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="id_barang">ID</label>
                        <input type="text" class="form-control" name="id_barang" id="id_barang" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nama_barang">Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="harga_beli">Harga beli</label>
                        <input type="number" class="form-control" name="harga_beli" id="harga_beli">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="harga_jual">Harga jual</label>
                        <input type="number" class="form-control" name="harga_jual" id="harga_jual">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok" id="stok">
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
    var editModal = document.getElementById('editBarang');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-bs-id');
            var name = button.getAttribute('data-bs-name');
            var buyPrice = button.getAttribute('data-bs-buy');
            var sellPrice = button.getAttribute('data-bs-sell');
            var stock = button.getAttribute('data-bs-stock');

            var modalTitle = editModal.querySelector('.modal-title');
            var idInput = editModal.querySelector('#id_barang');
            var nameInput = editModal.querySelector('#nama_barang');
            var buyPriceInput = editModal.querySelector('#harga_beli');
            var sellPriceInput = editModal.querySelector('#harga_jual');
            var stockInput = editModal.querySelector('#stok');

            modalTitle.textContent = 'Edit Barang ID ' + id;
            idInput.value = id;
            nameInput.value = name;
            buyPriceInput.value = buyPrice;
            sellPriceInput.value = sellPrice;
            stockInput.value = stock;
        });
    }
});
</script>
</div>

