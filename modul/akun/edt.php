<?php
include_once "../../koneksi.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_REQUEST['id_akun'])){
        $acc_id = $_REQUEST['id_akun'];
        $acc_name =  $_REQUEST['nama_akun2'];
        $acc_type =  $_REQUEST['jenis_akun2'];
        $saldo_type =  $_REQUEST['type_saldo2'];
        $query = "UPDATE tbl_akun SET nama_akun='$acc_name', jenis_akun='$acc_type', tipe_saldo = '$saldo_type' WHERE akun_id = $acc_id"; 
        if (mysqli_query($konek, $query)) {
            echo "<script type='text/javascript'>
                window.location.href='../../dashboard.php?modul=akun';
            </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($konek);
        }
    }else{
        echo "ID AKUN NYA MASUKIN DULU TOLO";
    }
}