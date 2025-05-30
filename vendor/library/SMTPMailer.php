<?php
class SMTPMailer
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $useTLS; // Boolean to enable/disable TLS encryption
    private $from;
    private $to = [];
    private $cc = [];
    private $bcc = [];
    private $subject = '';
    private $body = '';
    private $attachments = [];
    private $isHtml = false;

    /**
     * Constructor to set SMTP configuration.
     */
    public function __construct($host, $port, $username, $password, $useTLS = true)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->useTLS = $useTLS;
    }
     /**
     * Set the sender's email address.
     */
    private function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address: $email");
        }
    }

    /**
     * Set the sender's email address.
     */
    public function setFrom($email)
    {
        $this->validateEmail($email);
        $this->from = $email;
    }

    /**
     * Add recipient(s) to the email.
     */
    public function addTo($email)
    {
        $emails = (array) $email;
        foreach ($emails as $address) {
            $this->validateEmail($address);
        }
        $this->to = array_merge($this->to, $emails);
    }

    /**
     * Add CC recipient(s) to the email.
     */
    public function addCc($email)
    {
        $emails = (array) $email;
        $this->cc = array_merge($this->cc, (array) $email);
    }

    /**
     * Add BCC recipient(s) to the email.
     */
    public function addBcc($email)
    {
        $this->bcc = array_merge($this->bcc, (array) $email);
    }

    /**
     * Set the email subject.
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Set the email body.
     */
    public function setBody($body, $isHtml = false)
    {
        $this->body = $body;
        $this->isHtml = $isHtml;
    }

    /**
     * Add an attachment to the email.
     */
    public function addAttachment($filePath, $fileName = null)
    {
        if (file_exists($filePath)) {
            $this->attachments[] = [
                'path' => $filePath,
                'name' => $fileName ?? basename($filePath),
            ];
        } else {
            throw new Exception("File not found: $filePath");
        }
    }

    /**
     * Send the email via SMTP.
     */
    public function send()
    {
        // Create a socket connection
        $socket = fsockopen($this->host, $this->port, $errno, $errstr, 10);

        if (!$socket) {
            throw new Exception("Connection failed: $errstr ($errno)");
        }

        $this->readResponse($socket);
        $this->smtpCommand($socket, "EHLO " . $this->host);

        // Start TLS encryption if enabled
        if ($this->useTLS) {
            $this->smtpCommand($socket, "STARTTLS");
            if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new Exception("Failed to enable TLS encryption.");
            }
            $this->smtpCommand($socket, "EHLO " . $this->host); // Reinitialize after TLS
        }

        $this->smtpCommand($socket, "AUTH LOGIN");
        $this->smtpCommand($socket, base64_encode($this->username));
        $this->smtpCommand($socket, base64_encode($this->password));
        $this->smtpCommand($socket, "MAIL FROM: <$this->from>");

        foreach ($this->to as $recipient) {
            $this->smtpCommand($socket, "RCPT TO: <$recipient>");
        }

        foreach ($this->cc as $recipient) {
            $this->smtpCommand($socket, "RCPT TO: <$recipient>");
        }

        foreach ($this->bcc as $recipient) {
            $this->smtpCommand($socket, "RCPT TO: <$recipient>");
        }

        $this->smtpCommand($socket, "DATA");

        $headers = $this->buildHeaders();
        $message = $this->buildMessage();

        fwrite($socket, $headers . "\r\n\r\n" . $message . "\r\n.\r\n");
        $response = $this->readResponse($socket);

        $this->smtpCommand($socket, "QUIT");

        fclose($socket);

        if (strpos($response, '250') === false) {
            throw new Exception("Failed to send email: $response");
        }

        return true;
    }

    /**
     * Execute an SMTP command and read the response.
     */
    private function smtpCommand($socket, $command)
    {
        fwrite($socket, $command . "\r\n");
        return $this->readResponse($socket);
    }

    /**
     * Read the response from the SMTP server.
     */
    private function readResponse($socket)
    {
        $response = fgets($socket, 512);
        if (!$response) {
            throw new Exception("No response from SMTP server.");
        }
        return $response;
    }

    /**
     * Build the email headers.
     */
    private function buildHeaders()
    {
        $boundary = "boundary1";
        $headers = "From: <$this->from>\r\n";
        $headers .= "To: " . implode(', ', $this->to) . "\r\n";

        if (!empty($this->cc)) {
            $headers .= "Cc: " . implode(', ', $this->cc) . "\r\n";
        }

        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        return $headers;
    }

    /**
     * Build the email message with attachments.
     */
    private function buildMessage()
    {
        $boundary = "boundary1";
        $message = "--$boundary\r\n";
        $message .= "Content-Type: " . ($this->isHtml ? "text/html" : "text/plain") . "; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= $this->body . "\r\n";

        foreach ($this->attachments as $attachment) {
            $fileContent = chunk_split(base64_encode(file_get_contents($attachment['path'])));
            $message .= "--$boundary\r\n";
            $message .= "Content-Type: application/octet-stream; name=\"{$attachment['name']}\"\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n";
            $message .= "Content-Disposition: attachment; filename=\"{$attachment['name']}\"\r\n\r\n";
            $message .= $fileContent . "\r\n";
        }

        $message .= "--$boundary--\r\n";

        return $message;
    }
}

/*
// Usage Example
$mailer = new SecureSMTPMailer('smtp.example.com', 587, 'username@example.com', 'password', true); // TLS enabled
$mailer->setFrom('you@example.com');
$mailer->addTo(['recipient1@example.com', 'recipient2@example.com']);
$mailer->addCc('cc@example.com');
$mailer->addBcc('bcc@example.com');
$mailer->setSubject('Test Email with Optional TLS');
$mailer->setBody('<h1>Hello, World!</h1><p>This is a test email with optional TLS encryption.</p>', true);
$mailer->addAttachment('/path/to/file.pdf');

try {
    if ($mailer->send()) {
        echo "Email sent successfully!";
    }
} catch (Exception $e) {
    echo "Failed to send email: " . $e->getMessage();
}*/
?>
