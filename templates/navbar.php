<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark shadow">
        <a class="navbar-brand" href="#">Marchive</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/ManagemenSurat/<?= $_SESSION['hak'] ?>/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Master</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ManagemenSurat/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>