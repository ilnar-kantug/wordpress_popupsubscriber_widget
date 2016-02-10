<?
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		// Get Post Data
		$name = strip_tags(trim($_POST['name']));
		$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
		$recipient = strip_tags(trim($_POST['recipient']));
		$subject = strip_tags(trim($_POST['subject']));
		
		// Validation
		if(empty($name) || empty($email)){
			// Send Error
			//http_response_code(400);
			echo 'Please Fill Out All Fields Correctly';
			exit;
		}
		
		//Build Email
		$message = "Name: $name\n";
		$message .= "Email: $email\n";
		
		$headers = "From: $name <$email>";
		
		
		if(mail($recipient,$subject,$message,$headers)){
			echo 'You are know subscribed';
		}else{
			echo 'There was a problem';
		}
	}else{
		echo 'There was a problem';
	}
