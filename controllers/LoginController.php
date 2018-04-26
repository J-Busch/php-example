<?php

class LoginController {

	public function index() {
		require_once('views/login/index.php');
	}

	public function login() {
		$db = DB::getInstance();

		$errors = array();

		// EMAIL
	    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	    	$errors['email'] = 'Must enter a valid email.';
	    }
	    else {
	    	$email = trim($_POST['email']);
	    }
	    // PASSWORD
	    if(strlen(trim($_POST['password'])) < 6) {
	        $errors['password'] = 'Password must be more than 6 characters.';
	    }
	    else {
	        $password = trim($_POST['password']);
	    }

	    if(empty($errors)) {
	    	$sql = "SELECT id, email, password FROM users WHERE email = :email";
         
	        if($stmt = $db->prepare($sql)) {
	            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);

	            $param_email = $email;

	            if($stmt->execute()) {
	                if($stmt->rowCount() == 1) {
	                    if($row = $stmt->fetch()) {
	                        $hashed_password = $row['password'];
	                        if(password_verify($password, $hashed_password)) {
	                            session_start();
	                            $_SESSION['user_id'] = $row['id'];
	                            header("location: /profile");
	                            exit;
	                        } else {
	                            $errors['password'] = 'The password you entered was not valid.';
	                            require_once('views/login/index.php');
	                        }
	                    }
	                } else {
	                    $errors['email'] = 'No account found with that email.';
	                    require_once('views/login/index.php');

	                }
	            } else {
	                echo "Oops! Something went wrong. Please try again later.";
	            }
	        }
	    }
	    else {
    		require_once('views/login/index.php');
    	}

	    unset($db);
	}
}

?>