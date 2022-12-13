<?php
ob_start();
session_start();
include('config/koneksi.php');
$sid = session_id();
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$urlwebs = $s0['urlweb'];
$pengguna = $s0['user'];
$sql_1a = mysqli_query($conn,"SELECT * FROM `tb_social` WHERE user = '$pengguna'") or die(mysqli_error());
$s1a = mysqli_fetch_array($sql_1a);
$sql_1b = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$pengguna'") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1b);
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');
$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Beranda', '$pengguna')") or die (mysqli_error());

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="<?php echo $s0['instansi']; ?>"/>
  <meta property="og:description" content="<?php echo $s0['deskripsi']; ?>" />
  <meta property="og:url" content="<?php echo $urlweb; ?>" />
  <meta property="og:image" content="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" />
  <meta name="resource-type" content="document" />
  <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
  <meta http-equiv="content-language" content="en-us" />
  <meta name="author" content="KanekiCraynet " />
  <meta name="contact" content="kurozpedia.my.id" />
  <meta name="copyright" content="Copyright (c) kurozpedia.my.id. All Rights Reserved." />
  <meta name="robots" content="index, nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>">
  
  <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.css"/>
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
  <!-- Custom Style--> 
</head>

<body>

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start topbar header-->
    <?php include('top_menu.php'); ?>
    <!--End topbar header-->

    <div class="clearfix" style="padding-bottom: 5rem;"></div>
    <div id="carousel-1" class="carousel slide d-none d-sm-block p-3" data-ride="carousel" style="max-width: 920px;margin: auto;">
  		<div class="container">
  			<ol class="carousel-indicators">
  		        <?php
  				  $sql_21 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
  				  $nos=0;
  				  while($s21 = mysqli_fetch_array($sql_21)){
  				      $nos++;
  				      $a = $nos - 1;
  				?>
                <li data-target="#carousel-1" data-slide-to="<?php echo $a; ?>"<?php if($nos == 1){ echo ' class="active"'; } ?>></li>
                <?php } ?>
            </ol>
  			<div class="carousel-inner" style="border-radius:16px;">
  				<?php
  				  $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
  				  $no=0;
  				  while($s2 = mysqli_fetch_array($sql_2)){
  				      $no++;
  				?>
  				<div class="carousel-item<?php if($no == 1){ echo ' active'; } ?>" style="border-radius: 10px !important;">
  				  <img style="max-height: 350px;" class="d-block w-100" src="<?php echo $urlweb; ?>/upload/<?php echo $s2['image']; ?>" style="border-radius: 10px !important;" alt="First slide">
  				</div>
  				<?php } ?>
  			</div>
  		</div>
  	</div>
    <div id="carousel-1" class="carousel slide d-block d-sm-none" data-ride="carousel" style="max-width: 920px;margin: auto;">
  		<div class="container">
  			<ol class="carousel-indicators">
  		        <?php
  				  $sql_21 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
  				  $nos=0;
  				  while($s21 = mysqli_fetch_array($sql_21)){
  				      $nos++;
  				      $a = $nos - 1;
  				?>
                <li data-target="#carousel-1" data-slide-to="<?php echo $a; ?>"<?php if($nos == 1){ echo ' class="active"'; } ?>></li>
                <?php } ?>
            </ol>
  			<div class="carousel-inner" style="border-radius:16px;">
  				<?php
  				  $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
  				  $no=0;
  				  while($s2 = mysqli_fetch_array($sql_2)){
  				      $no++;
  				?>
  				<div class="carousel-item<?php if($no == 1){ echo ' active'; } ?>">
  				  <img style="max-height: 350px;" class="d-block w-100" src="<?php echo $urlweb; ?>/upload/<?php echo $s2['image']; ?>" alt="First slide">
  				</div>
  				<?php } ?>
  			</div>
  		</div>
  	</div>

    <div class="container pt-5 pb-4">
      <div class="row">
        <div class="col-sm-6 col-12">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="topup-tab" data-toggle="tab" href="#topup" role="tab" aria-controls="topup" aria-selected="true" style="font-size: 12px;">
                TOP UP GAME
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="true" style="font-size: 12px;">
                LAINNYA
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="pb-4">
      <div class="container">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active p-3" id="topup" role="tabpanel" aria-labelledby="topup-tab">
            <div class="row game">
          <?php
            $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE parent = 0 ORDER BY kategori ASC") or die(mysqli_error());
            while($s3 = mysqli_fetch_array($sql_3)){
          ?>
          <div class="col-sm-3 col-lg-2 col-4 text-center">
            <div class="card shadow-sm">
              <a href="<?php echo $urlweb; ?>/game/<?php echo $s3['slug']; ?>/" class="product_list">
                <div class="card-game" bis_skin_checked="1">
                  <img src="<?php echo $urlweb; ?>/upload/<?php echo $s3['image']; ?>" class="img-fluid" style="display: block;">
                </div>
                <div class="card-title" bis_skin_checked="1">
                  <?php echo $s3['kategori']; ?>
                </div>
                <div class="card-subtitle" bis_skin_checked="1">
                  
                </div>
                <div class="card-topup" bis_skin_checked="1">
                  <div class="btn-topup" style="font-size: 0.60rem!important;" bis_skin_checked="1">
                    TOP UP
                  </div>
                </div>
              </a>
            </div>
          </div>
          <?php } ?>
        </div>
          </div>

          <div class="tab-pane fade p-3" id="social" role="tabpanel" aria-labelledby="social-tab">
            <div class="row game">
          <?php
            $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE parent = 2 ORDER BY kategori ASC") or die(mysqli_error());
            while($s3 = mysqli_fetch_array($sql_3)){
          ?>
          <div class="col-sm-3 col-lg-2 col-4 text-center">
            <div class="card shadow-sm">
              <a href="<?php echo $urlweb; ?>/game/<?php echo $s3['slug']; ?>/" class="product_list">
                <div class="card-game" bis_skin_checked="1">
                  <img src="<?php echo $urlweb; ?>/upload/<?php echo $s3['image']; ?>" class="img-fluid" style="display: block;">
                </div>
                <div class="card-title" bis_skin_checked="1">
                  <?php echo $s3['kategori']; ?>
                </div>
                <div class="card-subtitle" bis_skin_checked="1">
                  
                </div>
                <div class="card-topup" bis_skin_checked="1">
                  <div class="btn-topup" style="font-size: 0.60rem!important;" bis_skin_checked="1">
                    TOP UP
                  </div>
                </div>
              </a>
            </div>
          </div>
          <?php } ?>
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
