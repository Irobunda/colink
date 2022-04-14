<?php
   
    $name = $_POST["name"];
    $email= $_POST["email"];
    $text= $_POST["message"];
    $subject= $_POST["subject"];
    

    $to = "nci.projectemail@gmail.com";
    $headers = "From: ".$email."  \r\n";
    $subject =  'Contact Us';
	$headers .= "Reply-To: nci.projectemail@gmail.com \r\n";    
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

    $message ='<table style="width:100%">
        
        <tr><td> Name: '.$name.' </td></tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>Subject: '.$subject.'</td></tr>
        <tr><td>Message: '.$text.'</td></tr>
        
    </table>';
    
	
	
    if ( @mail($to, $email, $message, $headers))
    {
        $to      = $email;
        $subject = ' CoLink Support Team ';
        $message_body = '
        Hello '.$name.',

        your email has been received and is being treated';  

                        mail( $to, $subject, $message_body );							
 
        echo 'Your message has been sent.';
    }else{
        echo 'failed';
    }
	
?>
