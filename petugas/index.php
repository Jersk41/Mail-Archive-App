<?php
require "../library/Db.php";
// require "index.php";

$db = new Db();
$db->table = "petugas";
$pesan = "";

$data = [];

if (!empty($_GET['keyword'])) {
    $keys = $_GET['keyword'];
    // var_dump($keys);
    $db->primaryKey = "nama_depan";
    $data = $db->search($keys);
    if (!$data) {
        $pesan = "Hasil tidak ditemukan";
    }
} elseif (!empty($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $db->delete($id);
    echo "<script>alert('Data Berhasil dihapus');
    document.location.href = '../petugas/index.php';
    </script>";
} else {
    //menampilkan semua data
    $data = $db->read();
}
$no = 1;
// var_dump($data);
?>

<!-- include header dari template -->
<?php include "../templates/header.php"; ?>

<title>Data Petugas</title>

<div class="container">
    <header>
        <h1>Petugas</h1>
    </header>
    <main>
        <!-- <form action="" method="GET" target="_self">
            <input type="text" name="keyword" placeholder="Cari disini.." id="keyword">
            <button type="submit" id="search">Cari</button>
        </form> -->
        <!-- pesan error -->
        <?php if (!empty($pesan)) {
            echo $pesan;
        } ?>
        <a role="button" class="btn btn-secondary" href="tambah.php">Tambah</a>
        <table border="1" id="tableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Hak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $row) : ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["nama_depan"] ?></td>
                        <td><?= $row["nama_belakang"] ?></td>
                        <td><?= $row["username"] ?></td>
                        <td><?= password_hash($row["password"], PASSWORD_BCRYPT); ?></td>
                        <td><?= $row["hak"] ?></td>
                        <td>
                            <a href="edit.php?update=<?= $row['id'] ?>">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>">Hapus</a>
                        </td>
                    </tr>
                <?php
                    $no++;
                endforeach; ?>
            </tbody>
        </table>
        <?php
        ?>
    </main>
</div>

<script>
    const table = $('#tableData').DataTable({
        responsive: true
    });
    //
</script>
<!-- include footer dari template -->
<?php include "../templates/footer.php" ?>