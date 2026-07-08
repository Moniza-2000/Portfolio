<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // ===========================
        // CHANGE THESE
        // ===========================

        $mail->Username = 'rmoniza2005@gmail.com';
        $mail->Password = 'kdef xqwq ubzz jvul';

        // ===========================

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender
        $mail->setFrom('rmoniza2005@gmail.com', 'Portfolio Website');

        // Receiver
        $mail->addAddress('rmoniza2005@gmail.com');

        // Reply to Visitor
        $mail->addReplyTo($email, $name);

        // Email Content
        $mail->isHTML(true);

        $mail->Subject = $subject;

        $mail->Body = "
        <h2>New Contact Form Message</h2>

        <b>Name:</b> {$name}<br><br>

        <b>Email:</b> {$email}<br><br>

        <b>Subject:</b> {$subject}<br><br>

        <b>Message:</b><br>
        {$message}
        ";

        $mail->send();

        echo "<script>
            alert('Thank you! Your message has been sent successfully.');
            window.location='index.php';
            </script>";

    } catch (Exception $e) {

        echo "<script>
        alert('Message could not be sent.');
        window.location='index.html';
        </script>";

    }

}

?>