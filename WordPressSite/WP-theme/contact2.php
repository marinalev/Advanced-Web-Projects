<?php

function submitContact()
{
	$errorMsg = "";
	if(!isset($_POST['submit'])) return "";

	if(trim($_POST['user-name']) === '') {
		$errorMsg .= 'Please enter your name.<br>';
	} else {
		$userName = trim($_POST['user-name']);
	}

	if(trim($_POST['email']) === '')  {
		$errorMsg .= 'Please enter your email address.<br>';
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$errorMsg .= 'You entered an invalid email address.<br>';
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$errorMsg .= 'Please enter a message.<br>';
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if($errorMsg == "") {
		$emailTo = "marina.levonian@gmail.com";
		$subject = 'Contact Email From '.$userName;
		$body = "$comments";
		$headers = 'From: '.$userName.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		echo "Email to: $emailTo <br>";
		echo "Subject: $subject<br>";
		echo "Body: $body<br>";
		echo "Headers: $headers<br>";
		if(wp_mail($emailTo, $subject, $body, $headers))
		{
			return "Email sent";
		}
		else 
		{
			return "Email not sent";	
		}			
	}
	else 
	{
		return "<p>Error Sending Email: <br>" . $errorMsg . "</p>";
	}
}

function getField($fieldName)
{
	if(trim($_POST[$fieldName]) === '')return;
	return trim($_POST[$fieldName]);
}

?>