<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form correctly.";
        exit;
    }

    $recipient = "arpana@asapgp.com";  // Or shailendrasingh.vapi@gmail.com
    $subject = "New Enquiry from ASAP Growth Partners Website";

    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: inquiry@asapgp.com\r\n";
    $email_headers .= "Reply-To: $email\r\n";

    // GoDaddy allows mail() without extra config
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Redirect to thank you
        header("Location: yourpage.html?thankyou=true#thank-you");
    } else {
        echo "Oops! Something went wrong.";
    }
}
?>
