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

$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Cek Pesanan', '$pengguna')") or die (mysqli_error());

$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 2") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);
$merchantCode = $s4['merchant_code'];
$apiKey = $s4['api_key'];

$signe = $merchantCode.$apiKey;
$sign = md5($signe);
$created_date = date('Y-m-d H:i:s');

$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cek Status Pesanan - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Cek Status Pesanan - <?php echo $s0['instansi']; ?>"/>
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
              <h5 class="text-dark">Cek Status Pesanan</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="pb-3">
              <div class="section shadow-sm">
                <div class="card-body">
                  <form role="form" class="mb-3" action="" method="GET">
                    <p class="text-dark">No. Transaksi</p>
                    <div class="form-group mb-3">
                      <input type="text" name="trxNum" class="form-control" placeholder="Masukan No Transaksi" value="<?php if(isset($_GET['trxNum'])) { echo $_GET['trxNum']; } ?>" required>
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary" id="button-addon2">Cek Pesanan</button>
                  </form>
                  <?php
                    error_reporting(0);
                    if(isset($_GET['trxNum'])){
                      $trxNum = $_GET['trxNum'];
                      $cektrx = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$trxNum'") or die(mysqli_error());
                      $ctt = mysqli_num_rows($cektrx);
                      if($ctt == 0){
                        echo '
                          <div class="alert alert-warning alert-dismissible mb-5" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Transaksi Tidak ditemukan.</span>
                            </div>
                          </div>
                        ';
                      }
                      else {
                        $ct = mysqli_fetch_array($cektrx);
                        $trxID = $ct['trxID'];
                        $usersID = $ct['id_user'];
                        $total = $ct['sub_total'];
                        $jenis = $ct['jenis'];
                  ?>
                  <p>Transaksi Anda ditemukan, berikut adalah status pesanan dengan No. Transaksi <strong><?php echo $trxNum; ?></strong>.</p>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>No. Transaksi:</p>
                    </div>
                    <div class="col">
                      <strong><?php echo $trxNum; ?></strong>
                    </div>
                  </div>
                  <?php
                    if($ct['status'] == 0){
                  ?>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Pembayaran:</p>
                    </div>
                    <div class="col">
                      <a href="<?php echo $urlweb; ?>/payment/?trxID=<?php echo $_GET['trxNum']; ?>"><button class="btn btn-warning btn-sm"><strong>BELUM DIBAYAR</strong></button></a>
                      <small>Klik tombol di samping untuk membayar</small>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Transaksi:</p>
                    </div>
                    <div class="col">
                      <a href="#"><button class="btn btn-warning btn-sm"><strong>WAITING</strong></button></a>
                    </div>
                  </div>
                  <?php
                    }
                    else {
                      if($jenis == 1){

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://vip-reseller.co.id/api/game-feature',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => array(
                            'key' => $apiKey,
                            'sign' => $sign,
                            'type' => 'status',
                            'trxid' => $trxID
                          ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        //echo $response;
                        $hasil = json_decode($response, true);
                        if($hasil['result'] == 1){
                          $order_status = $hasil['data'][0]['status'];
                          $order_note = $hasil['data'][0]['note'];
                        }
                        else if($hasil['result'] == 0){
                          $order_status = 'failed';
                          $order_note = $hasil['message'];
                        }

                  ?>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Pembayaran:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-success btn-sm"><strong>SUDAH DIBAYAR</strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Transaksi:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-success btn-sm"><strong><?php echo $order_status; ?></strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Catatan:</p>
                    </div>
                    <div class="col">
                      <?php echo $order_note; ?>
                    </div>
                  </div>
                  <?php
                      }
                      else if($jenis == 2){
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://vip-reseller.co.id/api/prepaid',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => array(
                            'key' => $apiKey,
                            'sign' => $sign,
                            'type' => 'status',
                            'trxid' => $trxID
                          ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        //echo $response;
                        $hasil = json_decode($response, true);
                        if($hasil['result'] == 1){
                          $order_status = $hasil['data'][0]['status'];
                          $order_note = $hasil['data'][0]['note'];
                        }
                        else if($hasil['result'] == 0){
                          $order_status = 'failed';
                          $order_note = $hasil['message'];
                        }
                  ?>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Pembayaran:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-success btn-sm"><strong>SUDAH DIBAYAR</strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Transaksi:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-success btn-sm"><strong><?php echo $order_status; ?></strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Catatan:</p>
                    </div>
                    <div class="col">
                      <?php echo $order_note; ?>
                    </div>
                  </div>
                  <?php
                      }
                      else if($jenis == 3){
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://vip-reseller.co.id/api/social-media',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => array(
                            'key' => $apiKey,
                            'sign' => $sign,
                            'type' => 'status',
                            'trxid' => $trxID
                          ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        //echo $response;
                        $hasil = json_decode($response, true);
                        if($hasil['result'] == 1){
                          $order_status = $hasil['data'][0]['status'];
                          $order_note = $hasil['data'][0]['note'];
                        }
                        else if($hasil['result'] == 0){
                          $order_status = 'failed';
                          $order_note = $hasil['message'];
                        }
                  ?>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Pembayaran:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-success btn-sm"><strong>SUDAH DIBAYAR</strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Transaksi:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-success btn-sm"><strong><?php echo $order_status; ?></strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Catatan:</p>
                    </div>
                    <div class="col">
                      <?php echo $order_status; ?>
                    </div>
                  </div>
                  <?php
                      }
                      else if($jenis == 4){
                  ?>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Pembayaran:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-success btn-sm"><strong>SUDAH DIBAYAR</strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Status Transaksi:</p>
                    </div>
                    <div class="col">
                    <a href="#"><button class="btn btn-<?php if($ct['status'] == 1) { echo 'warning'; } else if($ct['status'] == 2) { echo 'success'; } else if($ct['status'] == 2) { echo 'danger'; } ?> btn-sm"><strong>
                        <?php
                            if($ct['status'] == 1){
                                echo 'Process';
                            }
                            else if($ct['status'] == 2) {
                                echo 'Done';
                            }
                            else if($ct['status'] == 2) {
                                echo 'Failed';
                            }
                        ?>
                    </strong></button></a>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Catatan:</p>
                    </div>
                    <div class="col">
                      <?php echo $ct['note']; ?>
                    </div>
                  </div>
                  <?php
                      }
                    }
                  ?>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Kategori Layanan:</p>
                    </div>
                    <div class="col">
                      <strong><?php echo $ct['kategori']; ?></strong>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Nominal Layanan:</p>
                    </div>
                    <div class="col">
                      <strong><?php echo $ct['title']; ?></strong>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="row">
                    <div class="col">
                      <p>Data Target:</p>
                    </div>
                    <div class="col">
                      <strong><?php echo $ct['userID']; ?> (<?php echo $ct['zoneID']; ?>)<br><?php echo $ct['nickname']; ?></strong>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <p>Jika status pesanan <strong>GAGAL</strong> atau berstatus <strong>DIPROSES</strong> lebih dari 12 jam silahkan hubungi admin kami melalui Whatsapp.</p>
                  <div class="text-left">
                    <a href="https://wa.me/<?php echo $s1b['no_hp']; ?>" class="btn btn-success" target="_blank">Whatsapp Admin</a>
                  </div>
                  <?php }} ?>         
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
