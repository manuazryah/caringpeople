<?php

$to = "sabitha@azryah.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: info@azryah.com" . "\r\n";


if(mail($to, $subject, $txt, $headers)){
    die('if');
} else{
    die('else');
}
?>