<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "info@cleanworldedinburgh.com";
        
        # Sender Data
        $subject = "Mensaje de la web";
        
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
 
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }
        
        # Mail Content
        $content = "Name: $name\n";
        $content .= "Email: $email\n\n";
        $content .= "Message:\n$message\n";

        # email headers.
        $headers = "From: $name <$email>";

        # Send the email.
        $success = mail($mail_to, $subject, $content, $headers);
        
        
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            http_response_code(200);
            echo '<script language="javascript">
            alert("Thanks! We will contact you soon");
            window.location= "contact.html"
            </script>';

        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo '<script language="javascript">
            alert("Oops! Something went wrong, please try again later.");
            window.location= "contact.html"
            </script>';
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo '<script language="javascript">
        alert("Oops! Something went wrong, please try again.");
        window.location= "contact.html"
        </script>';
    }

?>
