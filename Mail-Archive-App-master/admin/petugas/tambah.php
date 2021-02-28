<form action="" method="post" class="form-group-row">
    <div class="modal-body">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" name="id" id="">
        </div>
        <div class="form-group">
            <label for="namaDepan">Nama Depan</label>
            <input type="text" class="form-control" name="nama_depan" id="namaDepan">
        </div>
        <div class="form-group">
            <label for="namaBelakang">Nama Belakang</label>
            <input type="text" class="form-control" name="nama_belakang" id="namaBelakang">
        </div>
        <div class="form-group">
            <label for="userName">Username</label>
            <input type="text" class="form-control" name="username" id="">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" minlength="5" maxlength="16" id="password">
        </div>
        <div class="form-group">
            <label for="hak">Hak</label>
            <select name="hak" class="form-control" id="">
                <option value="">Pilih disini</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </div>
</form>

<?php
include_once dirname(__FILE__, 3) . "../library/Db.php";

if (isset($_POST['submit'])) {
    // Buat koneksi 
    $db = new Db();
    $db->table = "petugas";

    $id = htmlspecialchars($_POST['id']);
    $nama_depan = htmlspecialchars($_POST['nama_depan']);
    $nama_belakang = htmlspecialchars($_POST['nama_belakang']);
    $username = strtolower(stripslashes($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $hak = htmlspecialchars($_POST['hak']);
    // simpan data pada array
    $data = [
        $id,
        $nama_depan,
        $nama_belakang,
        $username,
        $password,
        $hak
    ];
    // lakukan insert dengan memanggil method add
    $pesan = $db->add($data);
    if ($pesan) {
        // jika true akan 
        echo "<script>alert('Data Berhasil ditambahkan');
        document.location.href = '../petugas/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan');
        document.location.reload;
        </script>";
    }
}

?>