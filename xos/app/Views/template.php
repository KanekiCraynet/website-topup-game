<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $web['description']; ?>">
        <meta name="keywords" content="<?= $web['keywords']; ?>">
        <meta name="author" content="<?= $web['author']; ?>">
        <meta name="theme-color" content="#000000">
        
        <!-- Title -->
        <title><?= $web['title']; ?> - <?= $web['author']; ?></title>

        <link rel="shortcut icon" href="<?= $web['icon']; ?>">
        
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&amp;display=swap" rel="stylesheet">
        <link href="<?= base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>/assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
        <link href="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Theme Styles -->
        <link href="<?= base_url(); ?>/assets/css/main.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>/assets/css/custom.css" rel="stylesheet">


        <style>
        .fa-icon {
  font-family: 'Font Awesome 5 Free';
}
            #toolbarContainer {
                display: none;
            }
            input {
                border: none;
            }
            .form-control {
                border: none;
            }
            .of-game {
                width: 100%;
                display: inline-block;
                padding-bottom: 30px;
                vertical-align: top;
                margin-bottom: 12px;
            }
            .of-game img {
                border-radius: 18px;
                height: 110px;
                object-fit: cover;
            }
            .of-game p {
                line-height: 18px;
                font-size: 14px;
                color: #fff;
            }
            .cursor-pointer {
                cursor: pointer;
            }
            .lib {
                border-top: 4px solid #fdc82f;
                height: 2px;
                width: 60px;
                margin-bottom: 25px;
                border-radius: 5px;
            }
            .lib-dot {
                border-top: 4px solid #fdc82f;
                height: 2px;
                width: 10px;
                margin-left: 5px;
                margin-bottom: 25px;
                border-radius: 5px;
            }
            .card-number {
                position: absolute;
                width: 45px;
                height: 45px;
                text-align: center;
                line-height: 38px;
                border-top-left-radius: 15px;
                font-size: 18px;
                font-weight: bold;
                margin-top: -30px;             
                margin-left: -30px;
            }
            .card-name {
                margin-bottom: 15px;
                font-size: 16px;
            }
            .produk-list {
                height: auto;
                padding: 10px;
                border-radius: 6px !important;
            }
            .metode-list {
                border-radius: 6px !important;
            }
            .hide {
                display: none;
            }
            .metode-list {
                overflow: hidden !important;
            }
            #method-select {
                display: inline-block;
                width: 60px;
                height: 80px;
                position: relative;
                float: right;
                margin-top: -64px;
                transform: rotate(45deg);
                margin-right: -60px;
            }
            method-select {
                display: inline-block;
                width: 60px;
                height: 80px;
                position: relative;
                float: right;
                margin-top: -64px;
                transform: rotate(45deg);
                margin-right: -60px;
            }
            .carousel-control-next, .carousel-control-prev {
                border: none;
                background: transparent;
            }
            .nav-item .nav-link {
                background: transparent;
            }
            .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
                border-bottom: 1px solid #dee2e6 !important;
            }
            button {
                outline: none !important;
            }

            @media only screen and (max-width: 768px) {
                #rincian-game {
                    display: none;
                }
                .margin-none-m:nth-child(odd) {
                    padding-right: 7px;
                }
                .margin-none-m:nth-child(even) {
                    padding-left: 7px;
                }
                .produk-list {
                    padding: 12px;
                }
                #btn-cek {
                    margin-top: 15px;
                }
            }
            @media only screen and (max-width: 425px) {
                .of-game {
                    width: 100%;
                    margin: 0;
                }
            }
            
            
            .btn {
                border: none!important;
                padding: 8px 40px;
                border-radius: 100px;
                font-weight: 500;
            }
            @media screen and (max-width: 625px) {
                .logo-img, .mb-2-mobile {
                    margin-bottom: 20px;
                }
            }
            .menu {
                padding-top: 46px;
            }
            @media screen and (max-width: 625px) {
                .menu {
                    padding-top: 18px;
                }
            }
            .menu-right, .method h6 {
                float: right;
            }
            @media screen and (max-width: 625px) {
                .menu-right {
                    float: none;
                }
            }
            .search {
                width: 385px;
            }
            @media screen and (max-width: 625px) {
                .search {
                    width: 83%;
                }
            }
            .search input {
                border: none;
            }
            .form-control-s {
                padding: 12px 24px;
                border-radius: 100px;
            }
            .btn, .form-control-s, .toast, button.accordion-button {
                box-shadow: none!important;
            }
            .btn, .form-control-s, button.accordion-button {
                outline: 0!important;
                box-shadow: none!important;
            }
            .btn, .form-control-s, body {
                font-size: 14px;
            }
            .search button {
                float: right;
                border-radius: 100px;
                margin-top: -41px;
            }
            .category ul li img, .search button {
                margin-right: 4px;
            }
            .menu-right .dropdown-menu {
                background: #34373c;
                color: #fff;
                width: 274px;
                border-radius: 16px;
                margin-right: 100px;
            }
            @media screen and (max-width: 625px) {
                .menu-right .dropdown {
                    width: 14%;
                    text-align: right;
                }
            }
            .dropstart .dropdown-toggle::before {
                display: inline-block;
                margin-right: 0.255em;
                vertical-align: 0.255em;
                content: "";
                border-top: none;
                border-right: none;
                border-bottom: none;
            }
            .dropdown-menu.show {
                display: block;
            }
            .menu-right .dropdown-menu.show {
                border: none;
                padding: 16px;
                transform: translate(-234px,60px)!important;
            }
            .menu-right .dropdown-menu .dropdown-item i {
                font-size: 18px;
                margin-right: 8px;
            }
            .menu-right .dropdown-menu .dropdown-auth, .menu-right .dropdown-menu .dropdown-item {
                padding: 12px;
                color: #fff;
            }
            .menu-right .dropdown-menu .dropdown-item:hover {
                background: #FEC832;
                border-radius: 10px;
                color: #000;
            }
            
            .nav-item button {
                border: none;
                color: #fff;
            }
