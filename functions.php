<?php

	session_start();
	
	define('MYSQL_DRIVER', 'mysql:host=sql208.byethost.com;dbname=b7_24509974_workstation;');
	define('USERNAME', 'b7_24509974');
	define('PASSWORD', 'workstation');

	global $DB;
    try{
        // Establishing connection
		$DB = new PDO(MYSQL_DRIVER, USERNAME, PASSWORD);
		$DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (PDOException $e) {
        die('Database connection failed ');
	}
	
    // Register when there is a post request
	if( isset($_POST["register"]) ){
		$register = register();
	}
	if( isset($_POST["login"]) ){
		$login = login();
	}

	function register(){
		global $DB;
		$errors = [];
		$success = false;
		
		if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["phone"]) &&  isset($_POST["password"]) && isset($_POST["confirm_password"]) ){
			$name = trim($_POST["fname"]).' '.trim($_POST["lname"]);
			$username = trim($_POST["username"]);
			$email = trim($_POST["email"]);
			$phone = trim($_POST["phone"]);
			$password = $_POST["password"];
			$confirm_password = $_POST["confirm_password"];
			
			// Form validation (email and password)
			if($password !== $confirm_password) $errors[] = 'Password do not match';
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[]="Invalid email";
			}

			// Insert Data to DB if no errors
			if(count($errors) === 0){
				try{
					$query = $DB->prepare("INSERT INTO users (name, email, username, phone, password) VALUES (?, ?, ?, ?, ?)");
					$query->execute([$name, $email,  $username, $phone, password_hash($password, PASSWORD_DEFAULT)]);
					if($query->rowCount() > 0){
						$success = true;
					}
				}catch(PDOException $e){
					$errors[] = 'Error saving record <br>'.$e;
				}
			}			
		}else{
			$errors[] = 'Please check to confirm all required fields are filled';
		}

		return ['errors'=>$errors, 'success'=>$success];
	}

	function login(){
		$errors = [];
        $success = false;
		global $DB;

		if( isset($_POST["email"]) && isset($_POST["password"]) ){
			$email = trim($_POST["email"]);
			$password = $_POST["password"];
			
			// Form validation (email)
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[]="Invalid email";
			}

			// Select User from DB if no errors
			if(count($errors) === 0){
				try{
					$query = $DB->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
					$query->execute([$email, $email]);
					if($query->rowCount() > 0){
						$query = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach($query as $user){
							if(password_verify( $password, $user['password'])){
								$success = true;
								$_SESSION['user'] = $user;
								redirect_to('home.php');
							}
						}
                        $errors[] = "Incorrect login credentials. Please retry or register!";
					}else{
                        $errors[] = "Incorrect login credentials. Please retry or register!";
                    }
				}catch(PDOException $e){
					$errors[] = 'Error saving record <br>'.$e;
				}
			}

		}else{
			$errors[] = 'Please check to confirm all required fields are filled';
		}

		return ['errors'=>$errors, 'success'=>$success];
	}

	function logout(){
		//Erase all session variables
		$_SESSION = [];

		//Destroy the session
		session_destroy();

		// Redirect to login
		redirect_to('index.php');
	}

	function is_auth(){	
		if(!isset($_SESSION['user'])){
			redirect_to('index.php');
		}else{
			return $_SESSION['user'];
		}
	}

	function redirect_to(String $location){
		header("Location: {$location}"); 
		exit();
	}
	
?>
