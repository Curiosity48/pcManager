

<?php
include_once("Include/dataBaseManager.php");
include_once("wakeOnLanManager.php");

$id_utente = check_login();
if($id_utente == -1){
  header("Location: index.php");
} else {
    $db = database_connect();
    $data = $db->query("SELECT * from utenti where id = '$id_utente'");
    $utente = $data->fetch_assoc();
 ?>

    Benvenuto, <?php echo $utente["email"]; ?>!
    <html>
        <head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
        



        </head>
        <body>
        
            <label>Desktop Samuele</label>
            <?php chkIfTheDeviceIsOn()?>
            <form action = "wakeOnLan.php" method  = "post">
                
                <button onclick="wakeOnLan.php" type = "submit">Avvia</button>
            </form>
        
        
        </body>
    </html> 

<?php
}
?>









