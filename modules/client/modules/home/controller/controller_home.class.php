<?php
	class controller_home {
	    function __construct() {
	        $_SESSION['module'] = "home";
		}
		
		function view() {
        	loadView('modules/home/view/', 'home_page.html');
	    }
	    
	    // function best_breed() {
	    // 	if ((isset($_POST["best_breed"])) && ($_POST["best_breed"] == true)){
		// 		$json = array();
		// 	 	$json = loadModel(MODEL_HOME, "home_model", "best_breed_home",$_POST['position']);
		// 	 	echo json_encode($json);
		// 	}
	    // }
	}