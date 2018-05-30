<?php
$to = "sabitha@azryah.com,sabitha393@gmail.com";
$subject = "Enquiry Received";

$message = '
<html>
<head>
  <title>Enquiry Received From Website</title>
</head>
<body>
  <table>
<tr>
<th>Name</th>
<th>:-</th>

<td>123</td>
    </tr>

 <tr>

<th>Email</th>
<th>:-</th>
<td>123</td>
         </tr>



 <tr>
<th>Contact Number</th>
<th>:-</th>
<td>123</td>
     </tr>
     <tr>

<th>Message</th>
<th>:-</th>
<td>fdfd</td>

</tr>

  </table>
</body>
</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: info@astrolinesteel.com' . "\r\n";


if(mail($to,$subject,$message,$headers))
die('sent');
else
die('notsent');



if(mail($to,$subject,$message,$headers))
die('if');
else
die('else');

?>
