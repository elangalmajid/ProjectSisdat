<?php
include 'koneksi/koneksi.php';
$id         = "";
$nama       = "";
$nohp       = "";
$pinjaman   = "";
$cicilan    = "";
$pinjam     = "";
$tenggat    = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "delete from customer where id = '$id'";
    $sql2 = "delete from cicilan where id_cicilan = '$id'";
    $sql3 = "delete from transaksi where id_transaksi = '$id'";

    $q3 = mysqli_query($koneksi, $sql3);
    $q2 = mysqli_query($koneksi, $sql2);
    $q1 = mysqli_query($koneksi, $sql1);

    if ($q1 && $q2 && $q3) {
        $sukses = "Berhasil Menghapus Data";
    } else {
        $error = "Gagal Menghapus Data";
    }
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT 

    transaksi.id_transaksi ,
    transaksi.id,
    transaksi.id_cicilan, 
    
    customer.id,
    customer.nama_cust AS nama,
    customer.no_hp,

    cicilan.id_cicilan,
    cicilan.jml_pinjaman,
    cicilan.jml_cicilan,
    cicilan.tgl_pinjam,
    cicilan.tgl_tenggat


    from transaksi
    INNER JOIN customer ON transaksi.id=customer.id
    INNER JOIN cicilan ON transaksi.id_cicilan=cicilan.id_cicilan
    WHERE id_transaksi = '$id'
    ";

    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id         = $r1['id'];
    $nama       = $r1['nama'];
    $nohp       = $r1['no_hp'];
    $pinjaman   = $r1['jml_pinjaman'];
    $cicilan    = $r1['jml_cicilan'];
    $pinjam     = $r1['tgl_pinjam'];
    $tenggat    = $r1['tgl_tenggat'];

    if ($nohp = '') {
        $error = "Data Tidak Ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $pinjaman = $_POST['pinjaman'];
    $cicilan = $_POST['cicilan'];
    $pinjam = $_POST['pinjam'];
    $tenggat = $_POST['tenggat'];

    if ($nama && $nohp && $pinjaman && $pinjam && $cicilan && $tenggat) {
        if ($op == 'edit') {
            $sql1 = "update customer set nama_cust = '$nama', no_hp = '$nohp' where id = '$id'";
            $sql2 = "update cicilan set jml_pinjaman = '$pinjaman', jml_cicilan = '$cicilan', tgl_pinjam = '$pinjam', tgl_tenggat = '$tenggat' where id_cicilan = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            $q2 = mysqli_query($koneksi, $sql2);

            if ($q1 && $q2) {
                $sukses = "Data Berhasil Diupdate";
            } else {
                $error = "Data Gagal Diupdate";
            }
        } else {
            $q1 = mysqli_query($koneksi, "INSERT INTO customer values ('$id', '$nama', '$nohp')");
            $q2 = mysqli_query($koneksi, "INSERT INTO cicilan values ('$id', '$pinjaman', '$cicilan', '$pinjam', '$tenggat', '$id')");
        //    $q3 = mysqli_query($koneksi, "INSERT INTO cicilan(id) SELECT id FROM customer");
            $q4 = mysqli_query($koneksi, "INSERT INTO transaksi values ('$id', '$id', '$id')");
            if ($q1 && $q2 && $q4) {
                $sukses = "Pendaftaran Berhasil";
            } else {
                $error = "Pendaftaran Gagal";
            }
        }
    } else {
        $error = "Silahkan Isikan Data Anda";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 15px;
        }
    </style>
</head>

<body style="height: 500px;">
    <?php
    include 'page-navbar/navbar.php'
    ?>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / Edit
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="id" class="col-sm-2 col-form-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nohp" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nohp" name="nohp" value="<?php echo $nohp ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pinjaman" class="col-sm-2 col-form-label">Jumlah Pinjaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pinjaman" name="pinjaman" value="<?php echo $pinjaman ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cicilan" class="col-sm-2 col-form-label">Cicilan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="cicilan" id="cicilan">
                                <option value="">- Pilih Jumlah Cicilan</option>
                                <option value="1" <?php if ($cicilan == "1") echo "selected" ?>>1 Bulan</option>
                                <option value="3" <?php if ($cicilan == "3") echo "selected" ?>>3 Bulan</option>
                                <option value="6" <?php if ($cicilan == "6") echo "selected" ?>>6 Bulan</option>
                                <option value="12" <?php if ($cicilan == "12") echo "selected" ?>>12 Bulan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="pinjam" name="pinjam" value="<?php echo $pinjam ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tenggat" class="col-sm-2 col-form-label">Tanggal Tenggat</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="tenggat" name="tenggat" value="<?php echo $tenggat ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Data Customer
            </div>
            <div class="card-body">
                <table class="table">
                    <th>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Pinjaman</th>
                            <th scope="col">Jumlah Cicilan</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Tenggat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        <tbody>
                            <?php
                            $sql1 = "SELECT 

                                transaksi.id_transaksi ,
                                transaksi.id,
                                transaksi.id_cicilan, 
                                
                                customer.id,
                                customer.nama_cust AS nama,
                                customer.no_hp,
                        
                                cicilan.id_cicilan,
                                cicilan.jml_pinjaman,
                                cicilan.jml_cicilan,
                                cicilan.tgl_pinjam,
                                cicilan.tgl_tenggat
                        
                        
                                from transaksi
                                INNER JOIN customer ON transaksi.id=customer.id
                                INNER JOIN cicilan ON transaksi.id_cicilan=cicilan.id_cicilan
                                ";

                            $q5 = mysqli_query($koneksi, $sql1);
                            while ($r2 = mysqli_fetch_array($q5, MYSQLI_ASSOC)) {
                                $id = $r2['id_transaksi'];
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $r2['id']; ?></td>
                                    <td scope="row"><?php echo $r2['nama']; ?></td>
                                    <td scope="row"><?php echo $r2['no_hp']; ?></td>
                                    <td scope="row"><?php echo 'Rp', number_format($r2['jml_pinjaman']); ?></td>
                                    <td scope="row"><?php echo $r2['jml_cicilan']; ?></td>
                                    <td scope="row"><?php echo date('d-m-Y', strtotime($r2['tgl_pinjam'])); ?></td>
                                    <td scope="row"><?php echo date('d-m-Y', strtotime($r2['tgl_tenggat'])); ?></td>
                                    <td scope="row">
                                        <a href="form-daftar.php?op=edit&id=<?php echo $id ?>">
                                            <button type="button" class="btn btn-info">Edit</button>
                                        </a>
                                        <a href="form-daftar.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Delete Data?')">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </th>
                </table>
            </div>
        </div>
    </div>
</body>

</html>