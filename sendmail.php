<?php
//include("backup_mail.php");

$pwd=$_POST['pwd']; 
$semail=$_POST['semail']; 
$remail=$_POST['remail']; 
$sub=$_POST['subject']; 
$content=$_POST['content']; 



$url="https://alc-training.in/gateway.php?"; 
$email=$remail;

$subject=$sub;
$title=$sub;


$message = urlencode($content);
$ch = curl_init();
if (!$ch){die("Couldn't initialize a cURL
handle");} $ret = curl_setopt($ch,CURLOPT_URL,$url); 
curl_setopt ($ch,CURLOPT_POST, 1);
curl_setopt($ch,
CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch,CURLOPT_POSTFIELDS,"email=$email&msg=$message&subject=$subject");
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//If you are behind proxy then please uncomment below line and provide your proxyip with port.
 // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
$curlresponse = curl_exec($ch); //
 if(curl_errno($ch))
echo 'curl error : '. curl_error($ch);
if (empty($ret)) {
// some kind of an error
echo "Mailer Error: " ;
die(curl_error($ch));
curl_close($ch); // close cURL
 } else {

$info = curl_getinfo($ch);
curl_close($ch); // close cURL
 echo "E-Mail has been sent";

}

?>
