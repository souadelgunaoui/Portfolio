<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// Check if form data is submitted
if (isset($_POST['send'])) {
    // Retrieve form data
    $name = strip_tags(htmlspecialchars($_POST['userName']));
    $email = strip_tags(htmlspecialchars($_POST['userEmail']));
    $m_subject = strip_tags(htmlspecialchars($_POST['userSubject']));
    $message = strip_tags(htmlspecialchars($_POST['userMessage']));

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'souadelg123@gmail.com';               // SMTP username
        $mail->Password   = 'jnuebxmyvyxgypbo';                    // SMTP password (App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('souadelg123@gmail.com', 'Souad123');
        $mail->addAddress('souadelgunaoui@gmail.com');              // Add a recipient (you can add multiple recipients)

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Contact Form Message from ' . $name;
        $mail->Body    = "<p>You have received a new message from your website contact form.</p>
                          <p><strong>Name:</strong> $name</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Subject:</strong> $m_subject</p>
                          <p><strong>Message:</strong><br>" . nl2br($message) . "</p>";

        // Send the email
        if ($mail->send()) {
            echo 'Message has been sent successfully.';
        } else {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
    }
}
