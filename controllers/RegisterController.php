<?php

class RegisterController {

	public function index() {
		require_once('views/register/index.php');
	}

	public function register() {

		$db = DB::getInstance();

		$errors = array();

	    /*
			FORM VALIDATION START
	    */
		// FIRST NAME
	    if(!preg_match("/[a-zA-Z -]+$/", $_POST['first_name'])) {
	        $errors['first_name'] = 'First name can only be letters, dashes, and spaces.';
	    }
	    else {
	        $first_name = trim($_POST['first_name']);
	    }

	    // LAST NAME
	    if(!preg_match("/[a-zA-Z -]+$/", $_POST['last_name'])) {
	        $errors['last_name'] = 'Last name can only be letters, dashes, and spaces.';
	    }
	    else {
	        $last_name = trim($_POST['last_name']);
	    }

	    // DATE OF BIRTH
	    if(!preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/", $_POST["date_of_birth"])) {
	        $errors['date_of_birth'] = 'Date must comply with this format: YYYY-MM-DD';
	    }
	    else {
	        $date_of_birth = trim($_POST['date_of_birth']);
	    }

	    // EMAIL
	    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	    	$errors['email'] = 'Must enter a valid email.';
	    }
	    else {
	    	$sql = "SELECT id FROM users WHERE email = :email";
	        
	        if($stmt = $db->prepare($sql)) {

	            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
	            $param_email = trim($_POST["email"]);
	            
	            if($stmt->execute()) {
	                if($stmt->rowCount() == 1){
	                    $errors['email'] = "This email address is already in use.";
	                }
	                else {
	                    $email = trim($_POST["email"]);
	                }
	            }
	            else {
	                echo "Something failed while trying verify email as unique.";
	            }
	        }
	         
	        unset($stmt);
	    }

	    // PASSWORD
	    if(strlen(trim($_POST['password'])) < 6) {
	        $errors['password'] = 'Password must be more than 6 characters.';
	    }
	    else {
	        $password = trim($_POST['password']);
	    }
	    /*
			FORM VALIDATION END
	    */


	    if(empty($errors)) {
	    	$sql = "INSERT INTO users (first_name, last_name, date_of_birth, email, password) VALUES (:first_name, :last_name, :date_of_birth, :email, :password)";
         
	        if($stmt = $db->prepare($sql)) {
	            $stmt->bindParam(':first_name', $param_first_name, PDO::PARAM_STR);
	            $stmt->bindParam(':last_name', $param_last_name, PDO::PARAM_STR);
	            $stmt->bindParam(':date_of_birth', $param_date_of_birth, PDO::PARAM_STR);
	            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
	            $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
	            
	            $param_first_name = $first_name;
	            $param_last_name = $last_name;
	            $param_date_of_birth = $date_of_birth;
	            $param_email = $email;
	            $param_password = password_hash($password, PASSWORD_DEFAULT);
	            
	            if($stmt->execute()) {
	                header("location: /login?reg=success");
	            }
	            else {
	                echo "Registration failed.";
	            }
	        }

			unset($stmt);
    	}
    	else {
    		require_once('views/register/index.php');
    	}

    	unset($db);
	}
}

?>