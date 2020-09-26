<?php
require '../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM pelanggan
WHERE 
    pinjaman LIKE '%$keyword%' OR
    nama LIKE '%$keyword%' OR
    pekerjaan LIKE '%$keyword%' OR
    kota LIKE '%$keyword%'";
$pelanggan = query($query);
?>
<table border="3" cellpadding="11" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Pinjaman</th>
        <th>Nama</th>
        <th>Pekerjaan</th>
        <th>Kota</th>
    </tr>

    <?php $i = 1; ?>
    <?php foreach ($pelanggan as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah anda yakin?')">Hapus</a>
            </td>

            <td><img src="img/<?= $row["gambar"]; ?>" width="60"></td>
            <td><?= $row["pinjaman"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["pekerjaan"]; ?></td>
            <td><?= $row["kota"]; ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>