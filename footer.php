    <footer id="aboutus" class="bg-footer" style="padding-top: 25px; padding-bottom: 10px;">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 text-footer">
            <img class="pb-2" src="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" style="width: auto; height: 40px; margin: 0 auto;" alt="logo icon">
            <p>Top Up Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, dll. Buka 24 Jam Top Up Kilat Proses 1 Detik Murah, Aman, dan Terpercaya</p>
            <p>Whatsapp: <a href="https://wa.me/<?php echo $s1b['no_hp']; ?>" target="_blank" style="color: #666666"><?php echo $s1b['no_hp']; ?></a></p>
            <p>Email: <?php echo $s1b['email']; ?></p>
            <p>Online : 09:00 - 23:00 WIB</p>
            <a href="<?php echo $s1a['instagram']; ?>" style="font-size: 35px; color: #666666!important"><i class="bi bi-instagram pr-4"></i></a>
            <a href="<?php echo $s1a['youtube']; ?>" style="font-size: 35px; color: #666666!important"><i class="bi bi-youtube pr-4"></i></a>
            <a href="<?php echo $s1a['facebook']; ?>" style="font-size: 35px; color: #666666!important"><i class="bi bi-facebook pr-4"></i></a>
            <a href="<?php echo $s1a['twitter']; ?>" style="font-size: 35px; color: #666666!important"><i class="bi bi-twitter"></i></a>
            <hr>
          </div>
          <div class="col-lg-3 col-sm-3 col-12" bis_skin_checked="1">
            <h5 class="pb-2" style="color:#ff962d;">Top Up Game Lainnya</h5>
            <ul class="nav flex-column mb-4">
                <?php
                    $sql_page = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE parent = 0 ORDER BY rand() LIMIT 5") or die(mysqli_error());
                    while($sp = mysqli_fetch_array($sql_page)){
                ?>
                <li class="nav-item">
                   <a class="nav-link text-footer" style="color:#666666" href="<?php echo $urlweb; ?>/game/<?php echo $sp['slug']; ?>/"><i class="bi bi-dot" style="width: 20px;"></i> <?php echo $sp['kategori']; ?></a>
                </li>
                <?php } ?>
            </ul>
          </div>
          <div class="col-sm-3 col-12">
            <h5 class="pb-2 text-footer" style="color:#ff962d;">Menu</h5>
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link text-footer" style="color:#666666" href="<?php echo $urlweb; ?>"><i class="bi bi-dot pr-2" style="width: 20px;"></i> Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-footer" style="color:#666666" href="<?php echo $urlweb; ?>/cektrx/"><i class="bi bi-dot pr-2" style="width: 20px;"></i> Cek Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-footer" style="color:#666666" href="<?php echo $urlweb; ?>/syarat-ketentuan/"><i class="bi bi-dot pr-2" style="width: 20px;"></i> Syarat & Ketentuan</a>
                </li>
                <?php
                    $sql_page = mysqli_query($conn,"SELECT * FROM `tb_page` ORDER BY id ASC") or die(mysqli_error());
                    while($sp = mysqli_fetch_array($sql_page)){
                ?>
                <?php
                    }
                    if(isset($_SESSION['user'])){} else {
                ?>
                <?php } ?>
            </ul>
          </div>
          <div class="col-sm-12">
            <hr>
          </div>
          <div class="col-sm-6">
            <p class="mt-2 text-footer">© Copyright <?php echo date('Y'); ?>. All Rights Reserved</p>
          </div>
        </div>
      </div>
    </footer>
    <!--End footer-->
  
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo $urlweb; ?>/assets/js/jquery.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/js/popper.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/js/bootstrap.min.js"></script>
  
  <!-- simplebar js -->
  <script src="<?php echo $urlweb; ?>/assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- horizontal-menu js -->
  <script src="<?php echo $urlweb; ?>/assets/js/horizontal-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="<?php echo $urlweb; ?>/assets/js/app-script.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
  <!--Select Plugins Js-->
  <script src="<?php echo $urlweb; ?>/assets/plugins/select2/js/select2.min.js"></script>
  <!--Data Tables js-->
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
  <script>
    $(document).ready(function() {
      //Default data table
      $('#default-datatable').DataTable();
    });
    function openNav() {
      document.getElementById("mySidenav").style.width = "300px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>