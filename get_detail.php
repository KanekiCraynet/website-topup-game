<?php
ob_start();
session_start();
include('config/koneksi.php');
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

//error_reporting(0);
if($_GET['userID'] == '' || $_GET['zoneID'] == ''){
?>
  <div class="modal-body pt-5 pb-5 text-center">
      <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Harap Masukan UserID atau ZoneID/Server Anda</p>
            <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
      </div>
<?php
}
else {
$produkID = $_GET['produkID'];
$kabupaten = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE id = '$produkID' ORDER BY id ASC");
$kabupaten_row = mysqli_fetch_array($kabupaten);
$kategori = $kabupaten_row['kategori'];
$sql_12 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE kategori = '$kategori'") or die(mysqli_error());
$s12 = mysqli_fetch_array($sql_12);
$cekID = $s12['cekID'];
if($cekID == 'Dragon Raja' || $cekID == 'Free Fire' || $cekID == 'League of Legends Wild Rift' || $cekID == 'LifeAfter' || $cekID == 'Mobile Legends' || $cekID == 'Point Blank' || $cekID == 'Ragnarok Next Generation' || $cekID == 'Sausage Man' || $cekID == 'Valorant' || $cekID == 'ZEPETO') {
    $signe = 'sh0kHFzc0islzin8CqysxUNpsLxJRomdqPweMbQqzBVXeyXKtT1sgUKk3UF45bdLBU0Pax9p';
    $sign = md5($signe);
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.shenn.id/v1/game-checker',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array(
          'key' => '0islzin8CqysxUNpsLxJRomdqPweMbQqzBVXeyXKtT1sgUKk3UF45bdLBU0Pax9p',
          'sign' => $sign,
          'game' => $cekID,
          'data' => $_GET['userID'],
          'zone' => $_GET['zoneID']
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    //echo $response; die;
    $hasils = json_decode($response, true);
    if($hasils['data'] == ''){
?>
    <div class="modal-body pt-5 pb-5 text-center">
      <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
      <p style="font-size: 18px;">Masukan User ID Dengan Benar</p>
      <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
    </div>
<?php
    }
    else{
        $nickname = $hasils['data']['name'] ?? "Name";
?>
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" id="search_form" action="<?php echo $urlweb; ?>/order_proses.php" method="POST">
                    <div class="modal-body text-center">
                      <table style="width: 100%;">
                        <tbody>
                          
                          <tr>
                            <td class="text-left pt-2 pb-2" style="width: 45%!important; border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Kategori Layanan:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php echo $kabupaten_row['kategori']; ?>
                              <input type="hidden" class="form-control" name="produkID" value="<?php echo $_GET['produkID']; ?>" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Nominal Layanan:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php echo $kabupaten_row['title']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Nickname:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php echo $nickname; ?>
                              <input type="hidden" class="form-control" name="nickname" value="<?php echo $nickname; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">UserID:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php echo $_GET['userID']; ?> (<?php echo $_GET['zoneID']; ?>)
                              <input type="hidden" class="form-control" name="userID" value="<?php echo $_GET['userID']; ?>">
                              <input type="hidden" class="form-control" name="zone_id" value="<?php echo $_GET['zoneID']; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Metode Pembayaran:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php
                                $explode = explode('_',$_GET['metode']);
                                echo str_replace('-',' ',$explode[1]);
                              ?>
                              <input type="hidden" class="form-control" name="metode" value="<?php echo $explode[0]; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #000;"></td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #000;">
                              <input type="hidden" name="IDuser" class="form-control" value="<?php echo $_GET['IDuser']; ?>">
                              <input type="hidden" name="no_hp" class="form-control" value="<?php echo $_GET['noHp']; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #000;">
                              Pastikan data game Anda sudah benar. Kesalahan input data game bukan tanggung jawab kami.
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                      <button type="submit" name="submit" id="buttonSubmit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                    </div>
                </form>
<?php
    }
}
else {
?>
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" id="search_form" action="<?php echo $urlweb; ?>/order_proses.php" method="POST">
                    <div class="modal-body text-center">
                      <table style="width: 100%;">
                        <tbody>
                          
                          <tr>
                            <td class="text-left pt-2 pb-2" style="width: 45%!important; border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Kategori Layanan:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php echo $kabupaten_row['kategori']; ?>
                              <input type="hidden" class="form-control" name="produkID" value="<?php echo $_GET['produkID']; ?>" readonly>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Nominal Layanan:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php echo $kabupaten_row['title']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Nickname:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">UserID:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php echo $_GET['userID']; ?> (<?php echo $_GET['zoneID']; ?>)
                              <input type="hidden" class="form-control" name="userID" value="<?php echo $_GET['userID']; ?>">
                              <input type="hidden" class="form-control" name="zone_id" value="<?php echo $_GET['zoneID']; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">Metode Pembayaran:</td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #000;">
                              <?php
                                $explode = explode('_',$_GET['metode']);
                                echo str_replace('-',' ',$explode[1]);
                              ?>
                              <input type="hidden" class="form-control" name="metode" value="<?php echo $explode[0]; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #000;"></td>
                            <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #000;">
                              <input type="hidden" name="IDuser" class="form-control" value="<?php echo $_GET['IDuser']; ?>">
                              <input type="hidden" name="no_hp" class="form-control" value="<?php echo $_GET['noHp']; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #000;">
                              Pastikan data game Anda sudah benar. Kesalahan input data game bukan tanggung jawab kami.
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                      <button type="submit" name="submit" id="buttonSubmit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                    </div>
                </form>
<?php }} ?>