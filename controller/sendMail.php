<?php

include('../PHPMailer/src/SMTP.php');
include('../PHPMailer/src/Exception.php');
include('../PHPMailer/src/PHPMailer.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions


if(isset($_GET["status"])){

    $file = $_FILES['file'];

    $filename = $file['name'];

    $name = $_POST['name'];

    $email = $_POST['email'];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    $filePath = "../tmp-file/".hexdec(uniqid()).'.'.$ext;

    $move = move_uploaded_file($file['tmp_name'],$filePath);
    
    $mail = new PHPMailer(true);

    if($move){
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            // $mail->isSMTP();                                            //Send using SMTP
            // $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            // $mail->Username   = 'b1a06398850199';                     //SMTP username
            // $mail->Password   = '9cdee17c0336c1';                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            // $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'b1a06398850199';
            $mail->Password = '9cdee17c0336c1';

            //Recipients
            $mail->setFrom('company@gmail.com', 'Company');
            $mail->addAddress($email, $name);     //Add a recipient
            $mail->addAddress('company@gmail.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            $mail->addAttachment($filePath);         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Test';
            $mail->Body    = 'Add file';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            if($mail->send()){
                unlink($filePath);
                echo 'Message has been sent';
            }
            
        } 
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}