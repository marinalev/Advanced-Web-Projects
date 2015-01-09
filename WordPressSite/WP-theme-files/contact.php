<?php
	/*
	* Template Name: Contact
	*/
?>
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
		$errorMsg .= '<h5 class="error-msg">Please enter your email address.</h5>';
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$errorMsg .= '<h5 class="error-msg">You entered an invalid email address.</h5>';
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$errorMsg .= '<h5 class="error-msg">Please enter a message.</h5>';
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
			return '<h5 class="error-msg">Email sent</h5>';
		}
		else 
		{
			return '<h5 class="error-msg">Email not sent</h5>';	
		}			
	}
	else 
	{
		return '<h5 class="error-msg">Error Sending Email: <br>' . $errorMsg . "</h5>";
	}
}

function getField($fieldName)
{
	if(trim($_POST[$fieldName]) === '')return;
	return trim($_POST[$fieldName]);
}

?>

<?php get_header(); ?>
<div id="content">
	<?php echo submitContact(); ?>
    <div id="contact-content">
    	<?php the_block("Content for Contact"); ?>
	<h2 id="contact">Contact Us</h2>
		<form id="contact-form" action="<?php the_permalink(); ?>" method="post">
			<label for="name">Name:<span>*<span></label>
			<p><input type="nmae" id="name" name="user-name" value="<?php echo getField('user-name'); ?>" /></p>
			
			<label for="email">Email:<span>*<span></label>
			<p><input type="text" id="email" name="email" value="<?php echo getField('email'); ?>" /></p>
			
			<label for="comments">Comments:<span>*<span></label>
			<p><textarea name="comments" id="comment" cols="48" rows="5" tabindex="4"></textarea></p>
			<?php do_action('bwp_recaptcha_add_markups'); ?> <!--add recaptcha-->
			<input class="read-post left" id="contact-submit" type="submit" value="Submit" name="submit" value=>
		</form>
	</div>
	<div class="side-bar right"> <!--start contact-sidebar div-->
		<p id="find">Find Us</p>
		<div id="map" class=" left">
			<iframe width="200" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=234+Denny+Way++Seattle,+WA++USA&amp;sll=47.272986,-120.882277&amp;sspn=3.921178,9.876709&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=234+Denny+Way,+Seattle,+Washington+98109&amp;z=14&amp;ll=47.618591,-122.351633&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=234+Denny+Way++Seattle,+WA++USA&amp;sll=47.272986,-120.882277&amp;sspn=3.921178,9.876709&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=234+Denny+Way,+Seattle,+Washington+98109&amp;z=14&amp;ll=47.618591,-122.351633" style="color:#0000FF;text-align:left">View Larger Map</a></small>
		</div>
	</div> <!--end contact-sidebar div-->
</div>
<?php get_footer(); ?>






