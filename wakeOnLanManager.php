<?php

function sendSignal()   {
        $mac = '00:D8:61:38:60:AB';
        $port = 4343;
        $ip = '255.255.255.255';
        $message = exec("wakeonlan -p $port -i $ip $mac");
        echo $message;
        echo "\r\n";
        sleep(15);
        chkIfTheDeviceIsOn();
    }
    
function chkIfTheDeviceIsOn() {

    $SamDesktopPc = "192.168.2.101";

    $message = exec("ping -c 3 $SamDesktopPc ");


    //echo $message;


    if(strpos($message, 'ms') == true)
        echo "Dispositivo accesso !!";
    else 
       echo "Attenzione il dispositivo non è accesso !";

}

?>