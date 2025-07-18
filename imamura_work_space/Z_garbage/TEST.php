<?php
$to = "ramirisu193@gmail.com";
$subject = "TEST MAIL";
$message = "Hello!\r\nThis is TEST MAIL.";
$headers = "From: from@samurai.jp";
 
$bool=mail($to, $subject, $message, $headers);
echo $bool;
?>

