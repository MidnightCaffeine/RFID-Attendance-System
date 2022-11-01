<?php 

try{
    $pdo = new PDO('mysql:host=127.0.0.1:3307;dbname=rfid_attendance','root','');
    //echo'Connection Successful!';

    
}catch(PDOException $f){
    
    echo $f->getmessage();
}


?>