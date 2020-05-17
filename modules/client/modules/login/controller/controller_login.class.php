<?php
	class controller_login {
	    function __construct() {
			$_SESSION['module'] = "login";
			session_start();
		}
		
		function view() {
			$paths = array("head_login.php","login_page.html");
        	loadView('modules/login/view/', $paths);
		}

		function view_signin() {
			$paths = array("head_signin.php","signin_page.html");
        	loadView('modules/login/view/', $paths);
		}

		function view_checking() {
			$paths = array("head_login.php","checking_page.html");
        	loadView('modules/login/view/', $paths);
		}

		function login() {
			if ($_POST) {
                $var = $_POST['password'];
				$result = loadModel(DAO_LOGIN, "login_dao", "login", strtolower($_POST['email']));
				$result = $result[0];

				if (password_verify($var, $result['password'])) {
					if ($result['active'] == 0)
						echo "La cuenta no está activada, verifique el correo.";
					else {
						$_SESSION["id"] = $result['id'];
						$_SESSION["name"] = $result['name'];
						$_SESSION["email"] = $result['email'];
						$_SESSION["password"] = $result['password'];
						$_SESSION["avatar"] = $result['avatar'];
						$_SESSION["logged"] = $result['type'];
						$_SESSION["salary"] = $result['salary'];
						$_SESSION["time"] = time();
						if ($_SESSION["cart"] == true) {
							$_SESSION["cart"] = false;
							echo false;
						} else
							echo true;
					}
				} else
					echo "La direccion de correo o contraseña no son correctos";
            }
		}

		function checking() {
			if ($_POST['stat'] == 'cart') {
				$_SESSION["cart"] = true;
			}

			if ($_SESSION["logged"] == "admin" || $_SESSION["logged"] == "client") {
				$result = loadModel(DAO_LOGIN, "login_dao", "login", strtolower($_SESSION['email']));
				$result = $result[0];
				if ($result['password'] == $_SESSION["password"]) {
					$data = array($_SESSION["name"], $_SESSION["avatar"]);
					echo json_encode($data);
					exit;
				} else {
					session_destroy();
					session_unset();
					echo "false";
				}
			} else
				echo "true";
		}

		function logout() {
			session_destroy();
			session_unset();
			echo "true";
		}

		function time() {
			if (!isset($_SESSION["time"])){
				echo "true";
			}
			else {  
				if((time() - $_SESSION["time"]) >= 900) {
					session_destroy();
					session_unset();
	    	  		echo "false"; 
				} else {
					session_regenerate_id();
					echo "true";
				}
			}
		}

		function signin() {
			if ($_POST) {
				$result = loadModel(DAO_LOGIN, "login_dao", "login", strtolower($_POST['email']));
				$result = $result[0];

				if (!$result) {
					$data = array(
						$_POST['name'],
						strtolower($_POST['email']),
						password_hash($_POST['password'], PASSWORD_DEFAULT),
						"http://i.pravatar.cc/300?u=".$_POST['hash']
					);
					$token = loadModel(DAO_LOGIN, "login_dao", "insert_user", $data);
					$data = $_POST;
					$data = array(
						"token" => $token,
						"correo" => $_POST["email"],
						"nombre" => $_POST["name"]
					);
					$total = json_decode(enviar_email($data,"signin"),true);
                    echo json_encode($total);
				} else
					echo "Este email ya esta registrado";
				
            } else
				echo "error";
		}

		function check() {
			loadModel(DAO_LOGIN, "login_dao", "check", $_GET["param"]);
			$paths = array("head_login.php","login_page.html");
        	loadView('modules/login/view/', $paths);
		}
	}