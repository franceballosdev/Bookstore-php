<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<?php

            if(!isset($_SERVER['HTTP_REFERER'])){
                header("Location: index.php");
                exit;
            }

            $select = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
            $select->execute();
            $allProducts = $select->fetchAll(PDO::FETCH_OBJ);


            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            require 'src/Exception.php';
            require 'src/PHPMailer.php';
            require 'src/SMTP.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'bookstorefile@gmail.com';              //SMTP username
                $mail->Password   = 'dteevkoyamwqosaa';                     //SMTP password
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Sender
                $mail->setFrom('bookstorefile@gmail.com', 'Bookstore');

                //Add a recipient
                $mail->addAddress($_SESSION['email'], $_SESSION['username']);     

                foreach($allProducts as $products) {
                    $path  = 'books';
                    //$file = $products->pro_file;
        
                    for($i=0; $i < count($allProducts); $i++) {
                      
                        $mail->addAttachment($path . "/" . $products->prod_file);         //Add attachments
        
                    }
                }

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'The books you purchased!';
                $mail->Body    = '<b>Here are the books you purchased from our bookstore, '.$_SESSION['username'].',<br> thank you!</b>';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



                $mail->send();
                $select = $conn->query("DELETE FROM cart WHERE user_id='$_SESSION[user_id]'");
                $select->execute();
                header("Location: index.php");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            