<?php
require "../library/Db.php";
// require "index.php";

$db = new Db();
$db->table = "disposisi";
$data = [];

if (!empty($_GET['keyword'])) {
    $keys = $_GET['keyword'];
    // var_dump($keys);
    $db->primaryKey = "keterangan";
    $data = $db->search($keys);
    if (!$data) {
        $pesan = "Hasil tidak ditemukan";
    }
} elseif (!empty($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $db->primaryKey = 'no_disposisi';
    if ($db->delete($id)) {
        echo "<script>alert('Data Berhasil dihapus');
        document.location.href = '../disposisi/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Berhasil dihapus');
        document.location.href = '../disposisi/index.php';
        </script>";
    }
} else {
    //menampilkan semua data
    $data = $db->read();
}
$no = 1;
// var_dump($data);
?>

<!-- include header dari template -->
<?php include_once "../templates/header.php"; ?>
<title>Data Disposisi</title>

<div class="container">
    <header>
        <h1>Disposisi</h1>
    </header>
    <main>
        <!-- <form action="" method="GET" target="_self">
            <input type="text" name="keyword" placeholder="Cari disini.." id="keyword">
            <button type="submit" id="search">Cari</button>
        </form> -->
        <a href="tambah.php">Tambah</a>
        <table border="1" id="tableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Disposisi</th>
                    <th>No Agenda</th>
                    <th>No Surat</th>
                    <th>Kepada</th>
                    <th>Keterangan</th>
                    <th>Status Surat</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $row) : ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row["no_disposisi"] ?></td>
                        <td><?= $row["no_agenda"] ?></td>
                        <td><?= $row["no_surat"] ?></td>
                        <td><?= $row["kepada"] ?></td>
                        <td><?= $row["keterangan"] ?></td>
                        <td><?= $row["status_surat"] ?></td>
                        <td><?= $row["tanggal"] ?></td>
                        <td>
                            <a href="edit.php?update=<?= $row["no_disposisi"]; ?>">Edit</a>
                            <a href="?delete=<?= $row["no_disposisi"]; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php
                    $no++;
                endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

<script>
    window.$('#tableData').DataTable({
        responsive: true
    });
</script>
<!-- include footer dari template -->
<?php include "../templates/footer.php" ?>