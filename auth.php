<?php 
$userid = isset($_POST['userid'])? 
	$_POST['userid']: null;
$password = isset($_POST['password'])? 
	$_POST['password']: null;

if(!empty($userid) && !empty($password)){
	$option = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	);
	$conn = new PDO("mysql:host=localhost;dbname=/各自のDB名/;charset=utf8",
		"", "", $option);
	$sql = "SELECT * FROM user "
		."WHERE User_ID ='{$userid}' AND "
		."Password='{$password}'";
	$result = $conn->query($sql);
	$u = $result->fetch();
	if(!empty($u)){
		session_start();
		$_SESSION['login_user'] = $u;
		echo "ようこそ,<a href='index.html'>{$u['name']}</a>さん！";
	}else{
		echo '認証できませんでした';
	}
}else{
	echo 'userid,passwordを指定してください。';
}
?>