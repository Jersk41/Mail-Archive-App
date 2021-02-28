<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/ManagemenSurat/<?= $_SESSION['hak'] ?>/">
                    <i class="fa fa-dashboard fa-sm"></i>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ManagemenSurat/<?= $_SESSION['hak'] ?>/petugas/">
                    <i class="fa fa-users fa-sm"></i>
                    Petugas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ManagemenSurat/<?= $_SESSION['hak'] ?>/suratmasuk/">
                    <i class="fa fa-envelope-open fa-sm"></i>
                    Surat Masuk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ManagemenSurat/<?= $_SESSION['hak'] ?>/suratkeluar/">
                    <i class="fa fa-envelope fa-sm"></i>
                    Surat Keluar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ManagemenSurat/<?= $_SESSION['hak'] ?>/disposisi/">
                    <i class="fa fa-exchange fa-sm"></i>
                    Disposisi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ManagemenSurat/logout.php">
                    <i class="fa fa-sign-out fa-sm"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>