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
$cat = $_GET['cat'];
$sql_3 = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE slug = '$cat' GROUP BY kategori") or die(mysqli_error());
$s3 = mysqli_fetch_array($sql_3);
$sql_6 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE slug = '$cat'") or die(mysqli_error());
$s6 = mysqli_fetch_array($sql_6);

$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 2") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);
$merchantCode = $s4['merchant_code'];
$apiKey = $s4['api_key'];

$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Top Up <?php echo $s3['kategori']; ?> - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Top Up <?php echo $s3['kategori']; ?> - <?php echo $s0['instansi']; ?>"/>
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

  <!-- Icon-->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/assets/images/tl-icon.png">
  
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
		    	<div class="col-sm-3">
			    	<div class="text-center pt-3 pb-2">
			    	  <img src="<?php echo $urlweb; ?>/upload/<?php echo $s6['image']; ?>" class="mb-3" style="display: block; margin: 0 auto; border-radius: 10px !important;" width="120px" height="120px">
              <h5 class="text-dark"><?php echo $s3['kategori']; ?></h5>
			    	</div>
            <div class="text-center pb-3">
              <p>
                <strong>
                  Layanan Aktif 24 Jam<br>
                  Estimasi Proses Otomatis 1-3 Menit
                </strong>
              </p>
            </div>
		    	</div>
		    	<div class="col-sm-9">
            <div class="pb-3">
              <div class="section shadow-sm">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">1</div>
                  <h5 style="margin-left: 45px; margin-top: 5px; color:#ff962d;">Masukkan Nomor / ID</h5>
                  <?php
                    if($s3['kategori'] == 'Be The King'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                          <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" >
                          </div>
                          <div class="col-6"> 
                            <select name="zone_id" id="zoneID" class="form-control" >    
                                    <option value="">Pilih Server</option>
                                    <option value="Asia-S1">Asia-S1</option>
                                    <option value="Asia-S2">Asia-S2</option>
                                    <option value="Asia-S3">Asia-S3</option>
                                    <option value="Asia-S4">Asia-S4</option>
                                    <option value="Asia-S5">Asia-S5</option>
                                    <option value="Asia-S6">Asia-S6</option>
                                    <option value="Asia-S7">Asia-S7</option>
                                    <option value="Asia-S8">Asia-S8</option>
                                    <option value="Asia-S9">Asia-S9</option>
                                    <option value="Asia-S10">Asia-S10</option>
                                    <option value="Asia-S11">Asia-S11</option>
                                    <option value="Asia-S12">Asia-S12</option>
                                    <option value="Asia-S13">Asia-S13</option>
                                    <option value="Asia-S14">Asia-S14</option>
                                    <option value="Asia-S15">Asia-S15</option>
                                    <option value="Asia-S16">Asia-S16</option>
                                    <option value="Asia-S17">Asia-S17</option>
                                    <option value="Asia-S18">Asia-S18</option>
                                    <option value="Asia-S19">Asia-S19</option>
                                    <option value="Asia-S20">Asia-S20</option>
                                    <option value="Asia-S21">Asia-S21</option>
                                    <option value="Asia-S22">Asia-S22</option>
                                    <option value="Asia-S23">Asia-S23</option>
                                    <option value="Asia-S24">Asia-S24</option>
                                    <option value="Asia-S25">Asia-S25</option>
                                    <option value="Asia-S26">Asia-S26</option>
                                    <option value="Asia-S27">Asia-S27</option>
                                    <option value="Asia-S28">Asia-S28</option>
                                    <option value="Asia-S29">Asia-S29</option>
                                    <option value="Asia-S30">Asia-S30</option>
                                    <option value="Asia-S31">Asia-S31</option>
                                    <option value="Asia-S32">Asia-S32</option>
                                    <option value="Asia-S33">Asia-S33</option>
                                    <option value="Asia-S34">Asia-S34</option>
                                    <option value="Asia-S35">Asia-S35</option>
                                    <option value="Asia-S36">Asia-S36</option>
                                    <option value="Asia-S37">Asia-S37</option>
                                    <option value="Asia-S38">Asia-S38</option>
                                    <option value="Asia-S39">Asia-S39</option>
                                    <option value="Asia-S40">Asia-S40</option>
                                    <option value="Asia-S41">Asia-S41</option>
                                    <option value="Asia-S42">Asia-S42</option>
                                    <option value="Asia-S43">Asia-S43</option>
                                    <option value="Asia-S44">Asia-S44</option>
                                    <option value="Asia-S45">Asia-S45</option>
                                    <option value="Asia-S46">Asia-S46</option>
                                    <option value="Asia-S47">Asia-S47</option>
                                    <option value="Asia-S48">Asia-S48</option>
                                    <option value="Asia-S49">Asia-S49</option>
                                    <option value="Asia-S50">Asia-S50</option>
                                    <option value="Asia-S51">Asia-S51</option>
                                    <option value="Asia-S52">Asia-S52</option>
                                    <option value="Asia-S53">Asia-S53</option>
                                    <option value="Asia-S54">Asia-S54</option>
                                    <option value="Asia-S55">Asia-S55</option>
                                    <option value="Asia-S56">Asia-S56</option>
                                    <option value="Asia-S57">Asia-S57</option>
                                    <option value="Asia-S58">Asia-S58</option>
                                    <option value="Asia-S59">Asia-S59</option>
                                    <option value="Asia-S60">Asia-S60</option>
                                    <option value="Asia-S61">Asia-S61</option>
                                    <option value="Asia-S62">Asia-S62</option>
                                    <option value="Asia-S63">Asia-S63</option>
                                    <option value="Asia-S64">Asia-S64</option>
                                    <option value="Asia-S65">Asia-S65</option>
                                    <option value="Asia-S66">Asia-S66</option>
                                    <option value="Asia-S67">Asia-S67</option>
                                    <option value="Asia-S68">Asia-S68</option>
                                    <option value="Asia-S69">Asia-S69</option>
                                    <option value="Asia-S70">Asia-S70</option>
                                    <option value="Asia-S71">Asia-S71</option>
                                    <option value="Asia-S72">Asia-S72</option>
                                    <option value="Asia-S73">Asia-S73</option>
                                    <option value="Asia-S74">Asia-S74</option>
                                    <option value="Asia-S75">Asia-S75</option>
                                    <option value="Asia-S76">Asia-S76</option>
                                    <option value="Asia-S77">Asia-S77</option>
                                    <option value="Asia-S78">Asia-S78</option>
                                    <option value="Asia-S79">Asia-S79</option>
                                    <option value="Asia-S80">Asia-S80</option>
                                    <option value="Asia-S81">Asia-S81</option>
                                    <option value="Asia-S82">Asia-S82</option>
                                    <option value="Asia-S83">Asia-S83</option>
                                    <option value="Asia-S84">Asia-S84</option>
                                    <option value="Asia-S85">Asia-S85</option>
                                    <option value="Asia-S86">Asia-S86</option>
                                    <option value="Asia-S87">Asia-S87</option>
                                    <option value="Asia-S88">Asia-S88</option>
                                    <option value="Asia-S89">Asia-S89</option>
                                    <option value="Asia-S90">Asia-S90</option>
                                    <option value="Asia-S91">Asia-S91</option>
                                    <option value="Asia-S92">Asia-S92</option>
                                    <option value="Asia-S93">Asia-S93</option>
                                    <option value="Asia-S94">Asia-S94</option>
                                    <option value="Asia-S95">Asia-S95</option>
                                    <option value="Asia-S96">Asia-S96</option>
                                    <option value="Asia-S97">Asia-S97</option>
                                    <option value="Asia-S98">Asia-S98</option>
                                    <option value="Asia-S99">Asia-S99</option>
                                    <option value="Asia-S100">Asia-S100</option>
                                    <option value="Asia-S101">Asia-S101</option>
                                    <option value="Asia-S102">Asia-S102</option>
                                    <option value="Asia-S103">Asia-S103</option>
                                    <option value="Asia-S104">Asia-S104</option>
                                    <option value="Asia-S105">Asia-S105</option>
                                    <option value="Asia-S106">Asia-S106</option>
                                    <option value="Asia-S107">Asia-S107</option>
                                    <option value="Asia-S108">Asia-S108</option>
                                    <option value="Asia-S109">Asia-S109</option>
                                    <option value="Asia-S110">Asia-S110</option>
                                    <option value="Asia-S111">Asia-S111</option>
                                    <option value="Asia-S112">Asia-S112</option>
                                    <option value="Asia-S113">Asia-S113</option>
                                    <option value="Asia-S114">Asia-S114</option>
                                    <option value="Asia-S115">Asia-S115</option>
                                    <option value="Asia-S116">Asia-S116</option>
                                    <option value="Asia-S117">Asia-S117</option>
                                    <option value="Asia-S118">Asia-S118</option>
                                    <option value="Asia-S119">Asia-S119</option>
                                    <option value="Asia-S120">Asia-S120</option>
                                    <option value="Asia-S121">Asia-S121</option>
                                    <option value="Asia-S122">Asia-S122</option>
                                    <option value="Asia-S123">Asia-S123</option>
                                    <option value="Asia-S124">Asia-S124</option>
                                    <option value="Asia-S125">Asia-S125</option>
                                    <option value="Asia-S126">Asia-S126</option>
                                    <option value="Asia-S127">Asia-S127</option>
                            </select>
                          </div>
                          <p class="col-12 mt-2" style="font-size: 10px">
                          Untuk menemukan User ID Anda, masuk ke dalam Map, kemudian pilih Pengaturan. User ID Anda tercantum disana.
                          </p>
                        </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Chimeraland'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-6">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" >
                            </div>
                            <div class="col-6"> 
                              <select name="zone_id" id="zoneID" class="form-control">  
                                <option value="">Pilih Server</option>
                                <option value="DeathQuay">DeathQuay</option>
                                <option value="CrosRiver">CrosRiver</option>
                                <option value="Buckland">Buckland</option>
                                <option value="BurntPlan">BurntPlan</option>
                                <option value="JadeCoast">JadeCoast</option>
                                <option value="PadHill">PadHill</option>
                                <option value="RoniLand">RoniLand</option>
                                <option value="BeautyLake">BeautyLake</option>
                                <option value="BlizzardBay">BlizzardBay</option>
                                <option value="LushField">LushField</option>
                                <option value="DustyPlan">DustyPlan</option>
                                <option value="IceRiver">IceRiver</option>
                                <option value="GreenGuilty">GreenGuilty</option>
                                <option value="AzureField">AzureField</option>
                                <option value="EosBeach">EosBeach</option>
                                <option value="TwilightBay">TwilightBay</option>
                                <option value="Gray Plain">Gray Plain</option>
                                <option value="SandSnow">SandSnow</option>
                              </select>
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan ID Anda, ketuk pada ikon karakter. User ID tercantum di menu basic. Contoh: "12345678".</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Dragon Raja'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Player ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Pemain dapat melihat Server ID pada tampilan log-in. Saat memasuki game, pemain dapat mengetuk avatar yang terletak pojok kiri atas layar, dan Player ID akan muncul di pojok kiri bawah layar.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Free Fire'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Player ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan ID Anda, ketuk pada ikon karakter. User ID tercantum di bawah nama karakter Anda. Contoh: 5363266446</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Genshin Impact'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" >
                            </div>
                            <div class="col"> 
                              <select name="zone_id" id="zoneID" class="form-control">
                                <option value="">Pilih Server</option>
                                <option value="America">America</option>
                                <option value="Asia">Asia</option>
                                <option value="Europa">Europe</option>
                                <option value="TW_HK_MO">TW_HK_MO</option>
                              </select>
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan UID Anda, masuk pakai akun Anda. Klik pada tombol profile di pojok kiri atas layar. Temukan UID dibawah avatar. Masukan UID Anda di sini. Selain itu, Anda juga dapat temukan UID Anda di pojok bawah kanan layar.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'League of Legends'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Player ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="3">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan Riot ID Anda, buka halaman profil akun dan salin Riot ID+Tag menggunakan tombol yang tersedia disamping Riot ID. (Contoh: VIPayment#123)</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'LifeAfter'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" >
                            </div>
                            <div class="col"> 
                              <select name="zone_id" id="zoneID" class="form-control" required=""> 
                                <option value="">Pilih Server</option>
                                <option value="MiskaTown">MiskaTown</option>
                                <option value="SandCastle">SandCastle</option>
                                <option value="MouthSwamp">MouthSwamp</option>
                                <option value="RedwoodTown">RedwoodTown</option>
                                <option value="Obelisk">Obelisk</option>
                                <option value="FallForest">FallForest</option>
                                <option value="MountSnow">MountSnow</option>
                                <option value="NancyCity">NancyCity</option>
                                <option value="CharlesTown">CharlesTown</option>
                                <option value="SnowHighlands">SnowHighlands</option>
                                <option value="Santopany">Santopany</option>
                                <option value="LevinCity">LevinCity</option>
                                <option value="NewLand">NewLand</option>
                                <option value="MileStone">MileStone</option>
                                <option value="ChaosOutpost">ChaosOutpost</option>
                                <option value="ChaosCity">ChaosCity</option>
                                <option value="TwinIslands">TwinIslands</option>
                                <option value="HopeWall">HopeWall</option>
                                <option value="IronStride">IronStride</option>
                              </select>
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan Account ID Anda, buka aplikasi LifeAfter, lalu klik pengaturan yang terletak di kanan atas layar game dan Account ID akan terlihat. Silakan masukan Account ID Anda disini.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Light of Thel'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan ID Pengguna Anda, login ke akun Anda di aplikasi. Klik pada gambar profil di sudut kiri atas Anda akan menemukan ID Peran di bawah avatar Anda.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Lords Mobile'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan IGG ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="13">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan ID IGG, buka aplikasi Lords Mobile Anda. Klik pengaturan (Ikon Gerigi) yang terletak di bawah kanan layar, kemudian klik pada Akun Anda, ID IGG dapat Anda lihat tercantum disana. Silakan masukan ID IGG Anda di sini.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Mobile Legends A'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            </div>
                            <div class="col">
                            <input type="text" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" >
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk mengetahui User ID Anda, silahkan klik menu profile dibagian kiri atas pada menu utama game. User ID akan terlihat dibagian bawah Nama karakter game Anda. Silahkan masukan User ID dan Server ID Anda untuk menyelesaikan transaksi. <b>Contoh: 12345678(1234)</b>.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Mobile Legends B'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            </div>
                            <div class="col">
                            <input type="text" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" >
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk mengetahui User ID Anda, silahkan klik menu profile dibagian kiri atas pada menu utama game. User ID akan terlihat dibagian bawah Nama karakter game Anda. Silahkan masukan User ID dan Server ID Anda untuk menyelesaikan transaksi. <b>Contoh: 12345678(1234)</b>.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Mobile Legends C'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            </div>
                            <div class="col">
                            <input type="text" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" >
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk mengetahui User ID Anda, silahkan klik menu profile dibagian kiri atas pada menu utama game. User ID akan terlihat dibagian bawah Nama karakter game Anda. Silahkan masukan User ID dan Server ID Anda untuk menyelesaikan transaksi. <b>Contoh: 12345678(1234)</b>.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Mobile Legends Membership'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            </div>
                            <div class="col">
                            <input type="text" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" >
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk mengetahui User ID Anda, silahkan klik menu profile dibagian kiri atas pada menu utama game. User ID akan terlihat dibagian bawah Nama karakter game Anda. Silahkan masukan User ID dan Server ID Anda untuk menyelesaikan transaksi. <b>Contoh: 12345678(1234)</b>.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Mobile Legends Vilog'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            </div>
                            <div class="col">
                            <input type="text" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" >
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk mengetahui User ID Anda, silahkan klik menu profile dibagian kiri atas pada menu utama game. User ID akan terlihat dibagian bawah Nama karakter game Anda. Silahkan masukan User ID dan Server ID Anda untuk menyelesaikan transaksi. <b>Contoh: 12345678(1234)</b>.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Omega Legends'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan IGG ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="10">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan ID IGG, buka aplikasi Lords Mobile Anda. Klik pengaturan (Ikon Gerigi) yang terletak di bawah kanan layar, kemudian klik pada Akun Anda, ID IGG dapat Anda lihat tercantum disana. Silakan masukan ID IGG Anda di sini.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'One Punch Man'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            </div>
                            <div class="col-12">
                            <input type="text" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Server ID" >
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk mengetahui User ID Anda, silahkan klik menu profile dibagian kiri atas pada menu utama game. User ID akan terlihat dibagian bawah Nama karakter game Anda. Silahkan masukan User ID dan Server ID Anda untuk menyelesaikan transaksi. <b>Contoh: 12345678(1234)</b>.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'PB Zepetto'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="16">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px"></p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'PUBGM GLOBAL'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="3">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan user id anda, klik foto profil yang terletak di pojok kanan atas, di sudut kiri akan terlihat informasi ID, Contoh: 513018121</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'PUBGM INDO A'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="3">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan user id anda, klik foto profil yang terletak di pojok kanan atas, di sudut kiri akan terlihat informasi ID, Contoh: 513018121</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'PUBGM INDO B'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="3">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan user id anda, klik foto profil yang terletak di pojok kanan atas, di sudut kiri akan terlihat informasi ID, Contoh: 513018121</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'PUBGM New State'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                            Untuk menemukan user id anda, klik icon titik tiga yang terletak di pojok kanan atas, klik menu pengaturan dan basic. Silahkan masukan ID Akun.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'RagnaroK M Eternal Love'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" >
                            </div>
                            <div class="col"> 
                              <select name="zone_id" id="zoneID" class="form-control">  
                                <option value="">Pilih Server</option>
                                <option value="Eternal Love">Eternal Love</option>
                                <option value="Midnight Party">Midnight Party</option>
                              </select>
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan ID Anda, tap pada gambar karakter Anda. ID Anda akan terdaftar dibawah nama karakter Anda. Mohon masukan nomor ID Anda disini. Contoh: 4295037856.</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'RagnaroK X Next Generation'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" >
                            </div>
                            <div class="col"> 
                              <select name="zone_id" id="zoneID" class="form-control">  
                                    <option value="">Pilih Server</option>
                                    <option value="Opera Phantom">Opera Phantom</option>
                                    <option value="Wing of Blessing">Wing of Blessing</option>
                                    <option value="Royal Instrument">Royal Instrument</option>
                                    <option value="Valhalla">Valhalla</option>
                                    <option value="Gungnir">Gungnir</option>
                                    <option value="Central Plains">Central Plains</option>
                                    <option value="Dark Lord">Dark Lord</option>
                                    <option value="Temple of Dawn">Temple of Dawn</option>
                                    <option value="Golden Lava">Golden Lava</option>
                                    <option value="Highland">Highland</option>
                                    <option value="Demons Castle">Demons Castle</option>
                                    <option value="Sealed Island">Sealed Island</option>
                                    <option value="Sipera">Sipera</option>
                                    <option value="Silent Ship">Silent Ship</option>
                                    <option value="Golden Route">Golden Route</option>
                                    <option value="Sapir">Sapir</option>
                                    <option value="Rose Red">Rose Red</option>
                                    <option value="Kingdom of Freedom">Kingdom of Freedom</option>
                                    <option value="Nicola">Nicola</option>
                                    <option value="Crystal Waterfall">Crystal Waterfall</option>
                                    <option value="Bifrost">Bifrost</option>
                                    <option value="Nastia">Nastia</option>
                                    <option value="Strouf Treasury">Strouf Treasury</option>
                                    <option value="Green Tranquil Pond">Green Tranquil Pond</option>
                                    <option value="Ingael">Ingael</option>
                                    <option value="Tome of Glory">Tome of Glory</option>
                                    <option value="Incense Pavilion">Incense Pavilion</option>
                                    <option value="Carew">Carew</option>
                                    <option value="Boulders and Horns">Boulders and Horns</option>
                                    <option value="Exquisite Pond">Exquisite Pond</option>
                                    <option value="Nemesis">Nemesis</option>
                                    <option value="Bright Lotus Pond">Bright Lotus Pond</option>
                                    <option value="Seocho Market">Seocho Market</option>
                                    <option value="Eudora">Eudora</option>
                                    <option value="Moonlit Temple">Moonlit Temple</option>
                                    <option value="Hidden Wood Ruins">Hidden Wood Ruins</option>
                                    <option value="Dungeon Throne">Dungeon Throne</option>
                                    <option value="Ayothaya">Ayothaya</option>
                                    <option value="Luzhon">Luzhon</option>
                                    <option value="Majapahit">Majapahit</option>
                                    <option value="Garden City">Garden City</option>
                                    <option value="Manila">Manila</option>
                                    <option value="Sukhothai">Sukhothai</option>
                                    <option value="Tossakan">Tossakan</option>
                                    <option value="Badang">Badang</option>
                                    <option value="Lapulapu">Lapulapu</option>
                                    <option value="Gatotkaca">Gatotkaca</option>
                                    <option value="Srikandi">Srikandi</option>
                                    <option value="Kumpakan">Kumpakan</option>
                                    <option value="Angeling">Angeling</option>
                                    <option value="Deviling">Deviling</option>
                                    <option value="Ghostring">Ghostring</option>
                                    <option value="Mastering">Mastering</option>
                                    <option value="Xu Nu">Xu Nu</option>
                                    <option value="Song Tu">Song Tu</option>
                                    <option value="Half Anniversary">Half Anniversary</option>             
                              </select>
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">Untuk menemukan ID Anda, Klik gambar karakter Anda dan pilih Other Info. Anda akan menemukan ID Anda di layar tersebut. Silakan masukkan ID Anda di sini. Contoh: 4611686019635450113. Catatan: Bonus isi ulang pertama tidak berlaku untuk top up pihak ketiga</p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Sausage Man'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="3">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                            Untuk mengetahui User ID Anda, Silakan Klik menu profile dibagian kiri atas pada menu utama game. Dan user ID akan terlihat dibagian bawah kanan Karakter Game Anda. Silakan masukkan User ID Anda untuk menyelesaikan transaksi. Contoh ID: v2aer.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Tom and Jerry Chase'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                            Untuk menemukan PlayerID Anda, buka menu "Avatar". PlayerID tercantum di bagian kanan "Avatar" Anda. Untuk menemukan ServerID Anda, silakan masuk ke halaman log-in game dan ServerID dapat Anda temukan disana. Silakan masukan PlayerID dan ServerID untuk menyelesaikan pembayaran Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Valorant'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Riot ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="3">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                            Untuk menemukan Riot ID Anda, buka halaman profil akun dan salin Riot ID+Tag menggunakan tombol yang tersedia disamping Riot ID. (Contoh: VIPayment#123)
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Zepeto'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan ZEPETO ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="4">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                            Untuk menemukan ZEPETO ID/Kode Anda, login ke akun Anda di ZEPETO. Kemudian, klik tombol Profil. Anda akan menemukan ZEPETO ID/Kode dibawah nama dan foto profil Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Marvel Super War'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                            Untuk menemukan ID Anda, buka aplikasi Marvel Super War, klik pada ikon avatar yang terletak di pojok kiri atas layar lalu klik pada tombol kode QR, ID dapat Anda temukan disana. Silakan masukan ID Anda di sini.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Super Sus'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px"></p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'PlayStation Network (PSN)'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Nomor HP" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px"></p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Canva Pro'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Alamat Email" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Disney Hotstar'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Alamat Email" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Garena Shell Murah'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Nomor" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Voucher Garena Shell, produk 100 valid. Kode otomatis terkirim.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'iQIYI Premium'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Nomor HP" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Netflix Premium'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12 mb-1">
                              <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Email" >
                            </div>
                            <div class="col-12 mt-1">
                              <input type="text" name="zone_id" class="form-control" placeholder="Masukkan Request+PIN"">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda. Kolom ke-2 Request Profile + PIN 4 Digit 
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Spotify Premium'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12 mb-1">
                              <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Email" >
                            </div>
                            <div class="col-12 mt-1">
                              <input type="text" name="zone_id" class="form-control" placeholder="Masukkan Username Spotify"">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Vidio Premier'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Alamat Email" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Voucher PB Zepetto'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Nomor HP" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="16">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan nomor telepon saat transaksi, validasi 100% valid!.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Voucher Valorant'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Nomor HP" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="26">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan nomor telepon saat transaksi, validasi 100% valid!.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'WeTV Premium'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Alamat Email" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                            </p>
                          </div>
                        ';
                      }
                      else if($s3['kategori'] == 'Youtube Premium'){
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan Alamat Email" >
                            <input type="hidden" name="zone_id" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px">
                              Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                            </p>
                          </div>
                        ';
                      }
                      else {
                        echo '
                          <div class="form-row pt-3">
                            <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" >
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="1">
                            </div>
                            <p class="col-12 mt-2" style="font-size: 10px"></p>
                          </div>
                        ';
                      }
                    ?>    
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section shadow-sm">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">2</div>
                  <h5 style="margin-left: 45px; margin-top: 5px; color:#ff962d;">Pilih Nominal Layanan</h5>
                  <div class="row pt-3 pl-2 pr-2 mb-2">
                    <?php
                      $kabupaten = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE kategori = '".$s3['kategori']."' AND status = 1 ORDER BY id ASC") or die(mysqli_error());
                      $skk = mysqli_num_rows($kabupaten);
                      if($skk == 0){
                        echo '
                          <div class="col-12">
                            <div class="alert alert-warning alert-dismissible mt-3 mb-0" role="alert">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <div class="alert-icon">
                              <i class="fa fa-exclamation-triangle"></i>
                              </div>
                              <div class="alert-message">
                              <span><strong>Information!</strong> Produk sedang tidak tersedia.</span>
                              </div>
                            </div>
                          </div>
                        ';
                      }
                      else {
                        $no=0;
                        while($kk = mysqli_fetch_array($kabupaten)){
                          $no++;
                      ?>
                      <div class="col-sm-4 col-6">
                        <input required="" type="radio" id="layanan_<?php echo $no; ?>" class="radio-nominale" name="produkID" value="<?php echo $kk['id']; ?>">
                        <label for="layanan_<?php echo $no; ?>"><?php echo $kk['title']; ?></label>
                      </div>
                      <?php }} ?>
                    </div>  
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section shadow-sm">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">3</div>
                  <h5 style="margin-left: 45px; margin-top: 5px; color:#ff962d;">Pilih Pembayaran</h5>
                  <div class="row pt-3 pl-2 pr-2 mb-2" id="result">
                    <?php
                      $apiKey = $s5['api_key'];
                      $curls = curl_init();
                               
                      curl_setopt_array($curls, array(
                        CURLOPT_FRESH_CONNECT     => true,
                        CURLOPT_URL               => "https://tripay.co.id/api/merchant/payment-channel",
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
                      //echo !empty($err) ? $err : $responses;
                      $hasils = json_decode($responses, true);
                      //   var_dump($hasils); die;
                      for ($i=0; $i < count($hasils['data']); $i++) {
                        if($hasils['data'][$i]['active'] == 'true'){
                  ?>
                  <div class="col-sm-4 col-6">
                      <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>" id="flexRadioDefault<?php echo $i; ?>">
                      <label for="flexRadioDefault<?php echo $i; ?>">
                        <div class="row ml-2 mr-2 pb-0">
                          <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="card img-fluid mx-auto mb-1" style="display: block; width: auto; width: 100px; height: 40px;">
                        </div>
                        <div class="row ml-2 mr-2 mb-2 mt-2 mx-auto">
                          <p class="text-center mx-auto" style="font-weight: bold; font-size: 14px;">Rp. -</p>
                        </div>
                      </label>
                    
                  </div>
                  <?php
                      }
                    }
                  ?>
                  </div>  
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section shadow-sm">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">4</div>
                  <h5 style="margin-left: 45px; margin-top: 5px; color:#ff962d;">Konfirmasi Pesanan</h5>
                  <div class="form-group pt-3">
                    <?php
                      if(isset($_SESSION['user'])){
                        $user =mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '".$_SESSION['user']."'") or die (mysqli_error());
                        $u = mysqli_fetch_array($user);
                    ?>
                    <input type="hidden" name="full_name" id="fullname" class="form-control" value="<?php echo $u['full_name']; ?>">
                    <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $u['email']; ?>">
                    <input type="hidden" name="IDuser" id="IDuser" class="form-control" value="<?php echo $u['id']; ?>">
                    <input type="text" name="no_hp" id="noHp" placeholder="Masukan No. Whatsapp" class="form-control" value="" required>
                    <?php } else { ?>
                    <input type="hidden" name="full_name" id="fullname" class="form-control" value="<?php echo $s1b['full_name']; ?>">
                    <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $s1b['email']; ?>">
                    <input type="hidden" name="IDuser" id="IDuser" class="form-control" value="1">
                    <input type="text" name="no_hp" id="noHp" placeholder="Masukan No. Whatsapp" class="form-control" value="" required>
                    <?php } ?>
                    <p class="col-12 mt-2" style="font-size: 10px; color: #666666;">Dengan membeli otomatis saya menyutujui <a href="<?php echo $urlweb; ?>/syarat-ketentuan/" target="_blank" class="text-warning">Ketentuan Layanan</a>.</p>
                    <a id="submitId" value="submit" class="btn btn-primary text-white font-weight-bold w-100 mt-2" style="border-radius:15px;">Beli Sekarang</a>
                  </div>  
                </div>
              </div>
            </div>

            <div class="modal fade" id="formemodales">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-danger text-white animated bounceIn">
                  <div class="modal-header">
                  <h5 class="modal-title">&nbsp;</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body text-center">
                  <i style="font-size:100px" class=" icon-info mb-3 "></i>
                  <p class="mt-3"><strong>Untuk Sementara Transaksi tidak dapat dilakukan!</strong></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="formorder">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white animated bounceIn" id="hasilnya" style="background: #0a4875;"></div>
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
	<script>
	    $(document).ready(function() {
		    $("input:radio[name=produkID]").change(function (){
		        url = "<?php echo $urlweb; ?>/select_game.php?id="+$('input:radio[name=produkID]:checked').val();
		        $('#result').load(url);
		        //console.log(url);
		        return false;
		    });
		    $("#submitId").click(function () {
		      	uri = "<?php echo $urlweb; ?>/get_detail.php?userID="+$("#userID").val()+"&zoneID="+$("#zoneID").val()+"&produkID="+$('input:radio[name=produkID]:checked').val()+"&metode="+$('input:radio[name=metode]:checked').val()+"&IDuser="+$("#IDuser").val()+"&noHp="+$("#noHp").val();
		      	$('#formorder').modal('show');
			    $('#hasilnya').load(uri);
			    console.log(uri);
			    return false;
		    });
	      	$("#buttonSubmit").click(function () {
		    	$("#search_form").submit();
		   	})
	    });
	</script>
</body>
</html>
