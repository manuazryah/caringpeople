<?php
$to = "sabitha@azryah.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: info@caringpeople.in" . "\r\n";
if(mail($to,$subject,$txt,$headers)){
die('if');
} else{
die('else');
}

?>