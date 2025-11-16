use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['girisha2536@gmail.com']; // Securely load email
    $mail->Password = $_ENV['SMTP_PASS']; // Securely load password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('your-email@gmail.com', 'Your Name');

    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission: ' . $_POST['subject'];
    $mail->Body    = "<p><strong>Name:</strong> {$_POST['name']}</p>
                      <p><strong>Email:</strong> {$_POST['email']}</p>
                      <p><strong>Message:</strong> {$_POST['message']}</p>";

    $mail->send();
    echo 'Message has been sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
