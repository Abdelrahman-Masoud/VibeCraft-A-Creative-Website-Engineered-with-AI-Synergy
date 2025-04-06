<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Your email address where you want to receive messages
    $to = "your-email@yourdomain.com"; // Replace with your actual email
    
    // Email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    // Email content
    $email_content = "
    <html>
    <body>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>$message</p>
    </body>
    </html>
    ";
    
    // Send email
    if (mail($to, "New Contact Form Submission: $subject", $email_content, $headers)) {
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message. Please try again.']);
    }
} else {
    // Return error response for non-POST requests
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?> 