<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com'; // Set your SMTP server address here
        $mail->SMTPAuth = true;
        $mail->Username = 'info@ecoglassng.com'; // SMTP username
        $mail->Password = 'Ecoglass@info2024'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('info@ecoglassng.com', 'Ecoglass'); // Set the 'from' address
        $mail->addAddress('info@ecoglassng.com', 'Ecoglass'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "<h2>Contact Form Submission</h2>
                       <p><strong>Name:</strong> {$name}</p>
                       <p><strong>Email:</strong> {$email}</p>
                       <p><strong>Phone:</strong> {$phone}</p>
                       <p><strong>Subject:</strong> {$subject}</p>
                       <p><strong>Message:</strong><br>{$message}</p>";

        $mail->send();

       echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
    }
}
?>