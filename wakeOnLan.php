<?php
    
    include_once("Include/dataBaseManager.php");
    include_once("wakeOnLanManager.php");

    
	
	
    
    $id_utente = check_login();
    if($id_utente != -1)
        sendSignal();
    
    

?>
