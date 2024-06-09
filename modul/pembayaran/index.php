<?php
include_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice = $_POST['invoice'];
    $tanggal = $_POST['tanggal'];
    $total = $_POST['total'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO tbl_pembayaran (
        pembayaran_id ,
        tanggal_pembayaran,
        jumlah_pembayaran,
        keterangan
        ) VALUES (
            '$invoice',
            '$tanggal',
            '$total',
            '$keterangan',
        )";
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pembelian berhasil disimpan.'); window.location.href='./dashboard.php?modul=pembayaran';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>
<div>
    <div class="card-body">
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="invoice" class="form-label">Invoice</label>
                    <input type="text" class="form-control" name="invoice">
                </div>
                <div class="col-md-6">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="total" class="form-label">Total</label>
                    <div class="input-group">
                        <span class="input-group-text"></span>
                        <input type="number" class="form-control" name="total">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan">
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
        <h3>Data Pembayaran</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $result = mysqli_query($konek, "SELECT pembayaran_id, tanggal_pembayaran, jumlah_pembayaran, keterangan FROM tbl_pembayaran");
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?= $row["pembayaran_id "] ?></td>
                                <td><?= $row["tanggal_pembayaran"] ?></td>
                                <td><?= $row["jumlah_pembayaran"] ?></td>
                                <td><?= $row["keterangan"] ?></td>
                                <td>
                                    <a href="#editPembayaran" class="text-decoration-none" data-bs-toggle="modal" data-bs-id="<?= $row["pembayaran_id"] ?>" data-bs-date="<?= $row["tanggal_pembayaran"] ?>" data-bs-jumlah="<?= $row["jumlah_pembayaran"] ?>" data-bs-ket="<?= $row["keterangan"] ?>"">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </a>
                                    <a href="./modul/pelanggan/del.php?id=<?= $row['pembayaran_id'] ?>" class="text-decoration-none">
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