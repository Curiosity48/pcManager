<?php
  include_once('dataBaseManager.php');
  if (isset($_POST['send'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
      echo "Inserire email e password!";
    }
    else{
      $db = database_connect() or die("Errore di connessione");
      $email=$db->escape_string($_POST['email']);
      $password=hash("sha512", $db->escape_string($_POST['password']));
      $time = time();
      $result = $db->query("SELECT * from utenti where password='$password' AND email='$email' AND confermato='1'") or	die('ERRORE: ' . $db->error);
      if($result->num_rows == 1) {
         $row=$result->fetch_assoc();
         $hash = bin2hex(openssl_random_pseudo_bytes(32));
         $db->query("DELETE from sessioni where userid = '".$row['id']."'") or die('ERRORE: ' . $db->error);
         $db->query("INSERT INTO sessioni (user, userid, time) VALUES ('".$row['id']."', '$hash', $time)") or die('ERRORE: ' . $db->error);
         session_start();
         $_SESSION['login_user']=$hash;
         header("Location: ../wakeOnLanList.php");
      }
      else{
        session_start();
        $_SESSION['login_user']=-1;
        echo 'Username o password non validi';
      }
    }
  }

?>