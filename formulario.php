<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $address=$_POST['address'];
        $bedrooms=$_POST['bedrooms'];
        $bathrooms=$_POST['bathrooms'];
        $city=$_POST['city'];
        $code=$_POST['code'];
        $comments=$_POST['comments'];
        $details=$_POST['details'];
        $email=$_POST['email'];
        $extras=$_POST['extras'];
        $hours=$_POST['hours'];
        $lastName=$_POST['lastName'];
        $name=$_POST['name'];
        $often=$_POST['often'];
        $phone=$_POST['phone'];
        $preferedDay=$_POST['preferedDay'];
        $preferedTime=$_POST['preferedTime'];
        $street=$_POST['street'];
        $typeClean=$_POST['typeClean'];


        # FIX: Replace this email with recipient email
        $mail_to = "info@cleanworldedinburgh.com";
        
        # Sender Data
        $subject = "You have a new message: ";
        
        //$name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
 
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = "Name: $name  $lastName <br/><br/>".
        "Email: $email <br/><br/>".
        "Phone: $phone <br/><br/>".
        "Street: $street <br/><br/>".
        "Address: $address <br/><br/>".
        "Postal Code: $code <br/><br/>".
        "Type Clean: $typeClean <br/><br/>".
        "Hours por Clean: $hours <br/><br/>".
        "How Often?: $often <br/><br/>".
        "Bedrooms: $bedrooms <br/><br/>".
        "Extras: $extras <br/><br/>".
        "Prefered Day: $preferedDay <br/><br/>".
        "Prefered Time: $preferedTime <br/><br/>".
        "Comments: $comments <br/><br/>".
        "Details to the areas: $details \n\n";

        $validationName=empty($name);
        $validationEmail=filter_var($email, FILTER_VALIDATE_EMAIL);
        $validationSubjet=empty($subject);
        $validationMessage=empty($message);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            $response=[
                'response'=>'All fields are requered'
            ];
            die(json_encode($response));
            //exit;
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
            $response=[
                'response'=>'The message has been sent'
            ];
            die(json_encode($response));

            //echo "Thank you! Your message was sent correctly.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            $response=[
                'response'=>'The message has not been sent'
            ];
            die(json_encode($response));
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        $response=[
            'response'=>'Server not found'
        ];
        die(json_encode($response));
    }

?>
