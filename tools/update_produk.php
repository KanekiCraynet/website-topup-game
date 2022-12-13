<?php
include('../config/koneksi.php');
$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 2") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
$merchantCodes = $s5['merchant_code'];
$apiKey = $s5['api_key'];

$join_date = date('Y-m-d H:i:s');

$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
$ga = mysqli_fetch_array($getAdmin);
$persen_sell = $ga['persen_sell'];
$persen_res = 3.3;
$reseller_price = $ga['reseller_price'];

$delete = mysqli_query($conn,"DELETE FROM `tb_produk` WHERE jenis IN (0,2)") or die(mysqli_error($conn));
$ubah = mysqli_query($conn,"ALTER TABLE `tb_produk` AUTO_INCREMENT = 1") or die(mysqli_error($conn));

$signe = $merchantCodes.$apiKey;
$sign = md5($signe);
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
      'type' => 'services',
      'filter_type' => 'game'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
$hasil = json_decode($response, true);
for ($i=0; $i < count($hasil['data']); $i++) {
    $code = $hasil['data'][$i]['code'];
    $game = $hasil['data'][$i]['game'];
    $slug = strtolower(preg_replace("/[^a-zA-Z0-9]/", "",$game));
    $image = strtolower(str_replace(' ','_',$game)).'.png';
    $title = str_replace(array( "’","'" ),"&apos;",$hasil['data'][$i]['name']);
    $hargaModal = $hasil['data'][$i]['price']['special'];
    $aa = round(($hargaModal * $persen_sell) / 100);
    $hargaJual = $hargaModal + $aa;
    $hargaRes =  round(($hargaModal*$persen_res) / 100);
    $hargaReseller = $hargaModal + $hargaRes;
    $tipe_data = $hasil['data'][$i]['status'];
    if($tipe_data == 'available'){
        if($game != 'Canva Pro' && $game != 'Disney Hotstar' && $game != 'Garena Shell Murah' && $game != 'iQIYI Premium' && $game != 'Mobile Legends Slow' && $game != 'Mobile Legends Vilog' && $game != 'Netflix Premium' && $game != 'Spotify Premium' && $game != 'Vidio Premier' && $game != 'WeTV Premium' && $game != 'Youtube Premium' && $game != 'Voucher PB Zepetto' && $game != 'Voucher Valorant'){
          $insert = mysqli_query($conn,"INSERT INTO `tb_produk` (`slug`, `code`, `title`, `kategori`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `currency`, `status`, `jenis`) VALUES ('$slug', '$code', '$title', '$game', '$hargaModal', '$hargaJual', '$hargaReseller', '$image', '', 1, 0)") or die(mysqli_error($conn));
        }
        else {
          $insert = mysqli_query($conn,"INSERT INTO `tb_produk` (`slug`, `code`, `title`, `kategori`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `currency`, `status`, `jenis`) VALUES ('$slug', '$code', '$title', '$game', '$hargaModal', '$hargaJual', '$hargaReseller', '$image', '', 1, 2)") or die(mysqli_error($conn));
        }
    }
    else {
        $statusnya = 0;
    }
    echo $code.' '.$game.' '.$title.' '.$hargaModal.' '.$hargaJual.'<br>';

}
?>