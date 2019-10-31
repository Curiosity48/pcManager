<?php
function database_connect(){
  $host = "localhost";
  $user = "root";
  $password = "mob4884lol11";
  $database = "login";
  $db = new mysqli($host, $user, $password, $database);
  if($db->connect_error){
    return 0;
	}
	else{
		return $db;
  }
}

function check_login(){
	session_start();
	$db = database_connect();
	if(isset($_SESSION['login_user'])){
		$userid=$_SESSION['login_user'];
		$result = $db->query("select * from sessioni where userid='".$db->escape_string($userid)."'") or die('ERRORE: ' . $db->error);
		$rows = $result->num_rows;
		if ($rows>=1){
			$row = $result->fetch_assoc();
			$time = $row['time'];
			if(time()-$time>2700){
				$db->close();
				header('Location: include/logout.php');
				return -1;
			}
			$user=$row['user'];
			$db->query("UPDATE sessioni SET time=".time()." WHERE user='".$db->escape_string($user)."'");
			$db->close();
			return $user;
		}
		else{
			$db->close();
			return -1;
		}
	}
	else return -1;
}

?>