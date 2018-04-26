<?php

class User {

	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $date_of_birth;
	public $profile_image;

	public function __construct($id, $first_name, $last_name, $email, $date_of_birth, $profile_image) {
		$this->id 				= $id;
		$this->first_name 		= $first_name;
		$this->last_name 		= $last_name;
		$this->email 			= $email;
		$this->date_of_birth 	= $date_of_birth;
		$this->profile_image 	= $profile_image;
	}

	public static function find($id) {
		$db = DB::getInstance();

		$req = $db->prepare('SELECT * FROM users WHERE id = :id');
		$req->execute(array('id' => $id));
		$user = $req->fetch();

		return new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['date_of_birth'], $user['profile_image']);
	}
}

?>