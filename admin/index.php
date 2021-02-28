<?php
session_start();
if (!$_SESSION['login']) {
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    header("location:login.php");
    exit;
} elseif ($_SESSION['hak'] != "admin") {
    header('WWW-Authenticate: Basic realm="Restricted area"');
    header('HTTP/1.0 401 Unauthorized');
    // echo 'Text to send if user hits Cancel button';
    header("location:../login.php");
    exit;
}

include_once "../library/Db.php";
$db = new Db();
$sql = $db->sql();
$surat_masuk = $sql->query("SELECT * FROM surat_masuk")->num_rows;
$surat_keluar = $sql->query("SELECT * FROM surat_keluar")->num_rows;
$disposisi = $sql->query("SELECT * FROM disposisi")->num_rows;
$petugas = $sql->query("SELECT * FROM petugas")->num_rows;
// echo $_SESSION['hak'];
?>
<!-- include header -->
<?php include "../templates/header.php" ?>

<title>Dashboard | Zai Mail</title>

<body>
    <!-- include navbar -->
    <?php include "../templates/navbar.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- include sidebar -->
            <?php include "../templates/sidebar.php"; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="jumbotron">
                    <h2>Selamat Datang di</h2>
                    <h1 class="display-4">Marchive</h1>
                    <p class="lead">Aplikasi Pengarsipan Surat Keluar dan Masuk</p>
                    <hr class="my-4">
                    <p>Halo <?= $_SESSION['username']; ?>, anda login sebagai <?= ucfirst($_SESSION['hak']); ?></p>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fa fa-envelope fa-5x "></i>
                                <span class="display-3 float-right"><?= $surat_masuk; ?></span>
                            </li>
                            <li class="list-group-item bg-secondary">
                                <a href="suratmasuk/" class="nav-link text-white">Surat Masuk</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fa fa-envelope-open fa-5x "></i>
                                <span class="display-3 float-right"><?= $surat_keluar; ?></span>
                            </li>
                            <li class="list-group-item bg-secondary">
                                <a href="suratkeluar/" class="nav-link text-white">Surat Keluar</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fa fa-exchange fa-5x "></i>
                                <span class="display-3 float-right"><?= $disposisi; ?></span>
                            </li>
                            <li class="list-group-item bg-secondary">
                                <a href="disposisi/" class="nav-link text-white">Disposisi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fa fa-id-card fa-5x"></i>
                                <span class="display-3 float-right"><?= $petugas; ?></span>
                            </li>
                            <li class="list-group-item bg-secondary">
                                <a href="petugas/" class="nav-link text-white">Petugas</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- include footer -->
    <?php include "../templates/footer.php" ?>