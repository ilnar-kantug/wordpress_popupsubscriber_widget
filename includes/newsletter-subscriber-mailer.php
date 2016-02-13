<?
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		// Get Post Data
		$name = strip_tags(trim($_POST['name']));
		$recipient = strip_tags(trim($_POST['recipient']));
		$email = strip_tags(trim($_POST['email']));
		$subject = strip_tags(trim($_POST['subject']));
		$writingToFileEnable = strip_tags(trim($_POST['writingToFileEnable']));
		$successMessage = strip_tags(trim($_POST['successMessage']));
		
		// Validation
		if(empty($name) || empty($email)){
			// Send Error
			_e('Please Fill Out All Fields Correctly','ns_domain');
			exit;
		}
		
		//Build Email
		$message = "Name: $name\n";
		$message .= "Email: $email\n";
		$headers = "From: $name <$email>";
		
		//writing user data to a csv file
		if($writingToFileEnable == '1'){
			$user_CSV[0] = array($name, $email);
			$fp = fopen('../subscribers_list.csv', 'a');
			foreach ( $user_CSV as $line ) {
				fputcsv($fp, array_values($line), ';');
			}
			fclose($fp);
		}
		
		
		
		if(mail($recipient,$subject,$message,$headers)){
			echo $successMessage;
		}else{
			_e('There was a problem','ns_domain');
		}
	}else{
		_e('There was a problem','ns_domain');
	}
