<?php
/*
 *  CONFIGURE EVERYTHING HERE
 */



// an email address that will receive the email with the output of the form
$sendTo = 'hello@edivaexports.com';






// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';


/*
 *  LET'S DO THE SENDING
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting( E_ALL & ~E_NOTICE );

try {

	if ( count( $_POST ) == 0 && ! isset($_POST['name'])&& ! isset($_POST['email'])&& ! isset($_POST['message'])) {
		throw new \Exception( 'Form is empty' );
	}

	// an email address that will be in the From field of the email.
// ...

// ...

$from = $_POST['email'];
$subject = "Contact Form Submission";
$message = "
First Name: $_POST[name]
Email: $_POST[email]
Message: $_POST[message]
Budget: $_POST[budget]
Data: $_POST[data]

";








	$headers = 'From: ' . $from . "\r\n" .
	           'Reply-To: ' . $sendTo . "\r\n" .
	           'X-Mailer: PHP/' . phpversion();



	// Send email
	mail( $sendTo, $subject, $message );

	$responseArray = array('type' => 'success', 'message' => $okMessage);
} catch ( \Exception $e ) {
	 $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


// if requested by AJAX request return JSON response
if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
	$encoded = json_encode( array( 'status' => true, 'message' => $errorMessage ) );

	header( 'Content-Type: application/json' );

	echo $encoded;
} // else just display the message
else {
	$encoded = json_encode( array(  'message' => $okMessage  ) );

	header( 'Content-Type: application/json' );

	echo $encoded;
}




// <?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = $_POST["name"];
//     $email = $_POST["email"];
//     $message = $_POST["message"];
//     $budget = $_POST["budget"];
//     $data = $_POST["data"];

//     // Change the following email address to your desired recipient email
//     $recipient_email = "projects@pheonix-homes.in";
//     $subject = "Form Submission from $name";

//     // Compose the email content
//     $email_content = "Name: $name\n";
//     $email_content .= "Email: $email\n";
//     $email_content .= "Message:\n$message\n";
//     $email_content .= "Budget: $budget\n";
//     $email_content .= "Data: $data\n";

//     // Set headers to indicate HTML email
//     $headers = "MIME-Version: 1.0" . "\r\n";
//     $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
//     $headers .= "From: $name <$email>" . "\r\n";

//     // Send the email
//     if (mail($recipient_email, $subject, $email_content, $headers)) {
//         echo "Form submitted successfully.";
//     } else {
//         echo "Form submission failed. Please try again later.";
//     }
// } else {
//     echo "Invalid request method.";
// }
// ?>
