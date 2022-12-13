<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Jakarta");
include('config/koneksi.php');

$last_login = date('Y-m-d H:i:s');
$user = mysqli_real_escape_string($conn,$_POST['user']);
$pass = md5($_POST['pass']);
$pass = mysqli_real_escape_string($conn,$pass);
if (empty($user) && empty($pass)) {
    header('location:../login/?error=1');
    exit;
} else if (empty($user)) {
    header('location:../login/?error=2');
    exit;
} else if (empty($pass)) {
    header('location:../login/?error=3');
    exit;
}


$q = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$user' AND pass = '$pass'") or die(mysqli_error($conn));
if (mysqli_num_rows($q) > 0) {
	$user_data = mysqli_fetch_array($q,MYSQLI_ASSOC);
	$token = insertToken($user_data['id']);
	$userID = $user_data['id'];
	$level = $user_data['level'];
	$_SESSION['user'] = $user;
	$_SESSION['token'] = $token;

	$update = mysqli_query($conn,"UPDATE `tb_user` SET last_login = '$last_login' WHERE user = '".$_SESSION['user']."'") or die(mysqli_error());
	header('location:../e_user/');
	
} else {
    header('location:../login/?error=4');
}

function insertToken($user_id = 0){
    $conn = $GLOBALS['conn'];
	if(empty($user_id) && $user_id === 0){
		return false;
	}

	$token = generateToken();
	$sql_insert_token = "INSERT INTO tb_token (token) VALUES ('$token')";
	$query_insert_token = mysqli_query($conn,$sql_insert_token) or die(mysqli_error($conn));
    $token_id = mysqli_insert_id($conn);

	// update table user
	$sql_update_user = "UPDATE tb_user SET token_id = $token_id WHERE id = $user_id;";
	$query_update_user = mysqli_query($conn,$sql_update_user) or die(mysqli_error($conn));
	return $token;
}

function generateToken(){
	$length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

	$token = md5(microtime(true).$characters);
	return $token;
}

?>