.nav-link:not(.active) {
    background-color: #34373c!important;
  }            
.nav-link.active {
    background-color: #fdc82f!important;
    color: #000!important;
}
.overflow-x-wrapper {
  overflow-x: auto;
  white-space: nowrap;
}
           
        </style>
        
        

    </head>
    <body>
    
        
<div class="container">
    <div class="menu">
        <div class="row">
            <div class="col-md-4">
                <a href="<?= base_url(); ?>">
                    <img src="<?= $web['logo']; ?>" alt="" class="logo-img" width="168">
                </a>
            </div>
            <div class="col-md-8">
                <div class="menu-right">
                    <div class="search d-inline-block">
                        <form action="<?= base_url(); ?>/search" method="GET">
                            <input type="text" class="form-control form-control-s" placeholder="Cari Games" name="s" autocomplete="off" value="">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </div>
                    <div class="dropdown d-inline-block dropstart">
                        <div class="dropdown-toggle ms-3 cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url(); ?>/assets/images/icon/menu.png" alt="" width="22">
                        </div>
                        <ul class="dropdown-menu">
                            <?php if ($users !== false): ?>
                                <?php if ($users['level'] === 'Admin'): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin">
                                            <i class="fa-solid fa-house"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/config">
                                            <i class="fa-solid fa-gear"></i>
                                            Konfigurasi Web
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/page">
                                            <i class="fa-regular fa-file-lines"></i>
                                            Konfigurasi Halaman
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/games">
                                            <i class="fa-solid fa-gamepad"></i>
                                            Kelola Game
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/product">
                                            <i class="fa-solid fa-list"></i>
                                            Kelola Produk
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/product/category">
                                            <i class="fa-solid fa-grip-lines"></i>
                                            Kelola Kategori
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/topup">
                                            <i class="fa-solid fa-sack-dollar"></i>
                                            Kelola Deposit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/payment">
                                            <i class="fa-solid fa-money-bill-transfer"></i>
                                            Kelola Pembayaran
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/users">
                                            <i class="fa-solid fa-users"></i>
                                            Kelola User
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/admin/orders">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                            Kelola Pembelian
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/profile">
                                            <i class="fa-solid fa-user"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/status">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            Cek Transaksi
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/logout">
                                            <i class="fa-solid fa-right-to-bracket"></i>
                                            Logout
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>">
                                            <i class="fa-solid fa-house"></i>
                                            Beranda
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/status">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            Cek Transaksi
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/deposit">
                                            <i class="fa-solid fa-sack-dollar"></i>
                                            Deposit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/profile">
                                            <i class="fa-solid fa-user"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>/logout">
                                            <i class="fa-solid fa-right-to-bracket"></i>
                                            Logout
                                        </a>
                                    </li>
                                <?php endif ?>
                            <?php else: ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url(); ?>">
                                        <i class="fa-solid fa-house"></i>
                                        Beranda
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url(); ?>/status">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        Cek Transaksi
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
        
        <div class="page-container">       
            <div class="page-content">
                <div class="main-wrapper">
                    <?php $this->renderSection('konten'); ?>           
                
                <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/cara-membeli" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="bookmark"></i>
                                                <h5>Cara Membeli</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/faq" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="info"></i>
                                                <h5>Pertanyaan Umum</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/terms" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="tag"></i>
                                                <h5>Syarat & Ketentuan</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= base_url(); ?>/bantuan" class="text-dark">
                                        <div class="card bg-coklat">
                                            <div class="card-body text-center text-white">
                                                <i class="mb-4" data-feather="phone"></i>
                                                <h5>Bantuan</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                          
                    
            <footer>    
              <div class="text-center pt-2 pb-4">© Copyright <?php echo date('Y'); ?> - <?= $web['title']; ?>
              </div>
            </footer>
        </div>
        <!-- Javascripts -->
        <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="<?= base_url(); ?>/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/main.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/cek-rekening.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/pages/datatables.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <?php if ($users !== false): ?>
        <?php if ($users['level'] === 'Admin'): ?>
        <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-coklat">
                    <div class="modal-body pt-5">
                        <div class="float-start me-4">
                            <img src="<?= base_url(); ?>/assets/images/alert.png" alt="" width="60">
                        </div>
                        <div>
                            <h5>Anda yakin?</h5>
                            <p>Data akan dihapus permanen</p>
                        </div>
                    </div>
                    <div class="modal-footer mt-0 pt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a id="btn-delete" class="btn btn-primary">Tetap Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <?php $this->renderSection('js'); ?>

        <script>
            
            <?php if ($users !== false): ?>
            <?php if ($users['level'] === 'Admin'): ?>
            function hapus(link) {
                $("#btn-delete").attr('href', link);
                var myModal = new bootstrap.Modal(document.getElementById('modal-delete'));
                myModal.show();
            }
            <?php endif; ?>
            <?php endif; ?>

            function sidebar_nav(nav_action) {
                if (nav_action == 'home') {
                    $("#box-home").removeClass('d-none');
                    $("#box-daftar").addClass('d-none');
                    $("#box-masuk").addClass('d-none');
                    $("#box-reset").addClass('d-none');
                } else if (nav_action == 'masuk') {
                    $("#box-home").addClass('d-none');
                    $("#box-daftar").addClass('d-none');
                    $("#box-reset").addClass('d-none');
                    $("#box-masuk").removeClass('d-none');
                } else if (nav_action == 'reset') {
                    $("#box-home").addClass('d-none');
                    $("#box-daftar").addClass('d-none');
                    $("#box-masuk").addClass('d-none');
                    $("#box-reset").removeClass('d-none');
                } else {
                    $("#box-home").addClass('d-none');
                    $("#box-daftar").removeClass('d-none');
                    $("#box-masuk").addClass('d-none');
                    $("#box-reset").addClass('d-none');
                }
            }
        </script>
    </body>
</html>