<?php

class UploadsController {
	public function index() {
		if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
			header("location: /login");
			exit;
		}
		else {
			$db = DB::getInstance();
			$req = $db->query('SELECT user_id, filename, uploaded_at, first_name, last_name FROM uploads JOIN users ON (uploads.user_id = users.id)');

			$uploads = $req->fetchAll();
			require_once('views/user-uploads/index.php');
		}
	}

	public function add() {
		$db = DB::getInstance();

		$errors = array();

		//print_r($_FILES["file_upload"]["error"]);exit;

		// TODO: make sure you don't upload a file with a name that's already taken.  Probably best to generate a name for them all and store the user defined name in the db.
		if ($_FILES['file_upload']['size'] !== 0) {
			if($_FILES['file_upload']['type'] != "text/plain" && $_FILES['file_upload']['type'] != "application/pdf") {
				$errors['file_upload'] = 'File must be .txt of PDF.';
			}
			else {
				$file_upload = $_FILES['file_upload']['name'];
			}
		}
		elseif (trim($_POST['text_file']) !== '') {
			$file_upload = trim(strip_tags($_POST['text_file']));
		}
		else {
			$errors['file_upload'] = 'Must upload a file or type in the text area to submit.';
		}

		if(empty($errors)) {
	    	$sql = "INSERT INTO uploads (filename, user_id) VALUES (:file_upload, :user_id)";
         
	        if($stmt = $db->prepare($sql)) {
	        	$gen_name = 'file_' . mt_rand(100000000, 999999999) . '.txt';
	        	
	            $stmt->bindParam(':file_upload', $param_file_upload, PDO::PARAM_STR);
	            $stmt->bindParam(':user_id', $param_user_id, PDO::PARAM_STR);
	            
	            if (pathinfo($file_upload)['extension'] !== "") {
	            	$param_file_upload = $file_upload;
	            }
	            else {
	            	$param_file_upload = $gen_name;
	            }
	            $param_user_id = $_SESSION['user_id'];
	            
	            if($stmt->execute()) {
	            	$folder = './public/uploads/user_' . $_SESSION['user_id'] . '/';

	            	if (!is_dir($folder)) {
	            		mkdir($folder);
	            	}

	            	if (pathinfo($file_upload)['extension'] !== ""){
	            		move_uploaded_file($_FILES['file_upload']['tmp_name'], $folder . $file_upload);
	            	}
	            	else {
	            		file_put_contents($folder . $gen_name, $file_upload);
	            	}

	            	unset($_SESSION['errors']);
	                header("location: /user-uploads?upload=success");
	            }
	            else {
	                echo "Upload failed.";
	            }
	        }

			unset($stmt);
    	}
    	else {
    		$_SESSION['errors'] = $errors;
    		header("location: /user-uploads?upload=failed");
    	}

    	unset($db);
	}
}

?>