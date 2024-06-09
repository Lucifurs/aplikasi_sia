<?php
include_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice = $_POST['invoice'];
    $tanggal = $_POST['tanggal'];
    $suplier = $_POST['suplier'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $total = $jumlah * $harga;
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO tbl_pembelian (
        pembelian_id ,
        tanggal_pembelian,
        suplier_id,
        jumlah,
        harga,
        total_pembelian,
        keterangan
        ) VALUES (
            '$invoice',
            '$tanggal',
            '$suplier',
            '$jumlah',
            '$harga',
            '$total',
            '$keterangan'
        )";
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data pembelian berhasil disimpan.'); window.location.href='./dashboard.php?modul=pembelian';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>

<div class="card mb-3">
    <div class="card-body">
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="invoice" class="form-label">Invoice</label>
                    <input type="text" class="form-control" name="invoice">
                </div>
                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
                <div class="col-md-4">
                    <label for="suplier" class="form-label">Suplier</label>
                    <select name="suplier" class="form-select">
                        <?php
                            $query_suplier = "SELECT * FROM tbl__suplier";
                            $result_suplier = mysqli_query($konek, $query_suplier);
                            while ($row_suplier = mysqli_fetch_assoc($result_suplier)) {
                                echo "<option value='" . $row_suplier['suplier_id'] . "'>" . $row_suplier['nama_suplier'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah">
                </div>
                <div class="col-md-4">
                    <label for="harga" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text"></span>
                        <input type="number" class="form-control" name="harga">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="total" class="form-label">Total</label>
                    <div class="input-group">
                        <span class="input-group-text"></span>
                        <input type="number" class="form-control" name="total" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
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
        <h3>Data Pembelian</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Suplier</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query_data = "SELECT p.*, s.nama_suplier FROM tbl_pembelian p JOIN tbl__suplier s ON p.suplier_id = s.suplier_id";
                        $result_data = mysqli_query($konek, $query_data);
                        $count = 1;
                        while ($row_data = mysqli_fetch_assoc($result_data)) {?>
                            <tr>
                            <td><?= $count ?></td>
                            <td><?= $row_data['pembelian_id'] ?></td>
                            <td><?= $row_data['tanggal_pembelian'] ?></td>
                            <td><?= $row_data['nama_suplier'] ?></td>
                            <td><?= $row_data['jumlah'] ?></td>
                            <td><?= $row_data['harga'] ?></td>
                            <td><?= $row_data['total_pembelian'] ?></td>
                            <td><?= $row_data['keterangan'] ?></td>
                            <td>
                                <a href='#editPembelian' class='text-decoration-none' data-bs-toggle='modal'><i class='bi bi-pencil-square text-success'></i></a>
                                <a href='' class='text-decoration-none'><i class='bi bi-trash text-danger'></i></a>
                            </td>
                            </tr>
                            <?php
                            $count++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

