<?php

class ProfileController {
	public function index() {
		if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
			header("location: /login");
			exit;
		}
		else {
			require_once('models/User.php');
			$user = User::find($_SESSION['user_id']);

			require_once('views/profile/index.php');
		}
	}

	public function logout() {
		session_start();
		$_SESSION = array();
		session_destroy();

		header("location: login");
		exit;
	}

	public function edit() {
		//TODO: figure out how to make this code reusable. Shares a lot of similarity with the register function.
		$db = DB::getInstance();

		$errors = array();

	    /*
			FORM VALIDATION START
	    */
		// PROFILE IMAGE

		if ($_FILES['profile_image']['size'] !== 0) {
			if(isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 2097152) {
				$errors['profile_image'] = 'Max image size is 2MB.';
			}
			elseif($_FILES['profile_image']['type'] != 'image/png' && $_FILES['profile_image']['type'] != 'image/jpeg' && $_FILES['profile_image']['type'] != 'image/jpg') {
				$errors['profile_image'] = 'Image must be a PNG or JPEG.';
			}
			else {
				$profile_image = $_FILES['profile_image']['name'];
			}
		}

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
	                	if($row = $stmt->fetch()) {
	                		if ($row['id'] !== $_SESSION['user_id']) {
	                			$errors['email'] = "This email address is already in use.";
	                		}
	                		else {
	                    		$email = trim($_POST["email"]);
	                		}
	                	}
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
	    if ($_POST['password'] !== '') {
		    if(strlen(trim($_POST['password'])) < 6) {
		        $errors['password'] = 'Password must be more than 6 characters.';
		    }
		    else {
		        $password = trim($_POST['password']);
		    }
		}
	    /*
			FORM VALIDATION END
	    */

		if(empty($errors)) {
	    	$sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, date_of_birth = :date_of_birth, email = :email";

	    	if(isset($profile_image)) { $sql .= ', profile_image = :profile_image'; }
	    	if(isset($password)) { $sql .= ', password = :password'; }

	    	$sql .= " WHERE id = " . $_SESSION['user_id'];
         
	        if($stmt = $db->prepare($sql)) {
	        	if(isset($profile_image)) {
	        		$stmt->bindParam(':profile_image', $param_profile_image, PDO::PARAM_STR);
	        		$param_profile_image = $profile_image;
	        	}
	        	if(isset($password)) {
	        		$stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
	        		$param_password = password_hash($password, PASSWORD_DEFAULT);
	        	}
	        	
	            $stmt->bindParam(':first_name', $param_first_name, PDO::PARAM_STR);
	            $stmt->bindParam(':last_name', $param_last_name, PDO::PARAM_STR);
	            $stmt->bindParam(':date_of_birth', $param_date_of_birth, PDO::PARAM_STR);
	            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
	            
	            $param_first_name = $first_name;
	            $param_last_name = $last_name;
	            $param_date_of_birth = $date_of_birth;
	            $param_email = $email;
	            
	            if($stmt->execute()) {
	            	if (isset($profile_image)) {
	            		$folder = './public/uploads/user_' . $_SESSION['user_id'] . '/';
	            		
		            	if (!is_dir($folder)) {
		            		mkdir($folder);
		            		mkdir($folder . 'profile');
		            	}
		            	move_uploaded_file($_FILES['profile_image']['tmp_name'], $folder . 'profile/' . $profile_image);
	            	}
	            	unset($_SESSION['errors']);
	                header("location: /profile?edit=success");
	            }
	            else {
	                echo "Profile edit failed.";
	            }
	        }

			unset($stmt);
    	}
    	else {
    		$_SESSION['errors'] = $errors;
    		header("location: /profile?edit=failed");
    	}

    	unset($db);
	}

	public function uploads() {
		require_once('views/profile/uploads.php');
	}
}

?>