<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php'; // untuk menghubungkan halaman index ke halaman function
$pelanggan = query("SELECT * FROM pelanggan");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $pelanggan = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Data</title>

    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
        $(window).on('scroll', function(){
            if ($(window).scrollTop()){
                $('nav').addClass('black');
            }
         })
    </script>
</head>

<body>

            <!-- navbar -->
 <nav>
    <div class="logos">
        <img src="images/logos.png">
    </div>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="index.php"  class="active">Date</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Contact</a></li>
    </ul>

    <button class="btn-logout">
        <a class="link-logout" href="logout.php">LOGOUT</a>
        </button>
</nav>
    <div class="body-table">
        <div class="tambah-data">
            
    <h1>Daftar Pelanggan</h1>

   
    
    <a class="link-tambah" href="tambah.php">Tambah data mahasiswa</a>
    </div>

    <form action="" method="post" class="cari">
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukan Nama Pelanggan" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>

    </form>
    
        <table class="content-table">
            <thead>
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>Pinjaman</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Kota</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach ($pelanggan as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <a class="link-logout" href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                        <a class="link-logout" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah anda yakin?')">Hapus</a>
                    </td>

                    <td><img src="img/<?= $row["gambar"]; ?>" width="60"></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["pinjaman"]; ?></td>
                    <td><?= $row["kota"]; ?></td>
                    <td><?= $row["pekerjaan"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
         </tbody>
        </table>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
    </div>
</body>

</html>