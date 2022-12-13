<?php
include('../config/koneksi.php');

$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);
$privateKey = $s4['private_key'];
$tripayApi = $s4['api_key'];
$tripayCode = $s4['merchant_code'];

$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 2") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
$merchantCodes = $s5['merchant_code'];
$apiKey = $s5['api_key'];

$signe = $merchantCodes.$apiKey;
$sign = md5($signe);
$created_date = date('Y-m-d H:i:s');

$cektrx1 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE trxID != '' AND status_order = 'waiting'") or die(mysqli_error());
$a=0;
while($cts1 = mysqli_fetch_array($cektrx1)){
  $a++;
  $b = $a-1;
  $usersID = $cts1['id_user'];
  $total = $cts1['sub_total'];
  $trxID = $cts1['kd_transaksi'];
  $metode = $cts1['metode'];
  $txID = $cts1['trxID'];
  $statusOrder = $cts1['status_order'];
  $jenisnya = $cts1['jenis'];
  if(($jenisnya == 1)){
      $cekGame = 'game-feature';
  }
  else if($jenisnya == 2){
      $cekGame = 'prepaid';
  }
  else if($jenisnya == 3){
      $cekGame = 'social-media';
  }

  $curl = curl_init();
    
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://vip-reseller.co.id/api/'.$cekGame,
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
      'trxid' => $txID
    ),
  ));
  $response = curl_exec($curl);
    
  curl_close($curl);
  echo $response;
  $hasil = json_decode($response, true);
  $order_status = $hasil['data'][$b]['status'];
  $order_note = $hasil['data'][$b]['note'];
  if($statusOrder == 'waiting'){
    if($order_status == 'success'){
      if($metode == 'saldo'){
        $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','$order_note','$total',0,'$order_note','2','saldo','$usersID',1)") or die(mysqli_error());
        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 1, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
        $update = mysqli_query($conn,"UPDATE `tb_balance` SET `payout` = payout + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
      }
      else {
        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 1, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
      }
    }
    else if($order_status == 'error'){
      if($metode == 'saldo'){
        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
        $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
        $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID','0','$metode','$usersID',1)") or die(mysqli_error());
      }
      else {
        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
        $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
        $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID','0','$metode','$usersID',1)") or die(mysqli_error());
      }
    }
  }
}
?>