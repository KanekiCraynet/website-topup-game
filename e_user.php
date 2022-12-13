<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Saya - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Profile Saya - <?php echo $s0['instansi']; ?>"/>
  <meta property="og:description" content="<?php echo $s0['deskripsi']; ?>" />
  <meta property="og:url" content="<?php echo $urlweb; ?>" />
  <meta property="og:image" content="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" />
  <meta name="resource-type" content="document" />
  <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
  <meta http-equiv="content-language" content="en-us" />
  <meta name="author" content="Maks Miliyan" />
  <meta name="contact" content="miliyan.id" />
  <meta name="copyright" content="Copyright (c) miliyan.id. All Rights Reserved." />
  <meta name="robots" content="index, nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/upload/favicon.png">

  <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.css"/>
  <!--Select Plugins-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!--Data Tables -->
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- animate CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Horizontal menu CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/horizontal-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?php echo $urlweb; ?>/assets/css/app-style.css" rel="stylesheet"/>
  <link href="<?php echo $urlweb; ?>/assets/css/style-main.css" rel="stylesheet"/>
 
</head>

<body>

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start topbar header-->
    <?php include('top_menu.php'); ?>
    <!--End topbar header-->

    <div class="clearfix pt-5"></div>
    <div class="pt-5 pb-5">
      <div class="container">
       <div class="row">
          <div class="col-lg-3">
            <div class="pt-3 pb-4">
              <h5>Profile Saya</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <?php
                    error_reporting(0);
                    if (!empty($_GET['notif'])) {
                      if ($_GET['notif'] == 1) {
                        echo '
                          <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-check"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Well done!</strong> Profil berhasil disimpan!</span>
                            </div>
                          </div>
                        ';
                      }
                    }
                  ?>
                  <form role="form" class="mt-3" action="<?php echo $urlweb; ?>/functions/edit-user.php" method="POST">
                    <div class="form-group mb-2">
                      <p class="text-white">Username</p>
                      <input type="text" name="user" class="form-control" value="<?php echo $u['user']; ?>" style="color: #fff!important;" readonly>
                    </div>
                    <div class="form-group mb-2">
                      <p class="text-white">Password</p>
                      <input type="password" name="pass" class="form-control" value="<?php echo $u['re_pass']; ?>">
                    </div>
                    <div class="form-group mb-2">
                      <p class="text-white">Nama Lengkap</p>
                      <input type="text" name="full_name" class="form-control" value="<?php echo $u['full_name']; ?>" required>
                    </div>
                    <div class="form-group mb-2">
                      <p class="text-white">Alamat Email</p>
                      <input type="text" name="email" class="form-control" value="<?php echo $u['email']; ?>" required>
                    </div>
                    <div class="form-group mb-2">
                      <p class="text-white">No. Whatsapp</p>
                      <input type="text" name="no_hp" class="form-control" value="<?php echo $u['no_hp']; ?>" required>
                    </div>
                    <div class="form-group mb-2">
                      <p class="text-white">Pin Transaksi</p>
                      <input type="password" name="pin_trx" class="form-control" value="<?php if($u['pin_trx'] != 0) { echo $u['pin_trx']; } ?>" placeholder="Masukan 6 digit Angka" required>
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Simpan</button>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	  
	  <div class="d-block d-sm-none" style="height: 30px;"></div>
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	  <!--Start footer-->
    <?php include('footer.php'); ?>
</body>
</html>
