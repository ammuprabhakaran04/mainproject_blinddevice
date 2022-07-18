<?php
error_reporting(0);
include("connection.php");

set_time_limit(0);

$email = $_REQUEST['email'];
$pass = $_REQUEST['pass']; 

set_time_limit(0); 
 
$em = $email;
set_time_limit(4000); 
 
// Connect to gmail


    $domainURL = 'studentsinnovations.com';              // Your websites domain
    $useHTTPS = true;  



    $imap = imap_open('{'.$domainURL.':143/notls}INBOX', 'blindemail@studentsinnovations.com', 'Blind@2022#');
 
  $message_count = imap_num_msg($imap);
  // echo $message_count."htfhtfh";
 
 
  
//echo "<br><br>";
    for ($i = 2; $i <= $message_count; ++$i) {
        $header = imap_header($imap, $i);
        $body = trim(substr(imap_body($imap, $i), 0, 10000));
        $prettydate = date("jS F Y", $header->udate);

        if (isset($header->from[0]->personal)) {
            $personal = $header->from[0]->personal;
        } else {
            $personal = $header->from[0]->mailbox;
        }

        $email = "$personal {$header->from[0]->mailbox}";
		$body=explode("UTF-8",$body);
		$body=explode("--",$body[1]);
		  // echo "$prettydate *** $email *** $body[0] ----------------<br>";
        // echo "On $prettydate, $email said \"$body\".<br> ----------------<br>";
		mysqli_query($con,"insert into inbox(content,sender,recipient) values ('$body[0]','$email','$em')");
    }

    imap_close($imap);
 
	$res = mysqli_query($con,"select * from inbox where recipient = '$em' ORDER BY id DESC limit 0,5");
	
	if(mysqli_num_rows($res)>0){
		while($row = mysqli_fetch_array($res))
		{
			$result[] = $row;
		}
		
	echo json_encode($result);
	}
	else{
	echo "failed";
	}

mysqli_close($con);
?>