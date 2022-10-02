<?php
include 'koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pinjol Trio Prot Prot</title>
    <?php
    include 'page-header/header.php'
    ?>
</head>

<body style="height:500px">

    <?php
    include 'page-navbar/navbar.php'
    ?>

    <?php
    $ambildata = mysqli_query(
        $koneksi,
        "SELECT 

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
        "
    )
    ?>

    <?php
    $tampilkanLimit = mysqli_query($koneksi, "SELECT * FROM customer LIMIT 1");
    ?>

    <div class="container">
        <div class="mt-4 p-5 bg-info text-white rounded">
            <h1>Pinjol Trio Prot Prot</h1>
        </div>
    </div>

    <div class="container" style="margin-top:80px">
        <h3>Daftar Customer</h3>
    </div>

    <div class="container box-body table-responsive">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Customer</th>
                    <th>No HP</th>
                    <th>Pinjaman</th>
                    <th>Jumlah Cicilan</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Tenggat</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($tampilkan = mysqli_fetch_array($ambildata, MYSQLI_ASSOC)) {

                ?>
                    <tr>
                        <td><?php echo $tampilkan['id_transaksi']; ?></td>
                        <td><?php echo $tampilkan['nama']; ?></td>
                        <td><?php echo $tampilkan['no_hp']; ?></td>
                        <td><?php echo 'Rp', number_format($tampilkan['jml_pinjaman']); ?></td>
                        <td><?php echo $tampilkan['jml_cicilan']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($tampilkan['tgl_pinjam'])); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($tampilkan['tgl_tenggat'])); ?></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Customer</th>
                    <th>No HP</th>
                    <th>Pinjaman</th>
                    <th>Jumlah Cicilan</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Tenggat</th>
                </tr>
            </tfoot>
        </table>
    </div>

</body>

</html>

<?php
include 'page-footer/javascript.php'
?>