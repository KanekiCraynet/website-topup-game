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

$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Order', '$pengguna')") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pembayaran - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Pembayaran - <?php echo $s0['instansi']; ?>"/>
  <meta property="og:description" content="<?php echo $s0['deskripsi']; ?>" />
  <meta property="og:url" content="<?php echo $urlweb; ?>" />
  <meta property="og:image" content="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" />
  <meta name="resource-type" content="document" />
  <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
  <meta http-equiv="content-language" content="en-us" />
  <meta name="author" content="Maks Kaneki Pedia" />
  <meta name="contact" content="kurozpedia.my.id" />
  <meta name="copyright" content="Copyright (c) kurozpedia.my.id. All Rights Reserved." />
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
              <h5 class="text-dark">Pembayaran</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="pb-3">
              <div class="section shadow-sm">
                <div class="card-body">
                  <h4 style="color:#ff962d;">Terima Kasih</h4>
                  Pesanan anda berhasil dibuat. Masa berlaku untuk No. Transaksi ini 24 jam, segera lakukan pembayaran agar pesanan segera diproses.
                  <br><br>
                  Simpan No. Transaksi anda untuk Cek Status Pesanan!
                </div>
              </div>
            </div>

            <div class="pb-3">
              <?php
                $trxID = $_GET['trxID'];
                $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_tripay` WHERE merchant_ref = '$trxID'") or die(mysqli_error());
                $s2 = mysqli_fetch_array($sql_2);
                $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$trxID'") or die(mysqli_error());
                $s3 = mysqli_fetch_array($sql_3);
                $produkID = $s3['produkID'];
                $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE id = '$produkID'") or die(mysqli_error());
                $s4 = mysqli_fetch_array($sql_4);
              ?>
              <div class="section shadow-sm">
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="pb-4">
                            Waktu Transaksi
                            <h5 class="text-dark mt-1"><?php echo $s2['created_date']; ?></h5>
                          </div>
                          <div class="pb-4">
                            Metode Pembayaran
                            <h5 class="text-dark mt-1"><?php echo $s2['payment_name']; ?></h5>
                          </div>                                
                          <div class="pb-4 text-dark">
                            Kode Pembayaran / No. Virtual Account<br>
                            <?php if($s2['payment_method'] == 'QRISC' || $s2['payment_method'] == 'QRIS' || $s2['payment_method'] == 'QRISCOP' || $s2['payment_method'] == 'QRISD'){ ?>
                            <img src="https://tripay.co.id/qr/<?php echo $s2['reference']; ?>" style="display: block; margin: 0 auto; margin-top: 10px; width:100%; max-width:180px !important; cursor:zoom-in; color:#000;" id="qr_code">
                            <?php } else if($s2['payment_method'] == 'OVO'){ ?>
                            Untuk Pembayaran Menggunakan OVO,<br>Silahkan Lakukan Pembayaran melalui tombol dibawah :<br>
                            <a href="<?php echo $s2['checkout_url']; ?>" target="_blank" class="btn btn-success btn-sm">Bayar Sekarang</a>
                            <?php } else { ?>
                            <h5 class="text-dark mb-1"><?php echo $s2['pay_code']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_virtualku()" data-clipboard-text="<?php echo $s2['pay_code']; ?>"></i></h5>
                            <?php } ?>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="pb-4">
                            No. Transaksi
                            <h5 class="text-dark mt-1"><?php echo $s2['merchant_ref']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_trxaku()" data-clipboard-text="<?php echo $s2['merchant_ref']; ?>"></i></h5>
                          </div>
                          <div class="pb-4">
                            Jumlah Pembayaran
                            <h5 class="text-dark mt-1">Rp. <?php echo number_format($s2['amount_total']); ?></h5>
                          </div>
                          <div class="pb-4">
                            Rincian Pesanan
                            <h5 class="text-dark mt-1"><?php echo $s3['kategori']; ?> - <?php echo $s3['title']; ?></h5>
                            <p><?php echo $s3['userID']; ?> (<?php echo $s3['zoneID']; ?>) <?php echo $s3['nickname']; ?></p> 
                          </div>
                    <div class="col">
                      <a href="<?php echo $urlweb; ?>/cektrx/?trxNum=<?php echo $s2['merchant_ref']; ?>"><button class="btn btn-primary w-100" style="border-radius: 15px;"><strong>Cek Status Pembayaran</strong></button></a>
                    </div>
                      </div>
                  </div> 
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section shadow-sm">
                <div class="card-body">
                  <h4 style="color:#ff962d;">Informasi Cara Pembayaran</h4>
                  <ol class=" text-dark">
                    <?php
                      $apiKey = 'muSlHQVhnIhioE5ezQZtONLtHh6YNwoC9qKhTTIe';
                      $curls = curl_init();
                                          
                      curl_setopt_array($curls, array(
                        CURLOPT_FRESH_CONNECT     => true,
                        CURLOPT_URL               => "https://tripay.co.id/api/payment/channel",
                        CURLOPT_RETURNTRANSFER    => true,
                        CURLOPT_IPRESOLVE         => CURL_IPRESOLVE_V4,
                        CURLOPT_HEADER            => false,
                        CURLOPT_HTTPHEADER        => array(
                          "Authorization: Bearer ".$apiKey
                        ),
                        CURLOPT_FAILONERROR       => false
                      ));
                                                                   
                      $responses = curl_exec($curls);
                      $errs = curl_error($curls);
                                                                   
                      curl_close($curls);
                      //echo !empty($err) ? $err : $response;
                      $hasils = json_decode($responses, true);
                      for ($i=0; $i < count($hasils['data']); $i++) {
                        for ($j=0; $j < count($hasils['data'][$i]['payment']); $j++) {
                          if($hasils['data'][$i]['payment'][$j]['code'] == $s2['payment_method']){
                            for ($l=0; $l < count($hasils['data'][$i]['payment'][$j]['instructions']); $l++) {
                              echo '<li style="margin-bottom: 20px;">';
                              echo $hasils['data'][$i]['payment'][$j]['instructions'][$l]['title'].'<br>';
                              echo '<ul style="margin-left: -25px;">';
                               for ($k=0; $k < count($hasils['data'][$i]['payment'][$j]['instructions'][$l]['steps']); $k++) {
                                 echo '<li style="word-wrap: break-word; color: #666666;">'.preg_replace('({{pay_code}})', $s2['pay_code'], $hasils['data'][$i]['payment'][$j]['instructions'][$l]['steps'][$k]).'</li>';
                                }
                              echo '</ul>';
                              echo '</li>';
                            }
                          }
                        }
                      }
                    ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
       </div>
        
      </div>
    </div>
    <div class="d-block d-sm-none" style="height: 100px;"></div>
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  
    <!--Start footer-->
    <?php include('footer.php'); ?>
    <script src="<?php echo $urlweb; ?>/assets/js/clipboard.min.js"></script>
    <script>

      var clipboard = new ClipboardJS('.clip');

      function copy_trxaku() {
        alert("No. Transaksi berhasil di Copy");
      }

      function copy_virtualku() {
        alert("Kode Pembayaran / No. Virtual Account berhasil di Copy");
      }

    </script>
</body>
</html>