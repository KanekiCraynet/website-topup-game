<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Saldo Saya - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Saldo Saya - <?php echo $s0['instansi']; ?>"/>
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
              <h5>Saldo Saya</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="pb-3">
                <?php
                    error_reporting(0);
                    if (!empty($_GET['notif'])) {
                      if ($_GET['notif'] == 1) {
                        echo '
                          <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Pin Transaksi Salah!</span>
                            </div>
                          </div>
                        ';
                      }
                      if ($_GET['notif'] == 2) {
                        echo '
                          <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Anda Belum Membuat PIN Transaksi, Silahkan buat PIN Transaksi pada menu Profil!</span>
                            </div>
                          </div>
                        ';
                      }
                    }
                ?>
              <div class="section">
                <div class="card-body">
                  <div class="card-title" style="font-size: 16px;">Rp. <?php echo number_format($s3['active']); ?>
                    <span class="float-right">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formdepo" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus mr-1"></i> Top Up Saldo IDR (Rp)</button>
                    </span>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="formdepo">
                    <div class="modal-dialog" style="background: #191f50!important; color: #fff!important;">
                      <div class="modal-content animated bounceIn" style="background: #191f50!important; color: #fff!important;">
                        <div class="modal-header">
                          <h5 class="modal-title" style="color: #fff;">Form Top Up Saldo IDR (Rp)</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form role="form" action="<?php echo $urlweb; ?>/functions/topup.php" method="post">
                            <div class="form-group mb-2">
                              <label style="color: #fff;">Nominal Top Up</label>
                              <input type="number" name="nominal" min="10000" max="4500000" step="1000" value="10000" class="form-control" required>
                              <input type="hidden" name="userID" class="form-control" value="<?php echo $userID; ?>">
                            </div>
                            <div class="form-group mb-2">
                              <label style="color: #fff;">Pilih Metode Pembayaran</label>
                              <div class="row mb-2">
                                  <?php
                                      $apiKey = $s41['api_key'];
                                      $curls = curl_init();
                                                 
                                      curl_setopt_array($curls, array(
                                          CURLOPT_FRESH_CONNECT     => true,
                                          CURLOPT_URL               => "https://tripay.co.id/api/merchant/payment-channel",
                                          CURLOPT_RETURNTRANSFER    => true,
                                          CURLOPT_HEADER            => false,
                                          CURLOPT_HTTPHEADER        => array(
                                            "Authorization: Bearer ".$apiKey
                                          ),
                                          CURLOPT_FAILONERROR       => false
                                      ));
                                                  
                                      $responses = curl_exec($curls);
                                      $errs = curl_error($curls);
                                      curl_close($curls);
                                      //echo !empty($err) ? $err : $responses;
                                      $hasils = json_decode($responses, true);
                                      for ($i=0; $i < count($hasils['data']); $i++) {
                                          if($hasils['data'][$i]['active'] == 'true'){
                                  ?>
                                  <div class="col-6">
                                    <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code']; ?>" id="flexRadioDefault<?php echo $i; ?>">
                                    <label for="flexRadioDefault<?php echo $i; ?>">
                                      <div class="row ml-2 mr-2 pb-0">
                                        <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="card img-fluid mb-1" style="display: block; width: auto; width: 100px; height: 40px;">
                                      </div>
                                      <div class="row ml-2 mr-2 pt-0">
                                        <p style="font-weight: normal;"><?php echo $hasils['data'][$i]['name']; ?></p>
                                      </div>
                                    </label>
                                  </div>
                                  <?php }} ?>
                              </div>
                            </div>
                            <div class="form-group mb-2">
                              <label style="color: #fff;">PIN Transaksi</label>
                              <input type="password" name="pin_trx" class="form-control" value="" required>
                            </div>
                            <div class="form-group mt-3">
                              <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                              <button type="submit" name="submit" class="btn btn-primary">Top Up</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="table-responsive">
                    <table id="default-datatable" class="table table-bordered align-items-center table-flush">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th class="text-center" style="vertical-align: middle;">No</th>
                          <th class="text-center" style="vertical-align: middle;">Tgl Transaksi</th>
                          <th class="text-center" style="vertical-align: middle;">No. Transaksi</th>
                          <th class="text-center" style="vertical-align: middle;">Jumlah</th>
                          <th class="text-center" style="vertical-align: middle;">Note</th>
                          <th class="text-center" style="vertical-align: middle;">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_transaksi` WHERE userID = '$userID' ORDER BY id DESC") or die(mysqli_error());
                          $no = 0;
                          while($s1 = mysqli_fetch_array($sql_1)){
                            $no++;
                            $userID = $s1['userID'];
                            $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = '$userID'") or die(mysqli_error());
                            $s3 = mysqli_fetch_array($sql_3);
                        ?>
                        <tr>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><?php echo $no; ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><?php echo $s1['date']; ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><a href="<?php echo $urlweb; ?>/payment/?trxID=<?php echo $s1['kd_transaksi']; ?>"><?php echo $s1['kd_transaksi']; ?></a></td>
                          <td class="text-right text-white" style="vertical-align: middle; white-space: normal;"><?php echo number_format($s1['total']); ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><?php echo $s1['note']; ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;">
                            <?php
                              if($s1['status'] == 0){
                                echo '<button class="btn btn-warning btn-sm">Pending</button>';
                              }
                              else if($s1['status'] == 1){
                                echo '<button class="btn btn-success btn-sm">Success</button>';
                              }
                              else if($s1['status'] == 2){
                                echo '<button class="btn btn-danger btn-sm">Refund</button>';
                              }
                            ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
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
    <script>
      $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();
      });
    </script>
</body>
</html>
